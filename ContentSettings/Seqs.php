<?php

namespace Modules\BusinessLogic\ContentSettings;

use Modules\BusinessLogic\Models as Models;

class Seqs extends Base
{
    public $current;

    public $name;

    public static function createSeq($name){
        $sModel = new Models\Seqs();
        $seq = $sModel->create($name);

        if(!$seq){
            $seq = new Models\Seqs();
            $seq->name = $name;
            $seq->current = 1;
            $seq->save();
        }else{
            $seq->current += 1;
            $seq->save();
        }
        $call = new Seqs();
        return $call->generateSeq($seq);
    }

    private function generateSeq($obj){
        $seq = new Seqs();
        $seq->name = $obj->name;
        $seq->current = $obj->current;
        return $seq;
    }
}