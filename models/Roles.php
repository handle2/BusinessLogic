<?php
namespace Modules\BusinessLogic\Models;

use Phalcon\Mvc\Collection;
use Modules\BusinessLogic\ContentSettings;

class Roles extends Collection
{
    public $id;
    public $name;
    public $code;
    public $type;

    public function update(){

    }

    public static function dumpResult($collection,$document){

    }

    public function create($id = false){
        if($id){
            $found = Roles::findFirst(array("conditions" => array(
                'id' => (int)$id
            )));
            return $found;
        }
        $roles = new Roles();
        $seq = ContentSettings\Seqs::createSeq('roles');
        $roles->id = $seq->current;
        return $roles;
    }

    public function search($search){
        $profile = Roles::find(array("conditions" => $search));
        return $profile;
    }
}