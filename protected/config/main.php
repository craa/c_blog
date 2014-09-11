<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'crains',
    'defaultController'=>'posts/article',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'application.components.widgets.*', //小部件
        'ext.giix-components.*', // giix components
        'ext.ueditor.*',//ueditor插件
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
            'generatorPaths' => array(
                'ext.giix-core', // giix generators
            ),
			'password'=>'cblog',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
        'posts',
        'Uconsole',
        'weixin'=>array(
            'class'=>'ext.weixin.WeixinModule',
            'token'=>'chenhongwei',
        ),

	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'urlSuffix'=>'.html',
			'rules'=>array(
                'article-<id:\d+>'=>'posts/article/detail',
                'article-list-<page:\d+>'=>'posts/article/list',
                '/'=>'posts/article/list',
                'article-list'=>'posts/article/list',
                'universe'=>'Uconsole/console/index',
                'category/<category:\w+>-<page:\d+>'=>'posts/article/clist',
                'category/<category:\w+>'=>'posts/article/clist',
                'tag/<tag:\w+>-<page:\d+>'=>'posts/article/tlist',
                'tag/<tag:\w+>'=>'posts/article/tlist',
                //'Uconsole/*'=>'site/index',
                //'universe/<controller:\w+>/<action:\w+>'=>'Uconsole/<controller>/<action>',
			),
		),
        /*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database

		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=cblog',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
            'tablePrefix' => 'c_',
			'charset' => 'utf8',
            'enableProfiling'=>true,
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			//'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
                ####################调试sql可开启###################
//                array(
//                    'class'=>'CWebLogRoute',
//                    'levels'=>'error, warning, info',
//                ),
//                array(
//                    'class'=>'CProfileLogRoute',
//                    'levels'=>'trace',
//                    'categories'=>'system.db.*' //只显示关于数据库信息,包括数据库连接,数据库执行语句
//                ),
//                array(
//                    'class'=>'CWebLogRoute',
//                    'levels'=>'trace',
//                    'categories'=>'system.db.*' //只显示关于数据库信息,包括数据库连接,数据库执行语句
//                )

			),
		),
        'cache'=>array(
            'class'=>'system.caching.CDummyCache',
            //'class'=>'system.caching.CFileCache',
//            'class'=>'system.caching.CMemCache',
//            'servers'=>array(
//                array('host'=>'localhost', 'port'=>11211, 'weight'=>100),
//            ),
        ),
    ),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),

    // controller map, quickly request some controller
    'controllerMap'=>array(
        'ueditor'=>array(
            'class'=>'ext.ueditor.UeditorController',
        ),
    ),
);