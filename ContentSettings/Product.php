<?php
namespace Modules\BusinessLogic\ContentSettings;

use Modules\BusinessLogic\Models as Models;

class Product extends Base{

    public static function getProducts(){
        $prods = array();
        $products = Models\Products::find();
        foreach ($products as $product){
            $prod = new Product();
            foreach ($product as $key => $attr){
                $prod->{$key} = $attr;
            }
            $prods[] = $prod;
        }
        return $prods;
    }

    public static function getProductsByCateg($categ){
        $prods = array();
        $products = Models\Products::find(array(
            'conditions' => array('categ'=>$categ)
        ));
        foreach ($products as $product) {
            $prod = new Product();
            foreach ($product as $key => $attr) {
                $prod->{$key} = $attr;
            }
            $prods[] = $prod;
        }
        return $prods;
    }

    public static function getProduct($url){
        $product = Models\Products::findFirst(array(
            'conditions' => array('url'=>$url)
        ));
        $prod = new Product();
        foreach ($product as $key => $attr){
            $prod->{$key} = $attr;
        }
        return $prod;
    }

    public function save(){
        $product = Models\Products::findFirst(array(
            'conditions' => array(
                '_id' => $this->_id
            )
        ));
        foreach($this as $key => $value){
            $product->{$key} = $value;
        }
        $product->save();
    }
}