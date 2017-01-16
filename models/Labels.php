<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2017.01.09.
 * Time: 9:32
 */

namespace Modules\BusinessLogic\Models;


use Modules\BusinessLogic\ContentSettings\Seqs;
use Phalcon\Mvc\Collection;

class Labels extends Collection
{
    public $id;
    
    public $name;
    
    public $code;
    
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
        $found = Labels::find(array("conditions" => $search));
        return $found;
    }

    /**
     * @param bool $id
     * @return array|Labels
     */
    public function create($id = false){
        if($id){
            $found = Labels::findFirst(array("conditions" => array(
                'id' => $id
            )));
            return $found;
        }

        $seq = Seqs::createSeq('labels');
        $self = new Labels();
        $self->id = $seq->current;
        $self->save();
        return $self;
    }
}