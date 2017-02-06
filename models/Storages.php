<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2017.02.01.
 * Time: 10:53
 */

namespace Modules\BusinessLogic\Models;


use Modules\BusinessLogic\ContentSettings\Seqs;
use Phalcon\Mvc\Collection;

class Storages extends Collection{

    public $id;

    public $products;

    public $code;

    public $date;
    
    public $langs;
    /**
     *
     */
    public function update(){

    }

    public static function dumpResult($collection,$document){

    }

    /**
     * @param $search
     * @return array
     */
    public function search($search){
        $found = Storages::find(array("conditions" => $search));
        return $found;
    }

    /**
     * @param bool $id
     * @return array|Storages
     */
    public function create($id = false){
        if($id){
            $found = Storages::findFirst(array("conditions" => array(
                'id' => $id
            )));
            return $found;
        }

        $seq = Seqs::createSeq('storages');
        $self = new Storages();
        $self->id = $seq->current;
        $self->save();
        return $self;
    }

}