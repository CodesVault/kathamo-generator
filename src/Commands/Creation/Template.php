<?php
namespace Kathamo\App\Commands\Creation;

use Kathamo\App\Commands\CommandHelper;
use Kathamo\App\Services\CreateTemplateFiles;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Template extends Command
{
    use CommandHelper;

    private $kathamo_path = '/var/www/html/wp-content/plugins/kathamo';

    protected function configure()
    {
        $this->setName('create:template')
            ->setDescription('Create new template for Kathamo framework');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        new CreateTemplateFiles($this->kathamo_path);

        return Command::SUCCESS;
    }
}
