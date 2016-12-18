<?php
use Phalcon\Mvc\Controller;

class ErrorController extends Controller
{
	public function initialize()
    {
        $this->view->setTemplateAfter("admin");
    }

    public function notFoundAction()
    {
        // The response is already populated with a 404 Not Found header.
        $this->view->mt = 'Page Not Found';
    }

    public function uncaughtExceptionAction()
    {
        // You need to specify the response header, as it's not automatically set here.
        $this->response->setStatusCode(500, 'Internal Server Error');
    }
}