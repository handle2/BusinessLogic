<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2016.12.06.
 * Time: 21:41
 */

namespace Modules\BusinessLogic\Search;

use Modules\BusinessLogic\ContentSettings;
use Modules\BusinessLogic\Models;

class RoleSearch extends BaseSearch
{
    public $id;
    public $code;
    public $type;
    public $name;
    
    public static function createRoleSearch(){
        
        $search = new RoleSearch();
        $search->model = new Models\Roles();
        /**@var \Modules\BusinessLogic\ContentSettings\Role $object*/
        $search->object = new ContentSettings\Role();
        return $search;
    }

    public function _readSearch(){
        $params = parent::_readSearch();

        if($this->type){
            $params['type'] = $this->type;
        }

        return $params;
    }

}