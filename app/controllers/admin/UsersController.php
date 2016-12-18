<?php

use Phalcon\Mvc\Controller;

class UsersController extends Controller
{
    public function initialize()
    {
        $this->view->setTemplateAfter("login");
    }

    public function indexAction()
    {
    	if($this->session->has("admin")) 
    	{
    		echo $this->session->get("admin")."<br/>";
    		die('Logged in!');
    	}
    	else
    	{
    		die('Please login!');
    	}
    }

    public function loginAction()
    {
    	
    	$this->view->mt = 'Login';
    }

    public function registerAction()
    {
    	$this->view->mt = 'Register';
    }

    public function logoutAction()
    {

    }

    public function fakeloginAction()
    {
    	$this->session->set("admin", "Ngoc Do");
    	die('Fake login successfully!');
    }

    public function fakelogoutAction()
    {
    	$this->session->destroy();
    	die('Fake logout successfully!');
    }
}