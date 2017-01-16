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

class Products extends Collection
{
    public $id;
    
    public $pictureIds;
    
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
        $products = Products::find(array("conditions" => $search));
        return $products;
    }

    /**
     * @param bool $id
     * @return array|Products
     */
    public function create($id = false){
        if($id){
            $found = Products::findFirst(array("conditions" => array(
                'id' => $id
            )));
            return $found;
        }

        $seq = Seqs::createSeq('prodcateg');
        $product = new Products();
        $product->id = $seq->current;
        $product->save();
        return $product;
    }
}