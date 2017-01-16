<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2016.12.06.
 * Time: 21:45
 */

namespace Modules\BusinessLogic\Search;

use Modules\BusinessLogic\Models;
use Phalcon\DI;

class BaseSearch
{
    protected $redis;

    protected $model;
    protected $object;
    protected $ids;
    
    public $lang;

    /**
     * cache kulcs
     * @var string
     */

    private $onCache = true;
    private $cacheType = "list";

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
        $params = array('conditions'=>$this->_readSearch());
        $result = $this->model->findFirst($params);
        if($result){
            return $this->object->generate($result,false);
        }else{
            return false;
        }

    }

    public function find(){

        //$this->onCache = false; // debug

        // először megnézzük ,hogy van-e a cacheban ha van akkor visszaadja $this->checkCache('model név+list stb')

        /**@var \Predis\Client $cache*/
        $cache = $this->createRedis();

        $objectName = explode('\\',get_class($this->object));

        $cacheKey = $this->cacheType.'_'.$this->lang.'_'.end($objectName);

        if($cache->exists($cacheKey) && $this->onCache)
        {
            return json_decode($cache->get($cacheKey));
        }

        // ha ide jut itt mindig lesz egy cache mentés

        $params = array('conditions'=>$this->_readSearch());
        $results = $this->model->find($params);

        $items = [];
        foreach ($results as $result){
            $items[] = $this->object->generate($result,$this->lang);
        }
        
        if($this->onCache){
            $cache->set($cacheKey,json_encode($items));
            $cache->expire($cacheKey,3600*24*7);
        }

        return $items;
    }

    public function create($id = false){

        if(!$id){
            /**@var \Predis\Client $cache*/
            $cache = $this->createRedis();

            $objectName = explode('\\',get_class($this->object));

            $cacheKey = $this->cacheType.'_'.end($objectName);

            $cache->del([$cacheKey]);
        }



        $result = !$id?$this->model->create():$this->model->create($id);
        return $result?$this->object->generate($result,$this->lang):false;
    }

    /**
     * Ezzel lehet módosítani a lekért adatok cache kulcsát
     * @param $name
     */
    public function setCacheType($name){
        $this->cacheType = $name;
    }

    public function disableCache(){
        $this->onCache = false;
    }
    private function createRedis(){

        $di = DI::getDefault();
        return $di['redis'];

    }
}