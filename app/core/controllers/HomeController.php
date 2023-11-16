<?php

namespace core\controllers;
use core\models\Product;
use core\views\View;
class HomeController
{
    public $view;
    public function responseHome()
    {
         $this->view = new View();
        // $data = new Product();
        // $records = $data->readProducts();
        $this->view->responseJson(array("dr"));
//        $this->view = new View();
//        $this->view->responseJson(array('message'=>'this home page'));
    }
    public function addProduct()
    {
        $this->view = new View();
        $product = new Product();
        $data = $_POST;


        if(
            !empty($data['name'])&&
            !empty($data['price'])&&
            !empty($data['description'])&&
            !empty($data['category_id'])
        ){
            $product->name = $data['name'];
            $product->price = $data['price'];
            $product->description = $data['description'];
            $product->category_id = $data['category_id'];
            $product->created = date('Y-m-d H:i:s' );
            if($product->createdProduct())
            {

                $this->view->responseJson(array('message'=>'success'),201);
            }else{

                $this->view->responseJson(array('message'=>'error add'),503);
            }
        }else{
            $this->view->responseJson(array('message'=>'input was empty'),400);
        }

    }
}