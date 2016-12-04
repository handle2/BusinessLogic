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
    public $rights;
    
    private function generateRole(Models\Roles $obj){
        $role = new Role();
        $role->id = $obj->id;
        $role->name = $obj->name;
        $role->code = $obj->code;
        $role->type = $obj->type;
        $role->rights = $obj->rights;
        return $role;
    }

    public static function createRole($form){
        $p = new Role();
        $mp = new Models\Roles();
        $role = empty($form->id)?$mp->create():$mp->create($form->id);
        $role->name = $form->name;
        $role->code = $form->code;
        $role->type = $form->type;
        $role->rights = $form->rights;
        $role->save();
        return $p->generateRole($role);

    }

    public static function deleteRole($id){
        $model = new Models\Roles();
        $role = $model->create($id);
        if($role->delete()){
            return true;
        }else{
            return false;
        }
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