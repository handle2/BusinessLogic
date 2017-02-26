<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2017.02.25.
 * Time: 21:37
 */

namespace Modules\BusinessLogic\Models;


use Modules\BusinessLogic\ContentSettings\Seqs;
use Phalcon\Mvc\Collection;

class Carts extends Collection
{
    public $id;

    public $type;

    public $userId;

    public $products;

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
        $contents = Carts::find(array("conditions" => $search));
        return $contents;
    }

    /**
     * @param bool $id
     * @return array|Contents
     */
    public function create($id = false){
        if($id){
            $found = Carts::findFirst(array("conditions" => array(
                'id' => $id
            )));
            return $found;
        }

        $seq = Seqs::createSeq('carts');
        $cart = new Carts();
        $cart->id = $seq->current;
        $cart->save();
        return $cart;
    }

}