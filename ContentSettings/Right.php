<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2016.11.27.
 * Time: 22:30
 */

namespace Modules\BusinessLogic\ContentSettings;

use Modules\BusinessLogic\Models as Models;
use Phalcon\Mvc\Collection;

class Right extends Base
{
    public $id;
    public $name;
    public $code;
    public $type;
    public $parent;
    public $actions = [];
    
    public function generate(Models\Rights $obj){
        $right = new Right();
        $right->id = $obj->id;
        $right->name = $obj->name;
        $right->parent = $obj->parent;
        $right->code = $obj->code;
        $right->type = $obj->type;
        $right->actions = $obj->actions;
        return $right;
    }

    public function delete(){

        $model = new Models\Rights();
        $right = $model->create($this->id);
        if($right->type == "group"){
            $wole = $model->find(array('conditions'=>["parent"=>$right->code]));
            foreach ($wole as $w){
                $w->delete();
            }
        }
        if($right->delete()){
            unset($this);
            return true;
        }else{
            return false;
        }
    }

    public function save(){

        $model = new Models\Rights();
        $right = $model->create($this->id);
        $right->id = $this->id;
        $right->name = $this->name;
        $right->parent = $this->parent;
        $right->code = $this->code;
        $right->type = $this->type;
        $right->actions = $this->actions;
        if($right->save()){
            return true;
        }else{
            return false;
        }
    }
}