<?php
/**
 * YAWIK
 *
 * @filesource
 * @copyright (c) 2013 - 2016 Cross Solution (http://cross-solution.de)
 * @license       MIT
 */

namespace CompanyRegistrationTest\Factory\Controller;

use CompanyRegistration\Factory\Controller\RegisterControllerFactory;
use Auth\Options\ModuleOptions;
use Test\Bootstrap;
use Zend\Mvc\Controller\ControllerManager;

class RegisterControllerFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RegisterControllerFactory
     */
    private $testedObj;

    public function setUp()
    {
        $this->testedObj = new RegisterControllerFactory();
    }

    public function testCreateService()
    {
        $sm = clone Bootstrap::getServiceManager();
        $sm->setAllowOverride(true);

        $registerServiceMock = $this->getMockBuilder('Auth\Service\Register')
            ->disableOriginalConstructor()
            ->getMock();

        $loggerMock = $this->getMockBuilder('Zend\Log\LoggerInterface')->getMock();
        
        $options = new ModuleOptions();

        $sm->setService('Auth\Service\Register', $registerServiceMock);
        $sm->setService('Core/Log', $loggerMock);
        $sm->setService('Auth/ModuleOptions', $options);

        $controllerManager = new ControllerManager($sm);

        $result = $this->testedObj->createService($controllerManager);

        $this->assertInstanceOf('CompanyRegistration\Controller\RegistrationController', $result);
    }
}
