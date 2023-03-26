<?php
namespace Kathamo\App\Commands;

use Kathamo\App\CreateTemplate;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Finder\Finder;

class CreateTemplateCommand extends Command
{
    protected function configure()
    {
        $this->setName('kathamo')
            ->setDescription('Create Mustache template.')
            ->addOption('template', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        (new CreateTemplate)->generate();

		// CreateFiles::create($input);
        return Command::SUCCESS;
    }
}
