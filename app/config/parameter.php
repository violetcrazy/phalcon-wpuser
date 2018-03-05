<?php

$parameter = array(
	'base_path' => '',
	'base_uri' => 'http://order.crm/',
	'loader' => array(
		'namespaces' => array(
			'Plugin' => ROOT . '/plugins/',
			'Core' => ROOT . '/app/modules/Core/',
			'User' => ROOT . '/app/modules/User/',
		)
	),
	'modules' => array(
        "user" => array(
            "className" => 'User\\Module',
            "path"      => ROOT . '/app/modules/User/Module.php',
        ),
        "core" => array(
            "className" => 'Core\\Module',
            "path"      => ROOT . '/app/modules/Core/Module.php',
        ),
    ),
	'db' => array(
		'debug'    => false,
        'host'     => 'localhost',
        'port'     => '3306',
        'username' => 'root',
        'password' => '',
        'dbname'   => 'w1',
        'charset'  => 'utf8'
	),
	'volt' => array(
        'debug'              => true,
        'stat'               => true,
        'compiled_separator' => '%'
    ),
);