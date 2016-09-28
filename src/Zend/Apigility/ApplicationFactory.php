<?php
namespace Alteris\BehatApigilityExtension\Zend\Apigility;

use Alteris\BehatZendframeworkExtension\Zend\ApplicationFactoryInterface;
use Zend\Mvc\ApplicationInterface;
use ZF\Apigility\Application;

class ApplicationFactory implements ApplicationFactoryInterface
{
    const NAME = 'apigility_application';

    /**
     * @var string
     */
    private $configurationPath;

    /**
     * ApplicationFactory constructor.
     * @param string $configurationPath
     */
    public function __construct($configurationPath)
    {
        $this->configurationPath = $configurationPath;
    }

    /**
     * @return ApplicationInterface
     */
    public function factory()
    {
        $appConfigPath = $this->getConfigurationPath();
        if (!defined('APPLICATION_PATH')) {
            define('APPLICATION_PATH', realpath(dirname($appConfigPath) . '/../'));
        }

        $appConfig = include APPLICATION_PATH . '/config/application.config.php';

        if (file_exists(APPLICATION_PATH . '/config/development.config.php')) {
            $appConfig = \Zend\Stdlib\ArrayUtils::merge($appConfig,
                include APPLICATION_PATH . '/config/development.config.php');
        }

        $app = Application::init($appConfig);

        $events = $app->getEventManager();
        $app->getServiceManager()->get('SendResponseListener')->detach($events);

        return $app;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * @return array
     */
    private function getConfigurationPath()
    {
        $path = isset($this->configurationPath) ? $this->configurationPath : '';

        if (!file_exists($path)) {
            throw new \RuntimeException(sprintf("Invalid path to configuration: '%s'", $path));
        }

        return $path;
    }
}