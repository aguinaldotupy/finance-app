<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Routing\Router;

class RouteJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'route:json';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate routes for javascript.';

    /**
     * @var Router
     */
    private $router;

    /**
     * Create a new command instance.
     *
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        parent::__construct();

        $this->router = $router;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->comment('In progress created routes js...');
        $routes = [];

        foreach ($this->router->getRoutes() as $route) {
            $routes[$route->getName()] = $route->uri();
        }

        \File::put('resources/js/routes/routes.json', json_encode($routes, JSON_PRETTY_PRINT));

        $this->info('Successful routes js');
    }
}
