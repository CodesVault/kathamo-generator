<?php

namespace Kathamo\App\Commands\Make;

use Kathamo\App\Commands\CommandHelper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeMigration extends Command
{
	use CommandHelper;

	protected function configure()
    {
        $this->setName('make make:migration')
            ->setDescription('New Migration class for plugin')
			->setAliases(['make:m']);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getInput();
		$this->generateFile('Migration_php.mustache');

		return Command::SUCCESS;
	}

	public function getInput()
	{
		$this->root_path = getcwd();
		$this->target_path = $this->root_path . "/database/Migrations/";
		$this->input['input_class_name'] = $this->input("Migration Name:");
		$this->input['input_path'] = '';
	}
}
