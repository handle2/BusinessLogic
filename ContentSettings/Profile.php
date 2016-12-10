<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2016.11.14.
 * Time: 14:23
 */

namespace Modules\BusinessLogic\ContentSettings;
use Modules\BusinessLogic\Models as Models;

class Profile
{
    public $id;
    public $username;
    public $password;
    public $email;
    public $name;
    public $role;
    public $group;

    public function generate($obj){
        $profile = new Profile();
        $profile->id = $obj->id;
        $profile->username = $obj->username;
        $profile->password = isset($obj->password)?$obj->password:null;
        $profile->email = $obj->email;
        $profile->name = $obj->name;
        $profile->role = $obj->role;
        $profile->group = $obj->group;

        return $profile;
    }

    public static function createProfile($form){
        $p = new Profile();
        $mp = new Models\Profiles();
        $profile = $mp->create();
        $profile->username = $form['username'];
        $profile->email = $form['email'];
        $profile->password = $form['password'];
        $profile->email = $form['email'];
        $profile->name = $form['name'];
        $profile->role = 'user';
        $profile->group = 0;
        $profile->save();
        return $p->generate($profile);

    }
    
    public static function searchProfiles($search){
        $model = new Models\Profiles();
        $setting = new Profile();
        $profiles = $model->search($search);
        $arr = [];
        foreach ($profiles as $profile){
            $arr[] = $setting->generate($profile);
        }
        return $arr;
    }

    public static function login($username, $password){
        $cp = new Profile();
        $mp = new Models\Profiles();
        $profile = $mp->loginProfile($username, $password);
        if($profile){
            return $cp->generate($profile);
        }
        return false;

    }

}