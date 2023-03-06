<?php

namespace App;


class response
{

    protected $view;
    protected $errors;
    protected $params  = [];

    public function __construct($view, $params = [], $errors = null)
    {
        $this->view = $view;
        $this->errors = $errors;
        $this->params = $params;
    }

    public function getView()
    {
        return $this->view;
    }

    public function send()
    {
        $errors = $this->errors;
        extract($this->params);

        $view = $this->getView();
        $content = viewPath($view);

        if (!file_exists($content)) {
            $content = viewPath('404');
        }
        
        require viewPath('index');
    }
}
