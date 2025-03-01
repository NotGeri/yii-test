<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'My Web Application',

    // preloading 'log' component
    'preload' => array('log', 'sentry'),

    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),

    'modules' => array(),

    // application components
    'components' => array(
        'sentry' => array(
            'class' => 'CustomSentry',
        ),

        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),

        // database settings are configured in database.php
        'db' => require(dirname(__FILE__) . '/database.php'),

        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => YII_DEBUG ? null : 'site/error',
        ),

        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'info, warning',
                    'logFile' => 'application.log'
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error',
                    'logFile' => 'error.log'
                )
            )
        )
    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        'adminEmail' => 'webmaster@example.com', // This is used in contact page
        'sentry_dsn' => null, // <-- Your link here!
    ),
);
