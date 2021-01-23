<?php
declare(strict_types=1);

namespace ThenLabs\Bundle\StratusBundle;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use ReflectionClass;

/**
 * @author Andy Daniel Navarro Taño <andaniel05@gmail.com>
 */
class ControllerProxy
{
    /**
     * @var AbstractController
     */
    private $controller;

    /**
     * @param AbstractController $controller
     */
    public function __construct(AbstractController $controller)
    {
        $this->controller = $controller;
    }

    public function __call($methodName, $arguments)
    {
        if (is_callable([$this->controller, $methodName])) {
            return call_user_func_array([$this->controller, $methodName], $arguments);
        }

        $class = new ReflectionClass($this->controller);

        $method = $class->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($this->controller, $arguments);
    }

    public function getInstance(): AbstractController
    {
        return $this->controller;
    }
}
