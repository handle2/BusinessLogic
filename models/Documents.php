<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2017.01.08.
 * Time: 19:30
 */

namespace Modules\BusinessLogic\Models;


use Modules\BusinessLogic\ContentSettings\Seqs;
use Phalcon\Mvc\Collection;

class Documents extends Collection
{
    public $id;
    public $sourceImage;
    public $croppedImage;
    public $bounds;
    public $name;
    public $type;
    public $size;

    public function update(){

    }

    public static function dumpResult($collection,$document){

    }

    public function search($search){
        $inputs = Documents::find(array("conditions" => $search));
        return $inputs;
    }

    public function create($id = false){
        if($id){
            $found = Documents::findFirst(array("conditions" => array(
                'id' => $id
            )));
            return $found;
        }

        $seq = Seqs::createSeq('documents');
        $discount = new Documents();
        $discount->id = $seq->current;
        $discount->save();
        return $discount;
    }
}