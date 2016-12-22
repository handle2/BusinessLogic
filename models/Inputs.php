<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2016.12.22.
 * Time: 19:29
 */

namespace Modules\BusinessLogic\Models;
use Modules\BusinessLogic\ContentSettings\Seqs;
use Phalcon\Mvc\Collection;

class Inputs extends Collection
{
    public $id;
    public $type;
    public $url;
    public $name;
    public $item;
    public $length;

    public function update(){

    }

    public static function dumpResult($collection,$document){

    }

    public function search($search){
        $inputs = Inputs::find(array("conditions" => $search));
        return $inputs;
    }

    public function create($id = false){
        if($id){
            $found = Inputs::findFirst(array("conditions" => array(
                'id' => $id
            )));
            return $found;
        }

        $seq = Seqs::createSeq('inputs');
        $input = new Inputs();
        $input->id = $seq->current;
        $input->save();
        return $input;
    }
}