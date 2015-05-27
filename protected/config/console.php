<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return [
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Delivery #1 Console Application',

	// preloading 'log' component
	'preload'=> ['log'],

    'import'=> [
        'application.models.*',
        'application.components.*',
    ],

	// application components
	'components'=> [
        'db'=> [
            'connectionString' => 'mysql:host=127.0.0.1;dbname=number1',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
            'tablePrefix' => '',
        ],
		'log'=> [
			'class'=>'CLogRouter',
			'routes'=> [
				[
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning, info',
                ],
            ],
        ],
        'mailer' => [
            'class' => 'application.vendor.ikirux.yii-swift-mailer.src.SwiftMailer',
            'mailer' => 'sendmail',
            'from' => 'mdseptember@gmail.com',
            'activateLoggerPlugin' => true,
        ],
    ],
];