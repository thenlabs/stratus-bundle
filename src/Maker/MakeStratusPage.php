<?php

namespace ThenLabs\Bundle\StratusBundle\Maker;

use Doctrine\Common\Annotations\Annotation;
use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\DependencyBuilder;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\InputConfiguration;
use Symfony\Bundle\MakerBundle\Str;
use Symfony\Bundle\MakerBundle\Maker\AbstractMaker;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;

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
    }

    public function configureDependencies(DependencyBuilder $dependencies)
    {
    }
}
