<?php

namespace Kathamo\App\Commands\Make;

use Kathamo\App\Commands\CommandHelper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeModel extends Command
{
	use CommandHelper;

	protected function configure()
    {
        $this->setName('make make:model')
            ->setDescription('New Model for plugin')
			->setAliases(['make:ml']);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getInput();
		$this->generateFile('Model_php.mustache');

		return Command::SUCCESS;
	}

	public function getInput()
	{
		$this->root_path = getcwd();
		$this->target_path = getcwd() . "/app/Model/";
		$this->input['input_class_name'] = $this->input("Model Name:");
		$this->input['input_path'] = $this->input("Path [app/Model/]:");
	}
}
