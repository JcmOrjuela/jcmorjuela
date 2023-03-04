<?php

namespace App;


class response
{

    protected $view;
    protected $errors;

    public function __construct($view, $errors = null)
    {
        $this->view = $view;
        $this->errors = $errors;
    }

    public function getView()
    {
        return $this->view;
    }

    public function send()
    {
        $view = $this->getView();
        $errors = $this->errors;
        $content = viewPath($view);
        
        if (!file_exists($content)) {
            $content = viewPath('404');
        }
        require viewPath('index');
    }
}
