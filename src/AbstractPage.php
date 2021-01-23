<?php
declare(strict_types=1);

namespace ThenLabs\Bundle\StratusBundle;

use ThenLabs\StratusPHP\AbstractPage as AbstractStratusPage;
use ThenLabs\StratusPHP\Annotation\Sleep;
use ThenLabs\StratusPHP\Plugin\PageDom\PageDomTrait;
use ThenLabs\StratusPHP\Plugin\SElements\SElementsTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Twig\Environment as TwigEnvironment;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\AnnotationReader;
use ReflectionClass;

AnnotationRegistry::registerFile(__DIR__.'/Annotation/StratusPage.php');

/**
 * @author Andy Daniel Navarro Taño <andaniel05@gmail.com>
 * @abstract
 */
abstract class AbstractPage extends AbstractStratusPage
{
    use PageDomTrait;
    use SElementsTrait;

    /**
     * @var AbstractController
     *
     * @Sleep
     */
    protected $controllerInstance;

    /**
     * @var ControllerProxy
     *
     * @Sleep
     */
    protected $controller;

    /**
     * @var Environment
     *
     * @Sleep
     */
    protected $twig;

    public function __construct()
    {
        parent::__construct('', false);
    }

    /**
     * @return AbstractController
     */
    public function getController(): AbstractController
    {
        return $this->controllerInstance;
    }

    /**
     * @param AbstractController $controller
     */
    public function setController(AbstractController $controller): void
    {
        $this->controllerInstance = $controller;
        $this->controller = new ControllerProxy($controller);
    }

    /**
     * @return TwigEnvironment
     */
    public function getTwig(): TwigEnvironment
    {
        return $this->twig;
    }

    /**
     * @param TwigEnvironment $twig
     */
    public function setTwig(TwigEnvironment $twig): void
    {
        $this->twig = $twig;
    }

    /**
     * @inheritdoc
     */
    public function getView(array $params = []): string
    {
        $class = new ReflectionClass($this);
        $annotationReader = new AnnotationReader;

        $stratusPageAnnotation = $annotationReader->getClassAnnotation(
            $class,
            Annotation\StratusPage::class
        );

        return $this->twig->render($stratusPageAnnotation->template, $params);
    }
}
