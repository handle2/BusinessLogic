<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2017.01.09.
 * Time: 9:42
 */

namespace Modules\BusinessLogic\Search;


use Modules\BusinessLogic\ContentSettings\Label;
use Modules\BusinessLogic\Models\Labels;

class LabelSearch extends BaseSearch
{

    public $name;
    
    public $code;
    
    public $ids;

    /**
     * @return LabelSearch
     */
    public static function createLabelSearch(){

        $search = new LabelSearch();
        $search->model = new Labels();
        /**@var Label $object*/
        $search->object = new Label();
        return $search;
    }

    /**
     * @return array
     */
    public function _readSearch(){

        $params = parent::_readSearch();

        return $params;
    }

}