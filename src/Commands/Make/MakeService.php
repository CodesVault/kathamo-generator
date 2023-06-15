<?php

namespace Kathamo\App\Commands\Make;

use Kathamo\App\Commands\CommandHelper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeService extends Command
{
	use CommandHelper;

	protected function configure()
    {
        $this->setName('make make:service')
            ->setDescription('New Service for plugin')
			->setAliases(['make:s']);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getInput();
		$this->generateFile('Service_php.mustache');

		return Command::SUCCESS;
	}

	public function getInput()
	{
		$this->root_path = getcwd();
		$this->target_path = getcwd() . "/app/Services/";
		$this->input['input_class_name'] = $this->input("Service Name:");
		$this->input['input_path'] = $this->input("Path [app/Services/]:");
	}
}
