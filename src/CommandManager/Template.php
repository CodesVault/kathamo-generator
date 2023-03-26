<?php
namespace Kathamo\App\CommandManager;

use Kathamo\App\Services\CreateTemplateFiles;

class Template
{
    private $kathamo_path = '/var/www/html/wp-content/plugins/kathamo';

    public function __construct()
    {
        new CreateTemplateFiles($this->kathamo_path);
    }
}
