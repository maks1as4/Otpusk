<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Марка',
	'language'=>'ru',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.components.ImageHandler.CImageHandler',
	),

	'modules'=>array(
		'admin',
		/*'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'pd4g11',
			'ipFilters'=>array('79.172.27.132'),
		),*/
	),

	// application components
	'components'=>array(

		'authManager'=>array(
			'class'=>'PhpAuthManager',
			'defaultRoles'=>array('guest'),
		),

		'user'=>array(
			'class'=>'WebUser',
			'loginUrl'=>array('users/login'),
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),

		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'showScriptName'=>false,
			'urlFormat'=>'path',
			'rules'=>require(dirname(__FILE__).'/url.php'),
		),

		'db'=>array(
			'connectionString'=>'mysql:host=localhost;dbname=otpusk-ekb',
			'emulatePrepare'=>true,
			'username'=>'marka',
			'password'=>'WelukAtOB6',
			'charset'=>'utf8',
			'tablePrefix'=>'pr4ote_',
		),

		/*'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),*/

		// jquery
		'clientScript'=>array(
			'scriptMap'=>array(
				'jquery.js'=>'/js/jquery-1.10.2.min.js',
			)
		),

		// security
		'request'=>array(
			//'enableCsrfValidation'=>true,
			'enableCookieValidation'=>true,
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),

	),

	'params'=>require(dirname(__FILE__).'/params.php'),
);