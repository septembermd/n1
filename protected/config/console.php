<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return [
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',

	// preloading 'log' component
	'preload'=> ['log'],

	// application components
	'components'=> [
		'db'=> [
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
        ],
		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
		'log'=> [
			'class'=>'CLogRouter',
			'routes'=> [
				[
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
                ],
            ],
        ],
    ],
];