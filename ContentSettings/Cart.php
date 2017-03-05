<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2017.02.25.
 * Time: 21:35
 */

namespace Modules\BusinessLogic\ContentSettings;


class Cart extends Base
{
    public $id;

    public $type;

    public $userId;

    public $productId;

    public $quantity;


    /**
     * @param Inputs $obj
     * @param $lang
     * @return Input
     */
    public function generate(Inputs $obj,$lang){
        $input = new Input();
        $input->id = $obj->id;
        $langs = (object)$obj->langs;
        $input->type = isset($langs->{$lang}['type'])?$langs->{$lang}['type']:$obj->type;
        $input->url = isset($langs->{$lang}['url'])?$langs->{$lang}['url']:$obj->url;
        $input->name = isset($langs->{$lang}['name'])?$langs->{$lang}['name']:$obj->name;
        $input->children = $obj->children;
        $input->length = $obj->length;
        $input->langs = $obj->langs;
        return $input;
    }

    /**
     * @return bool
     */
    public function delete(){

        $this->deleteCache($this);

        $model = new Inputs();
        $input = $model->create($this->id);
        if($input->delete()){
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

        $model = new Inputs();
        $input = $model->create($this->id);
        $input->id = $this->id;
        $input->type = $this->type;
        $input->url = $this->urlMakeup($this->url);
        $input->name = $this->name;
        $input->children = $this->children;
        $input->length = $this->length;
        $input->langs = $this->langs;
        if($input->save()){
            return true;
        }else{
            return false;
        }
    }
}