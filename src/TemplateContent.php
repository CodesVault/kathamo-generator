<?php

namespace Kathamo\App;

class TemplateContent
{
	static function generate($file_input, $file_path = '')
	{
		$scaffold = new \Mustache_Engine(array(
			'loader' => new \Mustache_Loader_FilesystemLoader(dirname(__FILE__).'/templates'),
		));
		$plugin_template = $scaffold->loadTemplate($file_path);
		return $plugin_template->render($file_input);
	}
}
