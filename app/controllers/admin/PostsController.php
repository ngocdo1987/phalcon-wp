<?php
class PostsController extends AdminController
{
    public function indexAction()
    {
    	$this->view->mt = 'List posts';
    }

    public function addAction()
    {
    	$this->view->mt = 'Add post';
    }
}