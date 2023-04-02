<?php
namespace Kathamo\App\CommandManager;

use Kathamo\App\Services\CreateSkeletonFiles;
use Kathamo\App\Services\Notifier;

class Scaffold extends Manager
{
	private $input = [];

	public function __construct()
	{
		$this->getInputs();

		echo Notifier::notify(" Creating Kathamo framework scaffold...");
		new CreateSkeletonFiles($this->input);

		echo Notifier::notify("\n Done.");
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
