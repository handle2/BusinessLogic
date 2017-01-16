<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2016.12.22.
 * Time: 19:30
 */

namespace Modules\BusinessLogic\Models;


use Modules\BusinessLogic\ContentSettings\Seqs as Seq;
use Phalcon\Mvc\Collection;

class Prodcategs extends Collection
{
    public $id;
    public $url;
    public $name;
    public $inputs;
    public $langs;

    public function update(){

    }

    public static function dumpResult($collection,$document){

    }

    public function search($search){
        $inputs = Prodcategs::find(array("conditions" => $search));
        return $inputs;
    }

    public function create($id = false){
        if($id){
            $found = Prodcategs::findFirst(array("conditions" => array(
                'id' => $id
            )));
            return $found;
        }

        $seq = Seq::createSeq('prodcategs');
        $input = new Prodcategs();
        $input->id = $seq->current;
        $input->save();
        return $input;
    }
}