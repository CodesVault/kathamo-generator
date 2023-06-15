<?php

namespace Kathamo\App\Commands\Make;

use Kathamo\App\Commands\CommandHelper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeMiddleware extends Command
{
	use CommandHelper;

	protected function configure()
    {
        $this->setName('make make:middleware')
            ->setDescription('New Middleware for plugin')
			->setAliases(['make:mw']);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getInput();
		$this->generateMiddleware();

		return Command::SUCCESS;
	}

	public function getInput()
	{
		$this->root_path = getcwd();
		$this->target_path = $this->root_path . "/app/Controllers/Middleware/";
		$this->input['input_class_name'] = $this->input("Middleware Class Name:");
		$this->input['middleware_key'] = $this->input("Middleware key:");
		$this->input['input_path'] = $this->input("Path [app/Controllers/Middleware]:");
	}

	private function generateMiddleware()
	{
		$data = $this->input;
		$config_data = $this->getConfig($this->root_path);
		$middware_list = $config_data['middlewares'];
		$middleware_name = $config_data['namaspace_root'] . "\App\Controllers\Middleware\\" . $data['input_class_name'];
		$middware_list[$data['middleware_key']] = $middleware_name;

		$this->writeConfig($middware_list);
		$this->generateFile('Middleware_php.mustache');
	}

	private function writeConfig($data)
	{
		$schema = '';
		foreach ($data as $key => $i) {
			$schema .= "'$key'	=> $i::class,\n\t\t";
		}

		$controller_template = dirname(__DIR__, 2) . '/templates/partials/config_php.mustache';
		$mustache = new \Mustache_Engine();
		$file_content = $mustache->render(
			file_get_contents($controller_template),
			['middleware_list' => $schema]
		);

		$filesystem = new Filesystem;
		$filesystem->dumpFile($this->root_path . '/configs/config.php', $file_content);
	}
}
