<?php
namespace Modules\BusinessLogic\Models;

use Modules\BusinessLogic\ContentSettings;
use Phalcon\Mvc\Collection;

class Profiles extends Collection{
    public function update(){

    }

    public static function dumpResult($collection,$document){

    }

    public function search($search){
        $profile = Profiles::find(array("conditions" => $search,"fields"=>["password" => 0]));
        return $profile;
    }

    public function create($id = false){
        if($id){
            $found = Profiles::findFirst(array("conditions" => array(
                'id' => $id
            )));
            return $found;
        }
        
        $seq = ContentSettings\Seqs::createSeq('profile');
        $profile = new Profiles();
        $profile->id = $seq->current;
        $profile->save();
        return $profile;
    }
}