<?php

namespace ThenLabs\Bundle\StratusBundle\Tests;

use ThenLabs\Bundle\StratusBundle\AbstractPage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
});
