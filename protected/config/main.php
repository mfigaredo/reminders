<?php
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Scheduled Reminders',
    'import'=>array(
        'application.models.*',
    ),
    'components'=>array(
        'db'=>array(
        //    'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/locations.db',
            'class' => 'CDbConnection',
            'connectionString' => 'mysql:host=127.0.0.1;dbname=yii_ch3_reminders',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'mysql',
            'charset' => 'utf8',
            'schemaCachingDuration' => '3600'
        ),
        'urlManager'=>array(
            'urlFormat'=>'path',
            'showScriptName'=>false,
            'rules'=>array(
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                'event/date/<date:[\w-]+>' => 'event/index',
                '/' => 'event/index',
            ),
        ),
        'cache' => array(
            'class' => 'CFileCache',
        ),
    ),
    'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>false,
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			// 'ipFilters'=>array('none'),  // disable access
		),
		
	),
    'params' => array(
        'smtp' => require __DIR__ . '/params.php',
    ),
);
