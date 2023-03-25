<?php

namespace Kathamo\App;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

class CreateFiles
{
	private static $input_data = [];

	static function create($input)
	{
		static::$input_data = $input;

		$finder = new Finder();
		$finder->in(dirname(__FILE__) . '/templates');
		foreach ($finder as $file) {
			static::createFileDir($file);
			static::createFile($file);
		}
	}

	private static function createFileDir($file)
	{
		if (! is_dir($file->getRealPath())) {
			return;
		}
		$new_file_path = getcwd() . '/' . $file->getRelativePathname();
		mkdir($new_file_path);
		return;
	}

	private static function createFile($file)
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
			$input_data = TemplateContent::generate(static::$input_data, $file->getRelativePathname());
			$filesystem->dumpFile($new_file_path, $input_data);
			$filesystem->rename($new_file_path, $new_file_dir_path[0] . "/" . $file_suffix[0] . "." . $file_suffix[1]);
		}
	}
}
