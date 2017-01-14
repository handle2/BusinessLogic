<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2016.12.22.
 * Time: 19:29
 */

namespace Modules\BusinessLogic\ContentSettings;


use Modules\BusinessLogic\Models\Inputs;

class Input extends Base
{
    public $id;
    public $type;
    public $url;
    public $name;
    public $children;
    public $length;

    public function generate(Inputs $obj,$lang){
        $input = new Input();
        $input->id = $obj->id;
        $input->type = isset($obj->{$lang}['type'])?$obj->{$lang}['type']:$obj->type;
        $input->url = isset($obj->{$lang}['url'])?$obj->{$lang}['url']:$obj->url;
        $input->name = isset($obj->{$lang}['name'])?$obj->{$lang}['name']:$obj->name;  
        $input->children = $obj->children;
        $input->length = $obj->length;
        return $input;
    }

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
        if($input->save()){
            return true;
        }else{
            return false;
        }
    }
}