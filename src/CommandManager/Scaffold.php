<?php
namespace Kathamo\App\CommandManager;

use Kathamo\App\Services\CreateSkeletonFiles;

class Scaffold
{
	private $input = [];

	public function __construct()
	{
		$this->getInputs();
		new CreateSkeletonFiles($this->input);
	}

	private function getInputs()
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

		$this->input = $input;
	}
}
