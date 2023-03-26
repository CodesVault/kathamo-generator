<?php
namespace Kathamo\App\Commands;

use Kathamo\App\CommandManager\Scaffold;
use Kathamo\App\CommandManager\Template;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class KathamoCLI extends Command
{
    protected function configure()
    {
        $this->setName('kathamo')
            ->setDescription('Cli for Kathamo framework.')
            ->addOption('scaffold', 'new')
            ->addOption('template', 't');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($input->getOption('scaffold')) {
            new Scaffold();
        }

        if ($input->getOption('template')) {
            new Template();
        }

        return Command::SUCCESS;
    }
}