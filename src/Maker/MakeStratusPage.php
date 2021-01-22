<?php

namespace ThenLabs\Bundle\StratusBundle\Maker;

use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\DependencyBuilder;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\InputConfiguration;
use Symfony\Bundle\MakerBundle\Maker\AbstractMaker;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;

/**
 * @author Andy Daniel Navarro Taño <andaniel05@gmail.com>
 */
final class MakeStratusPage extends AbstractMaker
{
    public static function getCommandName(): string
    {
        return 'make:stratus-page';
    }

    public static function getCommandDescription(): string
    {
        return 'Creates a new stratus page';
    }

    public function configureCommand(Command $command, InputConfiguration $inputConf)
    {
        $command
            ->addArgument('page-name', InputArgument::REQUIRED, 'Choose a name for your page')
            ->setHelp(file_get_contents(__DIR__.'/../Resources/help/MakeStratusPage.txt'))
        ;
    }

    public function generate(InputInterface $input, ConsoleStyle $io, Generator $generator)
    {
        /**
         * generate the template.
         */

        $generator->generateTemplate(
            $input->getArgument('page-name').'-stratus-page.html.twig',
            __DIR__.'/../Resources/skeleton/StratusPageTemplate.tpl.php'
        );

        /**
         * generate the page class.
         */

        $pageClassNameDetails = $generator->createClassNameDetails(
            $input->getArgument('page-name'),
            'StratusPage\\',
            'StratusPage'
        );

        $generator->generateClass(
            $pageClassNameDetails->getFullName(),
            __DIR__.'/../Resources/skeleton/StratusPage.tpl.php',
            [
                'class_name' => $pageClassNameDetails->getShortName(),
                'template_path' => $input->getArgument('page-name').'-stratus-page.html.twig',
            ]
        );

        /**
         * generate the controller class.
         */

        $controllerClassNameDetails = $generator->createClassNameDetails(
            $input->getArgument('page-name'),
            'Controller\\StratusPage\\',
            'StratusPageController'
        );

        $generator->generateClass(
            $controllerClassNameDetails->getFullName(),
            __DIR__.'/../Resources/skeleton/StratusPageController.tpl.php',
            [
                'class_name' => $controllerClassNameDetails->getShortName(),
                'page_class_name' => $pageClassNameDetails->getShortName(),
                'page_name' => $input->getArgument('page-name'),
            ]
        );

        $generator->writeChanges();

        $this->writeSuccessMessage($io);
        $io->text('Next: Open your new page class and edit it!');
    }

    public function configureDependencies(DependencyBuilder $dependencies)
    {
    }
}
