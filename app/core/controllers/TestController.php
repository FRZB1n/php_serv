<?php

namespace core\controllers;
use core\models\Product;
use core\views\View;


class TestController{
    public $view;
    public function REsponseTEst()
    {
     

        // $data = new Product();
        // $records = $data->readProducts();
        $this->view->responseJson(array("dr from TEst controller"));
//        $this->view = new View();
//        $this->view->responseJson(array('message'=>'this home page'));
    }
}