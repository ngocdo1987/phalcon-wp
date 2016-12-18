<?php
class CategoriesController extends AdminController
{
    public function indexAction()
    {
    	$this->view->mt = 'List categories';
    }

    public function addAction()
    {
    	$this->view->mt = 'Add category';
    }
}