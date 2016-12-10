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
    protected $ids;

    protected function _readSearch(){
        $params = array();
        
        if(isset($this->id) && !empty($this->id)){
            $params['id'] = $this->id; 
        }
        if(isset($this->ids) && !empty($this->ids)){
            //db.test.find({_id: {$in: ids}});
            $params['id'] = array('$in' => $this->ids);
        }
        if(isset($this->code) && !empty($this->ids)){
            $params['code'] = $this->code;
        }
        if(isset($this->name) && !empty($this->ids)){
            $params['name'] = $this->name;
        }
        
        return $params;
    }
    
    public function findFirst(){
        $params = $this->_readSearch();
        $result = $this->model->findFirst($params);
        return $this->object->generate($result);
    }

    public function find(){
        $params = array('conditions'=>$this->_readSearch());
        $results = $this->model->find($params);

        $roles = [];
        foreach ($results as $result){
            $roles[] = $this->object->generate($result);
        }

        return $roles;
    }

    public function create($id = false){
        $result = !$id?$this->model->create():$this->model->create($id);
        return $this->object->generate($result);
    }
}