<?php
declare(strict_types=1);

namespace ThenLabs\Bundle\StratusBundle;

use ThenLabs\StratusPHP\AbstractPage as AbstractStratusPage;
use ThenLabs\StratusPHP\Annotation\Sleep;
use ThenLabs\StratusPHP\Plugin\PageDom\PageDomTrait;
use ThenLabs\StratusPHP\Plugin\SElements\SElementsTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Twig\Environment as TwigEnvironment;
use ReflectionClass;

/**
 * @author Andy Daniel Navarro Taño <andaniel05@gmail.com>
 * @abstract
 */
abstract class AbstractPage extends AbstractStratusPage
{
    use PageDomTrait;
    use SElementsTrait;

    /**
     * @var ControllerProxy
     *
     * @Sleep
     */
    protected $controller;

    public function __construct()
    {
        parent::__construct('', false);
    }

    /**
     * @return AbstractController
     */
    public function getController(): AbstractController
    {
        return $this->controller->getInstance();
    }

    /**
     * @param AbstractController $controller
     */
    public function setController(AbstractController $controller): void
    {
        $this->controller = new ControllerProxy($controller);
    }
}
