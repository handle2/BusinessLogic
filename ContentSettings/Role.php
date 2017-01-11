<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2016.11.26.
 * Time: 10:38
 */

namespace Modules\BusinessLogic\ContentSettings;
use Modules\BusinessLogic\Models;

class Role extends Base
{
    public $name = null;
    public $code = null;
    public $type = null;
    public $id = null;
    public $rights = null;
    public $roles = null;
    
    public function generate(Models\Roles $obj){
        $role = new Role();
        $role->id = $obj->id;
        $role->name = $obj->name;
        $role->code = $obj->code;
        $role->type = $obj->type;
        $role->rights = $obj->rights?$obj->rights:[];
        $role->roles = $obj->roles?$obj->roles:[];
        return $role;
    }


    public function delete(){
        
        $this->deleteCache($this);

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

        $this->deleteCache($this);

        $model = new Models\Roles();
        $role = $model->create($this->id);
        $role->name = $this->name;
        $role->code = $this->code;
        $role->type = $this->type;
        $role->rights = $this->rights;
        $role->roles = $this->roles;
        if($role->save()){
            return true;
        }else{
            return false;
        }
    }


    
}