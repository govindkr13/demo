<?php

namespace core;

class Controller
{
    public $layout = 'main';

    private $view;


    public function getView()
    {
        if ($this->view === null) {
            $this->view = App::$app->view;
        }
        return $this->view;
    }

    public function render($view, $params = []): string
    {
        return $this->getView()->render($view, $params);
    }

    public function renderPartial($view, $params = []): string
    {
        return $this->getView()->renderPartial($view, $params);
    }
}