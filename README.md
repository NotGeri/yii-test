# ⚠ Disclaimer

This is to test an issue with Yii & Sentry, all credit goes to the original creator: https://github.com/Izzur/example-yii1 

---

---

# 🙏 Update
This was very quickly patched by the kind people over at Sentry: https://github.com/getsentry/sentry-php/pull/1401 & https://github.com/getsentry/sentry-php/releases/tag/3.9.1

# ✨ Replication Steps
1. Clone the repository `git clone https://github.com/NotGeri/yii-test.git`
2. In the `./protected/config/main.php`, set up a Sentry DSN link under `params.sentry_dsn`.
3. Start up some PHP webserver, such a basic Nginx configuration
4. Go to `http://<your webserver>/index.php?r=site/sentry`
5. See the error it produces:

```
[php] include(test1.php): failed to open stream: No such file or directory (/protected/yii/YiiBase.php:463)               
Stack trace:                                                                                                                                                                  
#0 /protected/yii/YiiBase.php(463): Sentry\ErrorHandler->handleError()                                                                                
#1 /protected/yii/YiiBase.php(463): include()                                                                                                         
#2 unknown(0): autoload()                                                                                                                                                     
#3 unknown(0): spl_autoload_call()                                                                                                                                            
#4 /protected/vendor/sentry/sentry/src/Serializer/AbstractSerializer.php(103): is_callable()                                                          
#5 /protected/vendor/sentry/sentry/src/Serializer/RepresentationSerializer.php(18): Sentry\Serializer\RepresentationSerializer->serializeRecursively()
#6 /protected/vendor/sentry/sentry/src/FrameBuilder.php(195): Sentry\Serializer\RepresentationSerializer->representationSerialize()                   
#7 /protected/vendor/sentry/sentry/src/FrameBuilder.php(90): Sentry\FrameBuilder->getFunctionArguments()
#8 /protected/vendor/sentry/sentry/src/StacktraceBuilder.php(57): Sentry\FrameBuilder->buildFromBacktraceFrame()
#9 /protected/vendor/sentry/sentry/src/StacktraceBuilder.php(40): Sentry\StacktraceBuilder->buildFromBacktrace()
#10 /protected/vendor/sentry/sentry/src/Client.php(353): Sentry\StacktraceBuilder->buildFromException()
#11 /protected/vendor/sentry/sentry/src/Client.php(251): Sentry\Client->addThrowableToEvent()
#12 /protected/vendor/sentry/sentry/src/Client.php(175): Sentry\Client->prepareEvent()
#13 /protected/vendor/sentry/sentry/src/Client.php(167): Sentry\Client->captureEvent()
#14 /protected/vendor/sentry/sentry/src/State/Hub.php(138): Sentry\Client->captureException()
#15 /protected/vendor/sentry/sentry/src/Integration/AbstractErrorListenerIntegration.php(25): Sentry\State\Hub->captureException()
#16 /protected/vendor/sentry/sentry/src/State/Hub.php(93): Sentry\Integration\ExceptionListenerIntegration->Sentry\Integration\{closure}()
#17 /protected/vendor/sentry/sentry/src/Integration/AbstractErrorListenerIntegration.php(26): Sentry\State\Hub->withScope()
#18 /protected/vendor/sentry/sentry/src/Integration/ExceptionListenerIntegration.php(32): Sentry\Integration\ExceptionListenerIntegration->captureException()
#19 /protected/vendor/sentry/sentry/src/ErrorHandler.php(420): Sentry\Integration\{closure}()
#20 /protected/vendor/sentry/sentry/src/ErrorHandler.php(346): Sentry\ErrorHandler->invokeListeners()
#21 unknown(0): Sentry\ErrorHandler->handleException()
REQUEST_URI=/index.php?r=site/sentry
in /protected/vendor/sentry/sentry/src/ErrorHandler.php (305)
in /protected/vendor/sentry/sentry/src/Serializer/AbstractSerializer.php (103)
in /protected/vendor/sentry/sentry/src/Serializer/RepresentationSerializer.php (18)
```

The action causing this can be found [here](https://github.com/NotGeri/yii-test/tree/master/protected/controllers/SiteController.php#L40):

```php
public function reflect($arg1, $arg2)
{
    throw new Exception();
}

public function actionSentry()
{
    $reflect = new ReflectionMethod($this, 'reflect');
    $reflect->invokeArgs($this, ['test1', 'test2']);
}
```

Sentry is set up [here](https://github.com/NotGeri/yii-test/tree/master/protected/components/CustomSentry.php)!
