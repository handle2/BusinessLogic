<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2016.11.14.
 * Time: 14:23
 */

namespace Modules\BusinessLogic\ContentSettings;
use Modules\BusinessLogic\Models as Models;

class Profile extends Base
{
    public $id;
    
    public $username;
    
    public $password;
    
    public $email;
    
    public $name;
    
    public $role;
    
    public $group;

    public $pictureIds;

    /**
     * @param $obj
     * @return Profile
     */
    public function generate($obj){
        $profile = new Profile();
        $profile->id = $obj->id;
        $profile->username = $obj->username;
        $profile->password = isset($obj->password)?$obj->password:null;
        $profile->email = $obj->email;
        $profile->name = $obj->name;
        $profile->role = $obj->role;
        $profile->group = $obj->group;
        $profile->pictureIds = $obj->pictureIds;

        return $profile;
    }

    /**
     * @param $username
     * @param $password
     * @return bool|Profile
     */
    public static function login($username, $password){
        $cp = new Profile();
        $mp = new Models\Profiles();
        $profile = $mp->loginProfile($username, $password);
        if($profile){
            return $cp->generate($profile);
        }
        return false;

    }

    /**
     * Törlés
     * @return bool
     */
    public function delete(){

        $this->deleteCache($this);

        $model = new Models\Profiles();
        $profile = $model->create($this->id);
        if($profile->delete()){
            unset($this);
            return true;
        }else{
            return false;
        }
    }

    /**
     * Mentés
     * @return bool
     */
    public function save(){

        $this->deleteCache($this);

        $model = new Models\Profiles();
        /**@var Models\Profiles $profile*/
        $profile = $model->create($this->id);
        $profile->id = $this->id;
        $profile->username = $this->username;
        $profile->email = $this->email;
        $profile->name = $this->name;
        $profile->role = $this->role;
        $profile->group = $this->group;
        $profile->pictureIds = $this->pictureIds;
        if($profile->save()){
            return true;
        }else{
            return false;
        }
    }

    public function setPassword($id,$password){
        $model = new Models\Profiles();
        /**@var Models\Profiles $profile*/
        $profile = $model->create($id);
        $profile->password = $password;
        if($profile->save()){
            return true;
        }else{
            return false;
        }
    }

}