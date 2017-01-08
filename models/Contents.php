<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2017.01.04.
 * Time: 22:22
 */

namespace Modules\BusinessLogic\Models;


use Modules\BusinessLogic\ContentSettings\Seqs;
use Phalcon\Mvc\Collection;

class Contents extends Collection
{
    public $id;
    public $type;
    public $url;
    public $name;
    public $text;
    public $lead;
    public $pictures;

    public function update(){

    }

    public static function dumpResult($collection,$document){

    }

    public function search($search){
        $contents = Contents::find(array("conditions" => $search));
        return $contents;
    }

    public function create($id = false){
        if($id){
            $found = Contents::findFirst(array("conditions" => array(
                'id' => $id
            )));
            return $found;
        }

        $seq = Seqs::createSeq('contents');
        $content = new Contents();
        $content->id = $seq->current;
        $content->save();
        return $content;
    }
}