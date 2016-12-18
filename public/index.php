<?php
// https://docs.phalconphp.com/en/latest/reference/xampp.html
// Phalcon for PHP 7 TS x86
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Session\Adapter\Files as Session;


// Register an autoloader
$loader = new Loader();

$loader->registerDirs(
    [
        "../app/controllers/",
        "../app/controllers/admin/",
        "../app/models/",
    ]
);

$loader->register();



// Create a DI
$di = new FactoryDefault();

// Setup the view component
$di->set(
    "view",
    function () {
        $view = new View();

        $view->setViewsDir("../app/views/");
        //$view->setViewsDir("../app/views/admin/");

        return $view;
    }
);

// Setup a base URI so that all generated URIs include the "tutorial" folder
$di->set(
    "url",
    function () {
        $url = new UrlProvider();

        $url->setBaseUri("/");

        return $url;
    }
);

// Setup the database service
$di->set(
    "db",
    function () {
        return new DbAdapter(
            [
                "host"     => "localhost",
                "username" => "root",
                "password" => "",
                "dbname"   => "fw_phalcon",
            ]
        );
    }
);

// Start the session the first time when some component request the session service
$di->setShared(
    "session",
    function () {
        $session = new Session();

        $session->start();

        return $session;
    }
);

// Handle errors
$di->set(
    'dispatcher',
    function() use ($di) {
        $eventsManager = $di->getShared('eventsManager');
        $eventsManager->attach(
            'dispatch:beforeException',
            function($event, $dispatcher, $exception) {
                switch ($exception->getCode()) {
                    case Dispatcher::EXCEPTION_HANDLER_NOT_FOUND:
                    case Dispatcher::EXCEPTION_ACTION_NOT_FOUND:
                        $dispatcher->forward(
                            array(
                                'controller' => 'error',
                                'action' => 'notFound',
                            )
                        );
                        return false;
                        break; // for checkstyle
                    default:
                        $dispatcher->forward(
                            array(
                                'controller' => 'error',
                                'action' => 'uncaughtException',
                            )
                        );
                        return false;
                        break; // for checkstyle
                }
            }
        );
        $dispatcher = new Dispatcher();
        $dispatcher->setEventsManager($eventsManager);
        return $dispatcher;
    },
    true
);

$application = new Application($di);

try {
    // Handle the request
    $response = $application->handle();

    $response->send();
} catch (\Exception $e) {
    echo "Exception: ", $e->getMessage();
}