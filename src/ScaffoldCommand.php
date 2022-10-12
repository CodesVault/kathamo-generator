<?php
namespace Howdy\Scaffold;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class ScaffoldCommand extends Command
{
    protected function configure()
    {
        $this->setName('howdy')
            ->setDescription('Scaffolding plugin.')
            // ->setHelp('Demonstration of custom commands created by Symfony Console component.')
            ->addArgument('type', InputArgument::REQUIRED);
			// ->addOption('plugin_name');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
		if ($input->getArgument('type') !== 'scaffold') {
			$output->writeln('Invalid type, try scaffold');
			return Command::INVALID;
		}

		$plugin_name = readline("Plugin Name: ");
		$text_domain = readline("Text Domain: ");
		$namespace_prefix = readline("Namespace Prefix: ");

		$input = [
			'plugin_name' => $plugin_name,
			'text_domain' => $text_domain,
			'namespace_prefix' => $namespace_prefix,
		];

		// $scaffold = new HowdyScaffold;
        // $output->writeln($scaffold->generate($input));

		CreateFiles::create($input);
        return Command::SUCCESS;
    }
}
