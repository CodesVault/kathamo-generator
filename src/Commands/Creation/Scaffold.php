<?php
namespace Kathamo\App\Commands\Creation;

use Kathamo\App\Commands\CommandHelper;
use Kathamo\App\Services\CreateSkeletonFiles;
use Kathamo\App\Services\Notifier;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Scaffold extends Command
{
	use CommandHelper;

	protected function configure()
    {
        $this->setName('create create:plugin')
            ->setDescription('Cli for Kathamo framework.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getInputs();

		echo Notifier::notify(" Creating Kathamo framework scaffold...");
		new CreateSkeletonFiles($this->input);

		echo Notifier::notify("\n Done.");

		return Command::SUCCESS;
	}

	private function getInputs()
	{
		$plugin_name = $this->input("Plugin Name:");
		$plugin_prefix = $this->input("Plugin Prefix:");
		$function_prefix = $this->input("Global Function Prefix:");
		$text_domain = $this->input("Text Domain:");
		$namespace_prefix = $this->input("Namespace Prefix:");

		$input = [
			'plugin_name'		=> $plugin_name,
			'plugin_prefix'		=> $plugin_prefix,
			'text_domain'		=> $text_domain,
			'namespace_prefix'	=> $namespace_prefix,
			'function_prefix'	=> $function_prefix,
			'constent_prefix'	=> strtoupper($function_prefix),
		];

		$this->input = $input;
	}
}
