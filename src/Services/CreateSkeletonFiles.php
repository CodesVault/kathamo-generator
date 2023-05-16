<?php

namespace Kathamo\App\Services;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

class CreateSkeletonFiles
{
	private $input_data = [];

	public function __construct($input)
	{
		$this->input_data = $input;

		$finder = new Finder();
		$finder
			->ignoreDotFiles(false)
			->in(dirname(__DIR__) . '/templates')
			->notName(['.DS_Store']);

		foreach ($finder as $file) {
			$this->createFileDir($file);
			$this->createFile($file);
		}
	}

	private function createFileDir($file)
	{
		if (! is_dir($file->getRealPath())) {
			return;
		}
		$new_file_path = getcwd() . '/' . $file->getRelativePathname();
		mkdir($new_file_path);
		return;
	}

	private function createFile($file)
	{
		if (! is_file($file->getRealPath())) {
			return;
		}

		$filesystem = new Filesystem();
		$new_file_path = getcwd() . '/' . $file->getRelativePathname();

		copy(
			$file->getRealPath(),
			$new_file_path
		);
		$file_info = explode('.', $file->getFileName());
		$file_extension = count($file_info) == 2 ? $file_info[1] : false;

		if ('mustache' === $file_extension) {
			$file_suffix = explode('_', $file_info[0]);
			$new_file_dir_path = explode($file->getFileName(), $new_file_path);
			$input_data = $this->generateFileData($this->input_data, $file->getRelativePathname());
			$filesystem->dumpFile($new_file_path, $input_data);
			$filesystem->rename($new_file_path, $new_file_dir_path[0] . "/" . $file_suffix[0] . "." . $file_suffix[1]);
		}
	}

	private function generateFileData($file_input, $file_path = '')
	{
		$scaffold = new \Mustache_Engine(array(
			'loader' => new \Mustache_Loader_FilesystemLoader(dirname(__DIR__) . '/templates'),
		));
		$plugin_template = $scaffold->loadTemplate($file_path);
		return $plugin_template->render($file_input);
	}
}
