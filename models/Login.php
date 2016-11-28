<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2016.11.13.
 * Time: 21:57
 */

namespace Modules\BusinessLogic\Models;

use Modules\BusinessLogic\ContentSettings;
use Phalcon\Mvc\Collection;

class Login extends Collection
{
    public function update(){

    }

    public function dumpResult($collection,$document){

    }


    public function create($hash = false){
        if($hash){
            $found = Login::findFirst(array("conditions" => array(
                'hash' => $hash
            )));
            return $found;
        }
        $login = new Login();
        $seq = ContentSettings\Seqs::createSeq('login');
        $login->id = $seq->current;
        return $login;
    }

}