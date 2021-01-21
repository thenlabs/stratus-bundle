<?php
declare(strict_types=1);

namespace ThenLabs\Bundle\StratusBundle;

use ThenLabs\StratusPHP\AbstractPage as AbstractStratusPage;
use ThenLabs\StratusPHP\Annotation\Sleep;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @author Andy Daniel Navarro Taño <andaniel05@gmail.com>
 * @abstract
 */
abstract class AbstractPage extends AbstractStratusPage
{
    /**
     * @var AbstractController
     *
     * @Sleep
     */
    protected $controller;

    /**
     * @return AbstractController
     */
    public function getController(): AbstractController
    {
        return $this->controller;
    }

    /**
     * @param AbstractController $controller
     */
    public function setController(AbstractController $controller): void
    {
        $this->controller = $controller;
    }
}
