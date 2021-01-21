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
        $twig = $this->createMock(Environment::class);

        $page = $this->getMockBuilder(AbstractPage::class)
            ->disableOriginalConstructor()
            ->getMockForAbstractClass()
        ;

        $page->setTwig($twig);

        $this->assertSame($twig, $page->getTwig());
    });

    test(function () {
        $params = range(1, mt_rand(1, 10));
        $view = uniqid();

        $twig = $this->getMockBuilder(Environment::class)
            ->disableOriginalConstructor()
            ->setMethods(['render'])
            ->getMock()
        ;

        $twig->expects($this->once())
            ->method('render')
            ->with(
                $this->equalTo('path/to/template.html.twig'),
                $this->equalTo($params)
            )
            ->willReturn($view)
        ;

        $page = new MyDummyPage;
        $page->setTwig($twig);

        $result = $page->render($params);

        $this->assertEquals($view, $result);
    });
});

/**
 * @StratusPage(template="path/to/template.html.twig")
 */
class MyDummyPage extends AbstractPage
{
}
