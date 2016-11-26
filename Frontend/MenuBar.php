<?php

namespace Modules\BusinessLogic\Frontend;

use Modules\BusinessLogic\ContentSettings;
use Modules\BusinessLogic\Models as Models;
use Phalcon\Mvc\Controller;

class MenuBar extends Controller
{
    private $_contents = array();
    private $_products = array();
    
    public static function contentManager($labels)
    {
        $menubar = new MenuBar();
        $menubar->_contents = ContentSettings\Content::createByLabels($labels);
        return $menubar;
    }
    
    public function render($template){
        $this->view->partial($template,array('menu'=>$this->_contents,'products'=>$this->_products));
    }
    public function getProducts($categ){
        $this->_products = ContentSettings\Product::getProductsByCateg($categ);
    }
    
}