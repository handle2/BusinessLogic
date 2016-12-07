<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2016.12.06.
 * Time: 21:45
 */

namespace Modules\BusinessLogic\Search;

use Modules\BusinessLogic\Models;

class BaseSearch
{
    protected $model;
    protected $object;

    protected function _readSearch(){
        $params = array();
        
        if($this->id){
            $params['id'] = $this->id; 
        }
        if($this->ids){
            //db.test.find({_id: {$in: ids}});
            $params['id'] = array('$in' => $this->ids);
        }
        if($this->code){
            $params['code'] = $this->code;
        }
        if($this->name){
            $params['name'] = $this->name;
        }
        
        return $params;
    }
    
    public function findFirst(){
        $params = $this->_readSearch();
        $result = $this->model->findFirst($params);
        return $this->object->generateRole($result);
    }

    public function find(){
        $params = array('conditions'=>$this->_readSearch());
        $results = $this->model->find($params);

        $roles = [];
        foreach ($results as $result){
            $roles[] = $this->object->generateRole($result);
        }

        return $roles;
    }

    public function create($id = false){
        $result = !$id?$this->model->create():$this->model->create($id);
        return $this->object->generateRole($result);
    }
}