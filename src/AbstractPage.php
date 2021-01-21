<?php
declare(strict_types=1);

namespace ThenLabs\Bundle\StratusBundle;

use ThenLabs\StratusPHP\AbstractPage as AbstractStratusPage;
use ThenLabs\StratusPHP\Annotation\Sleep;
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
    /**
     * @var AbstractController
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
        parent::__construct('');
    }

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
            $class, Annotation\StratusPage::class
        );

        return $this->twig->render($stratusPageAnnotation->template, $params);
    }
}
