<?php

// Load passwords file
require(dirname(__FILE__).'/passwords.php');

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Base Web Application',
	
	// used for messages
	'language'=>'en',
	
	// preloading 'log' component
	'preload'=>array('log'),

	'aliases'=>array(
		'bootstrap'=>'application.extensions.bootstrap',
	),

	// autoloading model and component classes
	'import'=>array(
		'application.components.*',
		'application.models.*',
		'application.models.behaviors.*',
		'application.models.forms.*',
		'ext.mail.YiiMailMessage',
		'bootstrap.helpers.*',
		'bootstrap.behaviors.*',
		'bootstrap.widgets.*',
	),
	
	'modules'=>array(
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'generatorPaths'=>array('bootstrap.gii'),
			'password'=>'Enter Your Password Here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		*/
	),

	// application components
	'components'=>array(
		'user'=>array(
			'class'=>'WebUser',
			'allowAutoLogin'=>true,
			'loginUrl'=>array('/user/login'),
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
				'<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
			),
		),
		'db'=>array(
			'class'=>'DbConnection', // Transactional history logging
			'connectionString'=>'mysql:host=localhost;dbname=base',
			'emulatePrepare'=>true,
			'username'=>'base',
			'password'=>PW_DB_LIVE_BASE,
			'charset'=>'utf8',
		),
		'mail'=>array(
			'class'=>'ext.mail.YiiMail',
			'transportType'=>'smtp',
			'transportOptions'=>array(
				'host'=>MAIL_SYSTEM_HOST,
				'port'=>MAIL_SYSTEM_PORT,
				'username'=>MAIL_SYSTEM_USER,
				'password'=>PW_MAIL_SYSTEM,
			),
			'viewPath'=>'application.views.mail',
			'logging'=>true,
			'dryRun'=>false,
		),
		'clientScript'=>array(
			'scriptMap'=>array(
				'jquery.js'=>'/lib/jquery/js/jquery-1.11.0.min.js',
				'jquery.min.js'=>'/lib/jquery/js/jquery-1.11.0.min.js',
				'jquery-ui.js'=>'/lib/jquery/js/jquery-ui-1.10.4.min.js',
				'jquery-ui.min.js'=>'/lib/jquery/js/jquery-ui-1.10.4.min.js',
				'jquery.ba-bbq.js'=>'/lib/jquery/plugins/ba-bbq/jquery.ba-bbq.min.js',
				'jquery.ba-bbq.min.js'=>'/lib/jquery/plugins/ba-bbq/jquery.ba-bbq.min.js',
			),
			'packages'=>array(
				'jquery'=>array(
					'baseUrl'=>'/lib/jquery',
					'js'=>array('js/jquery-1.11.0.min.js'),
				),
				'jquery.ui'=>array(
					'baseUrl'=>'/lib/jquery',
					'js'=>array('js/jquery-ui-1.10.4.min.js'),
					'css'=>array('css/base/jquery-ui-1.10.4.min.css'),
					'depends'=>array('jquery'),
				),
				'bootstrap'=>array(
					'baseUrl'=>'/lib/bootstrap-3.1.1',
					'js'=>array('js/bootstrap.min.js'),
					'css'=>array('css/bootstrap.min.css', 'css/bootstrap-theme.min.css', '../../css/bootstrap-yii.css'),
					'depends'=>array('jquery'),
				),
			),
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
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
		'session'=>array(
			'class'=>'CDbHttpSession',
			'connectionID'=>'db',
			'timeout'=>14400,
		),
		'bootstrap'=>array(
			'class'=>'bootstrap.components.TbApi',
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		'companyName'=>'Software Corp',
		'authentication'=>array(
			'rememberMe'=>array(
				'duration'=>2592000, // 30 days
			),
			'accountLocking'=>array(
				'failedLogins'=>20, // Lock account after 20 consecutive failed logins
			),
		),
		'mail'=>array(
			'accounts'=>array(
				'system'=>array(
					'name'=>'Software Corp',
					'address'=>MAIL_SYSTEM_ADDR,
				),
			),
		),
	),
);