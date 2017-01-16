<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2017.01.01.
 * Time: 19:08
 */

namespace Modules\BusinessLogic\Models;


use Modules\BusinessLogic\ContentSettings\Seqs;
use Phalcon\Mvc\Collection;

class Discounts extends Collection
{
    public $id;
    
    public $type;
    
    public $url;
    
    public $name;
    
    public $value;
    
    public $langs;

    /**
     * 
     */
    public function update(){

    }
    
    public static function dumpResult($collection,$document){

    }

    /**
     * @param $search
     * @return array
     */
    public function search($search){
        $inputs = Discounts::find(array("conditions" => $search));
        return $inputs;
    }

    /**
     * @param bool $id
     * @return array|Discounts
     */
    public function create($id = false){
        if($id){
            $found = Discounts::findFirst(array("conditions" => array(
                'id' => $id
            )));
            return $found;
        }

        $seq = Seqs::createSeq('discounts');
        $discount = new Discounts();
        $discount->id = $seq->current;
        $discount->save();
        return $discount;
    }
}