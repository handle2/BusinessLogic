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
    public $name = null;
    public $code = null;
    public $type = null;
    public $id = null;
    public $rights = null;
    
    public function generate(Models\Roles $obj){
        $role = new Role();
        $role->id = $obj->id;
        $role->name = $obj->name;
        $role->code = $obj->code;
        $role->type = $obj->type;
        $role->rights = $obj->rights?$obj->rights:[];
        return $role;
    }


    public function delete(){
        $model = new Models\Roles();
        $role = $model->create($this->id);
        if($role->delete()){
            unset($this);
            return true;
        }else{
            return false;
        }
    }

    public function save(){

        $model = new Models\Roles();
        $role = $model->create($this->id);
        $role->name = $this->name;
        $role->code = $this->code;
        $role->type = $this->type;
        $role->rights = $this->rights;
        if($role->save()){
            return true;
        }else{
            return false;
        }
    }


    
}