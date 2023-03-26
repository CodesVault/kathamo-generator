<?php
namespace Kathamo\App\Commands;

use Kathamo\App\CreateFiles;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class ScaffoldCommand extends Command
{
    protected function configure()
    {
        $this->setName('kathamo')
            ->setDescription('Scaffolding plugin framework.')
            ->addOption('scaffold', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
		$plugin_name = readline("Plugin Name: ");
		$plugin_prefix = readline("Plugin Prefix: ");
		$function_prefix = readline("Global Function Prefix: ");
		$text_domain = readline("Text Domain: ");
		$namespace_prefix = readline("Namespace Prefix: ");

		$input = [
			'plugin_name'		=> $plugin_name,
			'plugin_prefix'		=> $plugin_prefix,
			'text_domain'		=> $text_domain,
			'namespace_prefix'	=> $namespace_prefix,
			'function_prefix'	=> $function_prefix,
			'constent_prefix'	=> strtoupper($function_prefix),
		];

		CreateFiles::create($input);
        return Command::SUCCESS;
    }
}
