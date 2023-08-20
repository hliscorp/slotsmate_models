<?php

require_once("entities/Article.php");
require_once("entities/Writer.php");
require_once("entities/Rating.php");
require_once("application/models/dao/Articles.php");
require_once("application/models/ResultSetWrapper.php");
require_once("vendor/lucinda/queries/src/Select.php");

class Author
{

    public function __construct($parentSchema, $name = '', $id = null)
    {
        $this->parentSchema = $parentSchema;
        if(!empty($name)) $this->authorId = $this->getAuthorIdByName($name);
        else if(!empty($id)) $this->authorId = $id;
    }

    private function getAuthorIdByName($name){
        $name = str_replace('-', ' ', $name);
        $select = new \Lucinda\Query\Select("{$this->parentSchema}.writers", "t1");
        $select->fields(["id"]);
        $condition = $select->where();
        $condition->set("LOWER(CONCAT(t1.first_name,' ', t1.last_name))",':name');
        $authorId  = SQL($select->toString(), [':name'=> $name])->toValue();
        if ($authorId === false) {
            throw new Lucinda\MVC\STDOUT\PathNotFoundException();
        }

        return $authorId;
    }

    public function getAuthorDetails() : object
    {
        $select = new \Lucinda\Query\Select("{$this->parentSchema}.writers", "t1");
        $select->fields(["id,first_name,last_name,date_joined,role,short_bio,full_bio"]);
        $condition = $select->where();
        $condition->set("t1.id",":author_id");
        $row = SQL($select->toString(),[':author_id'=>$this->authorId])->toRow();
        return $this->setAuthor($row);
    }

    public function getAuthorArticles($offset=0): array
    {
        $articles = new Articles($this->parentSchema);
        $select = new \Lucinda\Query\Select("{$this->parentSchema}.writers", "t1");
        $select->fields(["t3.id AS article_id,t3.title,t3.content,t3.date_added,t3.last_changed,t3.min_read,t3.likes,t3.dislikes,t3.url"]);
        $select->joinInner("articles","t3")->on(["t3.writer_id"=>"t1.id"]);
        $condition = $select->where();
        $condition->set("t1.id",':author_id');
        $condition->set("t3.deleted",0)->set("t3.is_draft",0);
        $select->orderBy()->add("t3.id",\Lucinda\Query\OrderByOperator::DESC);
        $select->limit(12, $offset);
        $res = SQL($select->toString(),[':author_id'=>$this->authorId]);
        $results = [];
        while ($row = $res->toRow()) {
            $results[] = $articles->createArticleObj($row);
        }
        return $results;
    }

    public function getTotalAuthorArticles(): int
    {
        $select = new \Lucinda\Query\Select("{$this->parentSchema}.writers", "t1");
        $select->fields(["COUNT(DISTINCT t3.id)"]);
        $select->joinInner("articles","t3")->on(["t3.writer_id"=>"t1.id"]);
        $condition = $select->where();
        $condition->set("t1.id",':author_id');
        $condition->set("t3.deleted",0)->set("t3.is_draft",0);
        return SQL($select->toString(),[':author_id'=>$this->authorId])->toValue();
    }

    public function getAuthorGames($viewport,$offset=0): array
    {
        $isMobile = [($viewport == 'mobile' ? 1 : 0), 2];
        $names = $this->getAuthorTmsRoutes();
        if (!empty($names)) {
            $select = new \Lucinda\Query\Select("games", "t1");
            $select->fields(["t1.id AS id, t1.name AS name, t1.date_launched, t1.game_manufacturer_id AS software_id, t4.score, t5.name as manufacturer"]);
            $select->joinLeft("game_play__matches", "t2")->on(["t1.id" => "t2.game_id"]);
            $select->joinLeft("game_play__patterns", "t3")->on(["t3.id" => "t2.pattern_id"])->setIn("t3.isMobile", $isMobile);
            $select->joinLeft("games__votes","t4")->on(["t1.id" => "t4.game_id"]);
            $select->joinLeft("game_manufacturers","t5")->on(["t1.game_manufacturer_id" => "t5.id"]);
            $condition = $select->where();
            $condition->setIn("t1.name", implode(',',$names));
            $select->orderBy()->add("t1.date_launched", \Lucinda\Query\OrderByOperator::DESC);
            $select->limit(8, $offset);
            return SQL($select->toString())->toList();
        }

        return array();
    }

    public function getTotalAuthorGames($viewport): int
    {
        $isMobile = [($viewport == 'mobile'?1:0),2];
        $names = $this->getAuthorTmsRoutes();
        if (!empty($names)) {
            $select = new \Lucinda\Query\Select("games", "t1");
            $select->fields(["COUNT(t1.id)"]);
            $condition = $select->where();
            $condition->setIn("t1.name", implode(',', $names));
            return SQL($select->toString())->toValue();
        }

        return 0;
    }

    private function getAuthorTmsRoutes(): array
    {
        $select = new \Lucinda\Query\Select("{$this->parentSchema}.cms__contents", "t1");
        $select->fields(["t4.name"]);
        $select->joinInner("{$this->parentSchema}.cms__contents_slots","t2")->on(["t1.id" => "t2.content_id"]);
        $select->joinInner("{$this->parentSchema}.cms__contents_widgets","t3")->on(["t2.id"=>"t3.content_slot_id"]);
        $select->joinInner("{$this->parentSchema}.cms__routes","t4")->on(["t4.id"=>"t1.route_id"]);
        $select->joinInner("{$this->parentSchema}.cms__patterns","t6")->on(["t6.id"=>"t4.pattern_id"]);
        $select->joinInner("{$this->parentSchema}.cms__patterns_slots","t7")->on(["t7.id"=>"t2.pattern_slot_id"]);
        $select->joinInner("{$this->parentSchema}.cms__slots","t8")->on(["t8.id"=>"t7.slot_id"]);
        $select->joinInner("{$this->parentSchema}.tms","t9")->on(["t3.id"=>"t9.remote_id"]);
        $select->joinInner("{$this->parentSchema}.writers","t10")->on(["t10.id"=>"t3.writer_id"]);
        $condition = $select->where();
        $condition->setIn("t6.name","'software/(software)/(name)', 'software/(software)'");
        $condition->set("t9.description","''", \Lucinda\Query\ComparisonOperator::DIFFERS);
        $condition->set("t8.name","'overview'");
        $condition->set("t10.id",$this->authorId);
        $output = [];
        $routes = SQL($select->toString())->toList();
        foreach ($routes as $value) {
            $routeArr = explode("/",$value['name']);
            if(count($routeArr) >= 3){
                $output[] = "'" . strtolower(str_replace("\\", "", str_replace("'", "", str_replace("-"," ",$routeArr[2])))) . "'";
            }
        }
        return $output;
    }

}