<?php

require_once "app/Views/users.template.php";
require_once "vendor/autoload.php";

use App\UserController\UserController;
use App\DataController\DataController;
use League\Csv\Writer;
use League\Csv\Reader;
use League\Csv\Statement;


$csv = Reader::createFromPath("ToDoList.csv", "r");
$csv->setDelimiter(";");
$csv->setHeaderOffset(0);

$stat = Statement::create()
    ->offset(0)

;
$records = $stat->process($csv);
foreach ($records as $record)
{
    echo $record['todo'];
}
$csv = Writer::createFromPath("ToDoList.csv", "r");
$todo = $_POST['todo'];
$csv->insertAll($todo);
echo $todo;

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', 'UserController');
    $r->addRoute('POST', '/', 'UserController@create');
    $r->addRoute('GET', '/hello', 'DataController@DataIndex');
    $r->addRoute('POST', '/hello', 'DataController');

});


// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        var_dump("seit");
        echo "EE";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        var_dump("vai seit");
        break;

    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        // ... call $handler with $vars
        [$controller, $method] = explode('@', $handler);
        $controller = "App\Controller\\" . $handler;
        $controller = new $controller;
        $controller->$method();
        var_dump($controller);
        $controller = new UserController;
        $controller->index();
        var_dump($controller);
        $controller = new DataController;
        $controller->DataIndex();
        break;
}