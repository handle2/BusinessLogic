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
    
    private function generateRight($obj){
        $right = new Right();
        $right->id = $obj->id;
        $right->name = $obj->name;
        $right->parent = $obj->parent;
        $right->code = $obj->code;
        $right->type = $obj->type;
        return $right;
    }

    public static function createRight($form){
        $setting = new Right();
        $model = new Models\Rights();
        $right = empty($form->id)?$model->create():$model->create($form->id);
        $right->name = $form->name;
        $right->parent = $form->parent;
        $right->code = $form->code;
        $right->type = $form->type;
        $right->save();
        return $setting->generateRight($right);
    }

    public static function searchRights($search,$fields){
        $model = new Models\Rights();
        $setting = new Right();
        $roles = $model->search($search,$fields);
        $arr = [];
        foreach ($roles as $role){
            $arr[] = $setting->generateRight($role);
        }
        return $arr;
    }

    public static function deleteRight($id){
        $model = new Models\Rights();
        $right = $model->create($id);
        if($right->type == "group"){
            $wole = $model->search(["parent"=>$right->code]);

            foreach ($wole as $w){
                self::deleteRight($w->id);
            }
        }
        if($right->delete()){
            return true;
        }else{
            return false;
        }

    }
}