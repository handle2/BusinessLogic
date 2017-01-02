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

    public function generate(Discounts $obj){
        $discount = new Discount();
        $discount->id = $obj->id;
        $discount->type = $obj->type;
        $discount->url = $obj->url;
        $discount->name = $obj->name;
        $discount->value = $obj->value;
        return $discount;
    }

    public function delete(){

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

        $model = new Discounts();
        $discount = $model->create($this->id);
        $discount->id = $this->id;
        $discount->type = $this->type;
        $discount->url = $this->urlMakeup($this->url);
        $discount->name = $this->name;
        $discount->value = $this->value;
        if($discount->save()){
            return true;
        }else{
            return false;
        }
    }
}