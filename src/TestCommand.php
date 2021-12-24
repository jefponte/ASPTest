<?php

namespace ASPTest;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class TestCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'app:test';

    protected function configure()
    {
        $this->setDescription('This test returns test OK');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('test OK');
    }
}