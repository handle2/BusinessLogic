<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2016.12.21.
 * Time: 15:45
 */

namespace Modules\BusinessLogic\ContentSettings;
use Modules\BusinessLogic\Models\Products;

class Product extends Base
{
    public $id;

    public $pictureIds;

    public $langs;

    /**
     * @param Products $obj
     * @param $lang
     * @return Product
     */
    public function generate(Products $obj,$lang){
        $product = new Product();
        $langs = (object)$obj->langs;
        foreach ($obj as $key => $prop){
            if($key != '_id'){
                $product->{$key} = isset($langs->{$lang}[$key])?$langs->{$lang}[$key]:$prop;
            }
        }
        return $product;
    }

    /**
     * @return bool
     */
    public function delete(){

        $this->deleteCache($this);
        
        $model = new Products();
        $product = $model->create($this->id);

        if($product->delete()){
            unset($this);
            return true;
        }else{
            return false;
        }
    }

    /**
     * @return bool
     */
    public function save(){

        $this->deleteCache($this);
        
        $model = new Products();
        $product = $model->create($this->id);
        foreach ($this as $key => $prop){
            if($key != '_id') {
                $product->{$key} = $this->{$key};
            }
        }
        if($product->save()){
            return true;
        }else{
            return false;
        }
    }
}