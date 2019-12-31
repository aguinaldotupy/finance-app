<?php

namespace App\Console\Commands;

use Illuminate\Config\Repository;
use Illuminate\Console\Command;

class ConfigToJavascriptCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'config:json';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @var Repository
     */
    private $config;

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();

        $this->config = config();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $configs = [];

        $criteria = ['app'];

        foreach ($this->config->all() as $key => $config) {
            if (in_array($key, $criteria)) {
                $configs[$key] = $config;

                foreach ($config as $keyValue => $value) {
                    $configs[$key][] = [$keyValue => $value];
                }
            }
        }

        \File::put('resources/js/config/config.json', json_encode($configs, JSON_PRETTY_PRINT));

        $this->info('Finalizado');
    }
}
