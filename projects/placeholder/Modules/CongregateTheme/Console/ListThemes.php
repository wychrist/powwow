<?php

namespace Modules\CongregateTheme\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ListThemes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'congregate:theme-list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all discoverable themes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $lockFile = file_get_contents(base_path('composer.lock'));
        $lockArray = json_decode($lockFile, true);
        $themes = [];

        foreach($lockArray['packages'] as $package) {
            if(isset($package['extra']) && isset($package['extra']['congregatetheme'])) {
                $themes = array_merge($themes, $package['extra']['congregatetheme']);
            }
        }

        dd($themes);
        return 0;
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }
}
