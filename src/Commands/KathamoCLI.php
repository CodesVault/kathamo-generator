<?php
namespace Kathamo\App\Commands;

use Symfony\Component\Console\Application;
use Kathamo\App\Commands\Creation\Scaffold;
use Kathamo\App\Commands\Creation\Template;
use Kathamo\App\Commands\Make\MakeController;
use Kathamo\App\Commands\Make\MakeMiddleware;
use Kathamo\App\Commands\Make\MakeMigration;
use Kathamo\App\Commands\Make\MakeService;

class KathamoCLI
{
    public function __construct()
    {
        $app = new Application();
        $app->add(new Scaffold());
        // $app->add(new Template());

        $app->add(new MakeMiddleware());
        $app->add(new MakeController());
        $app->add(new MakeService());
        $app->add(new MakeMigration());

        $app->run();
    }
}
