<?php

namespace Kathamo\App\Commands;

trait CommandHelper
{
    protected $input = [];
	protected $root_path;
	protected $target_path;

    public function input($label)
    {
        return readline(
            sprintf(" %s%s %s", "\033[1;34m", $label, "\033[0m")
        );
    }

    protected function getConfig()
	{
        if (! is_file($this->root_path . "/configs/config.php")) {
            throw new \Exception("Config file not found.");
        }
        return require $this->root_path . "/configs/config.php";
	}

	protected function generateFile($template)
	{
		$data = array_merge($this->input, $this->getConfig());
		$data['namespace_suffix'] = "";
		if (! empty($data['input_path'])) {
			$data['namespace_suffix'] = "\\" . str_replace("/", "\\", $data['input_path']);
		}

		$controller_template = dirname(__DIR__) . "/templates/partials/$template";
		$mustache = new \Mustache_Engine(array('entity_flags' => ENT_QUOTES));
		$file_content = $mustache->render(file_get_contents($controller_template), $data);

		$this->create($data, $file_content);
	}

	protected function create($data, $file_content)
	{
		$controller_dir = $this->target_path . $data['input_path'];
		if (! empty($data['input_path']) && ! is_dir($controller_dir)) {
			mkdir($controller_dir);
		}
		if (is_dir($controller_dir)) {
			$target_path = $controller_dir . "/";
		}

		$file = fopen(
			$target_path . $data['input_class_name'] . ".php", "w"
		);
		fwrite($file, $file_content);
		fclose($file);
	}
}
