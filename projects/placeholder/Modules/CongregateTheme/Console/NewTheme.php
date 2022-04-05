<?php

namespace Modules\CongregateTheme\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Support\Facades\File;

class NewTheme extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'congregate:theme-new';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new theme';

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
        $name = $this->argument('name');
        $module = $this->option('module');
        $path = config('congregatetheme.theme_directory') .'/'. $name;

        if($module !== false) {

        }

        if(!File::exists($path)) {
            dd($path);
        }

        dump($name, $module);

        return 0;
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'Name of the theme'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['module', 'm', InputOption::VALUE_OPTIONAL, 'Module to create', false],
        ];
    }
}
