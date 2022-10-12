<?php

namespace Howdy\Scaffold;

class TemplateContent
{
	static function generate($file_input, $file = '')
	{
		$scaffold = new \Mustache_Engine(array(
			'loader' => new \Mustache_Loader_FilesystemLoader(dirname(__FILE__).'/templates'),
		));
		$plugin_template = $scaffold->loadTemplate($file);
		return $plugin_template->render($file_input);
	}
}
