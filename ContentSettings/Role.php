<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2016.11.26.
 * Time: 10:38
 */

namespace Modules\BusinessLogic\ContentSettings;
use Modules\BusinessLogic\Models;

class Role
{
    public $name;
    public $code;
    public $type;
    public $id;
    
    private function generateRole(Models\Roles $obj){
        $role = new Role();
        $role->id = $obj->id;
        $role->name = $obj->name;
        $role->code = $obj->code;
        $role->type = $obj->type;
        return $role;
    }

    public static function createRole($form){
        $p = new Role();
        $mp = new Models\Roles();
        $role = empty($form->id)?$mp->create():$mp->create($form->id);
        $role->name = $form->name;
        $role->code = $form->code;
        $role->type = $form->type;
        $role->save();
        return $p->generateRole($role);

    }

    public static function searchRoles($search){
        $model = new Models\Roles();
        $setting = new Role();
        $roles = $model->search($search);
        $arr = [];
        foreach ($roles as $role){
            $arr[] = $setting->generateRole($role);
        }
        return $arr;
    }
    
}