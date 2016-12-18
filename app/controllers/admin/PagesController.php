<?php
class PagesController extends AdminController
{
    public function indexAction()
    {
    	$this->view->mt = 'List pages';
    }

    public function addAction()
    {
    	$this->view->mt = 'Add page';
    }
}