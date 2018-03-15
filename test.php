<?php

$router = new \Phalcon\Mvc\Router();

$router->add(
    "/",
    array(
    	"controller" => "documentation",
    	"action"     => "show",
    )
);

$router->handle();

echo $router->getControllerName();