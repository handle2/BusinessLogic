<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2017.01.01.
 * Time: 19:11
 */

namespace Modules\BusinessLogic\ContentSettings;


use Modules\BusinessLogic\Models\Discounts;

class Discount extends Base
{
    public $id;
    public $type;
    public $url;
    public $name;
    public $value;
    public $langs;

    public function generate(Discounts $obj,$lang){
        $discount = new Discount();
        $discount->id = $obj->id;
        $langs = (object)$obj->langs;
        $discount->type = isset($langs->{$lang}['type'])?$langs->{$lang}['type']:$obj->type;
        $discount->url = isset($langs->{$lang}['url'])?$langs->{$lang}['url']:$obj->url;
        $discount->name = isset($langs->{$lang}['name'])?$langs->{$lang}['name']:$obj->name;
        $discount->value = isset($langs->{$lang}['value'])?$langs->{$lang}['value']:$obj->value;
        $discount->langs = $obj->langs;
        return $discount;
    }

    public function delete(){

        $this->deleteCache($this);
        
        $model = new Discounts();
        $discount = $model->create($this->id);
        if($discount->delete()){
            unset($this);
            return true;
        }else{
            return false;
        }
    }

    public function save(){

        $this->deleteCache($this);
        
        $model = new Discounts();
        $discount = $model->create($this->id);
        $discount->id = $this->id;
        $discount->type = $this->type;
        $discount->url = $this->urlMakeup($this->url);
        $discount->name = $this->name;
        $discount->value = $this->value;
        $discount->langs = $this->langs;
        if($discount->save()){
            return true;
        }else{
            return false;
        }
    }
}