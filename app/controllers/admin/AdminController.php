<?php

use Phalcon\Mvc\Controller;

class AdminController extends Controller
{
    public function initialize()
    {
        $this->view->setTemplateAfter("admin");
    }
}