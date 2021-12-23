<?php

namespace ASPTest;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command
{

    protected static $defaultName = 'app:test';

    protected function configure()
    {
        $this->setDescription('This test return Test ok');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Test OK');
        return Command::SUCCESS;
    }
}