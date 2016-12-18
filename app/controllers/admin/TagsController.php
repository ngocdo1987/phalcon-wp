<?php
class TagsController extends AdminController
{
    public function indexAction()
    {
    	$this->view->mt = 'List tags';
    }

    public function addAction()
    {
    	$this->view->mt = 'Add tag';
    }
}