<?php


namespace core;

use Exception;
use thecodeholic\phpmvc\exception\NotFoundException;


class Router
{
    private $request;
    private $response;
    private $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get(string $url, $callback)
    {
        $this->routes['get'][$url] = $callback;
    }

    public function post(string $url, $callback)
    {
        $this->routes['post'][$url] = $callback;
    }

    public function resolve()
    {
        $method = $this->request->getMethod();
        $url = $this->request->getUrl();
        $callback = $this->routes[$method][$url] ?? false;
        
        
        if (!$callback) {
            throw new Exception('Something went wrong');
        }
        if (is_string($callback)) {
            
            return $this->render($callback);
        }

        if (is_array($callback)) {
            $controller = new $callback[0];
            $controller->action = $callback[1];
            App::$app->controller = $controller;
            $callback[0] = $controller;
        }

        return call_user_func($callback, $this->request, $this->response);
    }

    public function render($view, $params = [])
    {
        return App::$app->view->render($view, $params);
    }

    public function renderPartial($view, $params = [])
    {
        return App::$app->view->renderPartial($view, $params);
    }
}