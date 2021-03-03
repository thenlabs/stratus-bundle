<?php

namespace ThenLabs\Bundle\StratusBundle\Tests;

use ThenLabs\Bundle\StratusBundle\Annotation\StratusPage;
use ThenLabs\Bundle\StratusBundle\AbstractPage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Twig\Environment;

setTestCaseNamespace(__NAMESPACE__);
setTestCaseClass(TestCase::class);

testCase('AbstractPageTest.php', function () {
    test(function () {
        $controller = $this->createMock(AbstractController::class);

        $page = $this->getMockBuilder(AbstractPage::class)
            ->disableOriginalConstructor()
            ->getMockForAbstractClass()
        ;

        $page->setController($controller);

        $this->assertSame($controller, $page->getController());
    });

    test(function () {
        $expectedUrl = uniqid('url');
        $route = uniqid('route');
        $parameters = range(1, mt_rand(1, 10));
        $referenceType = mt_rand(1, 10);

        $controller = $this->getMockBuilder(AbstractController::class)
            ->disableOriginalConstructor()
            ->setMethods(['generateUrl'])
            ->getMockForAbstractClass();
        $controller->expects($this->once())
            ->method('generateUrl')
            ->with(
                $this->equalTo($route),
                $this->equalTo($parameters),
                $this->equalTo($referenceType)
            )
            ->willReturn($expectedUrl)
        ;

        $page = new class($route, $parameters, $referenceType) extends AbstractPage {

            public function __construct($route, $parameters, $referenceType)
            {
                $this->route = $route;
                $this->parameters = $parameters;
                $this->referenceType = $referenceType;
            }

            public function getView(): string
            {
                return '';
            }

            public function myMethod()
            {
                return $this->controller->generateUrl(
                    $this->route,
                    $this->parameters,
                    $this->referenceType
                );
            }
        };

        $page->setController($controller);

        $this->assertEquals($expectedUrl, $page->myMethod());
    });
});

class MyPage extends AbstractPage
{
    public function getView(): string
    {
        return '';
    }
}
