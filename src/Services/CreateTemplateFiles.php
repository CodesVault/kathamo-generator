<?php
namespace Kathamo\App\Services;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

class CreateTemplateFiles
{
    private $kathamo_path = null;
    private $terget_dir = null;

    public function __construct($kathamo_path)
    {
        $this->kathamo_path = $kathamo_path;

        if (is_dir(dirname(__DIR__) . "/templates/project")) {
            $msg = "\n'" . dirname(__DIR__) . "/templates' directory exist, remove it to execute the command.\nExit\n";
            echo Notifier::notify($msg, 'warning');
            die();
        }

        mkdir(dirname(__DIR__) . "/templates/project");
        $this->terget_dir = dirname(__DIR__) . "/templates/project/";
        $this->generate();
    }

    private function generate()
    {
        $finder = new Finder();
		$finder->ignoreDotFiles(false)
            ->in($this->kathamo_path)
            ->exclude('vendor')
            ->exclude('node_modules');

		foreach ($finder as $file) {
            // if (
            //     strpos($file->getRealPath(), 'vendor')
            //     || strpos($file->getRealPath(), 'node_modules')
            //     || strpos($file->getRealPath(), 'composer.lock')
            //     || strpos($file->getRealPath(), 'kathamo-framework')
            // ) {
            //     continue;
            // }
			$this->createFileDir($file);
			$this->createFile($file);
		}
    }

    private function createFileDir($file)
	{
		if (! is_dir($file->getRealPath())) {
			return;
		}

		$new_file_path = $this->terget_dir . $file->getRelativePathname();
		mkdir($new_file_path);
		return;
	}

	private function createFile($file)
	{
		if (! is_file($file->getRealPath())) {
			return;
		}

		$new_file_path = $this->terget_dir . $file->getRelativePathname();
		copy(
            $file->getRealPath(),
            $new_file_path
        );
        $this->renameFile($file, $new_file_path);
	}

    private function renameFile($file, $new_path)
    {
        $file_info = explode('.', $file->getFileName());
        $file_dir_path = explode($file->getFileName(), $new_path);
        $filesystem = new Filesystem();
        if (count($file_info) < 2) {
            return;
        }

        if (
            'php' === $file_info[1] ||
            'composer.json' === $file->getFileName()
        ) {
            $file_name = $file_info[0] . '_' . $file_info[1] . '.mustache';
            $new_file_path = $file_dir_path[0] . $file_name;
            $filesystem->rename($new_path, $new_file_path);
            
            $file_data = file_get_contents($new_file_path);
            $this->generateMustacheVariables($file_data, $new_file_path);
        }
    }

    private function generateMustacheVariables($file_data, $file_path)
    {
        $content_schema = require dirname(__DIR__) . '/content-schema.php';
        foreach ($content_schema as $old_data => $schema) {
            $file_data = str_replace($old_data, $schema, $file_data);
        }

        $filesystem = new Filesystem();
        $filesystem->dumpFile($file_path, $file_data);
    }
}
