<?php

namespace Howdy\Scaffold;

use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Path;
use Symfony\Component\Finder\Finder;

class CreateFiles
{
	private static $input_data = [];

	static function create($input)
	{
		static::$input_data = $input;

		$finder = new Finder();
		$finder->files()->in(dirname(__FILE__) . '/templates');
		foreach ($finder as $file) {

			$dir_list = explode("/templates/", $file->getPathname());
			static::createFileDir($dir_list[1]);
		}
	}

	private static function createFileDir($dir_path)
	{
		$filesystem = new Filesystem();
		$dir_list = explode('/', $dir_path);
		if (count($dir_list) == 1) {
			// create root directory files
			static::createFile($dir_path, $dir_path);
			return;
		}

		$file_relative_path = '';
		foreach ($dir_list as $dir_name) {
			$is_file = explode('.', $dir_name);
			if (count($is_file) > 1) {
				static::createFile($file_relative_path . '/' . $dir_name, $dir_path);
				continue;
			}

			$file_relative_path = $file_relative_path . $dir_name;
			$file_relative_path = count($is_file) > 1 ? '' : $file_relative_path . '/';
			$current_dir_path = getcwd() . '/' . $file_relative_path . $dir_name;
			if (is_dir($current_dir_path)) continue;

			try {
				$filesystem->mkdir(
					Path::normalize($file_relative_path)
				);
			} catch (IOExceptionInterface $exception) {
				echo "An error occurred while creating your directory at " . $exception->getPath();
			}
		}
	}

	private static function createFile($path, $template_path)
	{
		$origin_path =  dirname(__FILE__) . "/templates/" . $template_path;
		$file_path = getcwd() . '/' . $path;
		$filesystem = new Filesystem();

		try {
			$filesystem->copy(
				Path::normalize($origin_path),
				Path::normalize($file_path),
				true
			);
			$filesystem->chmod($file_path, 0777);
		} catch (IOExceptionInterface $exception) {
			echo "An error occurred while creating your directory at " . $exception->getPath();
		}

		$dir_list = explode('/', $path);
		$is_mustache_file = explode('.', array_pop($dir_list));
		if ( ! empty($is_mustache_file[1]) && $is_mustache_file[1] === 'mustache') {
			$file_prefix = explode('.', $file_path);
			$name = explode('/', $file_prefix[0]);
			$file_name = array_pop($name);
			$file_suffix = explode('_', $path)[1];
			$file_extension = '.php';

			$input_data = TemplateContent::generate(static::$input_data, $file_name);
			$filesystem->dumpFile($file_path, $input_data);

			if ($file_suffix === 'json.mustache') {
				$file_extension = '.json';
			} elseif ($file_suffix === 'txt.mustache') {
				$file_extension = '.txt';
			}
			$file = explode('_', $path)[0];
			$filesystem->rename($file_path, $file . $file_extension);
		}
	}
}
