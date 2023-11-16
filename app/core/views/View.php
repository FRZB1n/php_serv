<?php

namespace core\views;

class View
{
    public function __construct()
    {
    }

    public function responseJson($data, int $status = 200)
    {
        http_response_code($status);
        echo json_encode($data);
    }
}