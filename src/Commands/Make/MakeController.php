<?php

namespace Kathamo\App\Commands\Make;

use Kathamo\App\Commands\CommandHelper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeController extends Command
{
	use CommandHelper;

	protected function configure()
    {
        $this->setName('make make:controller')
            ->setDescription('New Controller for plugin')
			->setAliases(['make:c']);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getInput();

		return Command::SUCCESS;
	}

	public function getInput()
	{
		$this->root_path = getcwd();
		$this->target_path = $this->root_path . "/app/Controllers/";
		$this->input['input_class_name'] = $this->input("Controller Name:");
		$this->input['input_path'] = $this->input("Path [app/Controllers/]:");

		$this->generateFile('Controller_php.mustache');
	}
}
