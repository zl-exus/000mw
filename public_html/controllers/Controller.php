<?php

class Controller
{

    public $model;
    public $view;
    protected $pageData = [];

    public function __construct()
    {
        $this->model = new Model();
        $this->view = new View();
    }
}
