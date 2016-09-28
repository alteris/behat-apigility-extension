Behat Apigility integration
===========================

This extension extends [Alteris\BehatZendframeworkExtension](https://github.com/alteris/behat-zendframework-extension) to work with Apigility and [Behat](http://behat.org/en/latest/) ^3.1.

## Installing extension

The easiest way to install is by using [Composer](https://getcomposer.org):

```bash
$> curl -sS https://getcomposer.org/installer | php
$> php composer.phar require alteris/behat-apigility-extension='~1.0'
```

or composer.json

    "require": {
        "alteris/behat-apigility-extension": "~1.0"
    },

## Configuration

You can then activate the extension in your ``behat.yml``. Need to use parameter ``type`` to change Application factory to Apigility and defaine both Extensions:

        default:
            # ...
            extensions:
                Alteris\BehatApigilityExtension\ServiceContainer\Extension: ~
                Alteris\BehatZendframeworkExtension\ServiceContainer\Extension:
                    configuration: PATH_TO_application.config.php
                    type: apigility_application
                    
## Injecting Application

Your context need to implement ``Alteris\BehatZendframeworkExtension\Context\ContextAwareInterface`` and will be intialized with ``Zend\Mcv\ApplicationInterface``;
                    
## Base documentation

See [Zend framework Extension](https://github.com/alteris/behat-zendframework-extension)
    
## Versioning

Staring version ``1.0.0``, will follow [Semantic Versioning v2.0.0](http://semver.org/spec/v2.0.0.html).

## Contributors

* [Tomasz Kunicki](https://github.com/timiTao) 