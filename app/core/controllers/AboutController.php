<?php

namespace core\controllers;

use core\models\Product;
use core\views\View;


abstract class D{
    public $a;
    abstract public static function dayInfo():array;
}
class AboutController extends D
{
    public $view;

    public static function dayInfo():array{
        return [0,0,0,0,0];
    }

    public function __construct()
    {
        $this->view = new View();
    }

    public function responseAbout(int $id)
    {
        $one = new Product();
        $row = $one->aboutOne($id);
        if($row != null){
            http_response_code(200);
            $this->view->responseJson($row);
        }else{
            http_response_code(404);
            $this->view->responseJson(array("message"=>"this info not found"));
        }

    }
    public function responseRedact(int $id)
    {

        $redact = new Product();
        $data = json_decode(file_get_contents('php://input'));
        $redact->id = $id;
        $redact->name = $data->name;
        $redact->price =$data->price;
        $redact->description = $data->description;
        $redact->category_id = $data->category_id;
        $res = $redact->update($id);
        if(!$res)
        {
            http_response_code(200);
            echo json_encode(array("message"=>"ok"));
        }else{
            http_response_code(503);
            echo json_encode(array("message"=>"error update"));
        }
    }
    public function deleteProduct(int $id)
    {

        $delete = new Product();
        $delete->deleteProd($id);
        //$one = $delete->aboutOne($id);
        http_response_code(200);
        $this->view->responseJson(array("message"=>"ok"));

    }
}