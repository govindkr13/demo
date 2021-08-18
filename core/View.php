<?php

namespace core;


class View
{
    public $title = '';

    public function render($view, array $params)
    {
        $layout = App::$app->controller->layout;
        $viewContent = $this->renderPartial($view, $params);
        ob_start();
        include_once App::$ROOT_DIR."/app/views/layout/$layout.php";
        $layoutContent = ob_get_clean();
        return str_replace('{{body}}', $viewContent, $layoutContent);
    }

    public function renderPartial($view, array $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once App::$ROOT_DIR."/app/views/$view.php";
        return ob_get_clean();
    }
}