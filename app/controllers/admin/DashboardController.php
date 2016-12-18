<?php
class DashboardController extends AdminController
{
    public function indexAction()
    {
    	$this->view->mt = 'Dashboard';
    }
}