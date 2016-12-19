<?php
class TestController extends AdminController
{
    public function indexAction()
    {
    	$this->view->mt = 'List HTML inputs';
    }
}