<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2017.01.04.
 * Time: 22:22
 */

namespace Modules\BusinessLogic\Search;


use Modules\BusinessLogic\ContentSettings\Content;
use Modules\BusinessLogic\Models\Contents;

class ContentSearch extends BaseSearch
{
    
    public $ids;
    
    public $labels;

    public $url;

    /**
     * @return ContentSearch
     */
    public static function createContentSearch(){

        $search = new ContentSearch();
        $search->model = new Contents();
        /**@var Content $object*/
        $search->object = new Content();
        return $search;
    }

    /**
     * @return array
     */
    public function _readSearch(){

        $params = parent::_readSearch();
        if(isset($this->labels) && !empty($this->labels)){
            //db.test.find({_id: {$in: ids}});
            $params['labels'] = array('$in' => $this->labels);
        }
        if(!empty($this->url)){
            $params['url'] = $this->url;
        }
        return $params;
    }
}