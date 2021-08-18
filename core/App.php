<?php


namespace core;



class App
{


    public static $app;
    public static $ROOT_DIR;

    public $router;
    public $request;
    public $response;
    public $view;
    public $controller = null;

    public function __construct($rootDir, $config = [])
    {
        self::$app = $this;
        self::$ROOT_DIR = $rootDir;
        
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        // echo '<pre>'; print_r($config['db']); die;
        $this->db = new Db($config['db']);
        $this->view = new View();
    }


    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
