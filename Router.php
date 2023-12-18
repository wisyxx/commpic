<?php

namespace MVC;

class Router
{
    public $GET = [];
    public $POST = [];

    public function get($url, $fn)
    {
        $this->GET[$url] = $fn;
    }
    public function post($url, $fn)
    {
        $this->POST[$url] = $fn;
    }

    public function checkRoutes()
    {
        $actualRoute = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $fn = $this->GET[$actualRoute] ?? null;
        } else {
            $fn = $this->POST[$actualRoute] ?? null;
        }

        if ($fn) {
            call_user_func($fn, $this);
        } else {
            echo 'Page not found';
        }
    }

    public function render($view, $data) {
        foreach($data as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once __DIR__ . "/views/$view.php";

        $content = ob_get_clean();

        include_once __DIR__ . '/views/layout.php';
    }
}
