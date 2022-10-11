<?php

use function Sentry\init;

class CustomSentry
{
    function init()
    {
        $dsn = Yii::app()->params['sentry_dsn'] ?? null;
        if (!$dsn) {
            Yii::log('No Sentry DSN loaded in main.php, disabling Sentry..', CLogger::LEVEL_WARNING);
            return;
        }

        try {
            init([
                'dsn' => $dsn
            ]);
            Yii::log('Sentry loaded', CLogger::LEVEL_TRACE);
        } catch (Exception $e) {
            Yii::log("Failed to load Sentry: $e", CLogger::LEVEL_ERROR);
        }
    }

}