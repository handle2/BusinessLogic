<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2016.12.21.
 * Time: 15:47
 */

namespace Modules\BusinessLogic\Models;


use Modules\BusinessLogic\ContentSettings\Seqs;
use Phalcon\Mvc\Collection;

class Prodcateg extends Collection
{
    public $id;

    public function update(){

    }

    public static function dumpResult($collection,$document){

    }

    public function search($search){
        $prodcategs = Prodcateg::find(array("conditions" => $search,"fields"=>["password" => 0]));
        return $prodcategs;
    }

    public function create($id = false){
        if($id){
            $found = Prodcateg::findFirst(array("conditions" => array(
                'id' => $id
            )));
            return $found;
        }

        $seq = Seqs::createSeq('prodcateg');
        $prodcateg = new Prodcateg();
        $prodcateg->id = $seq->current;
        $prodcateg->save();
        return $prodcateg;
    }
}