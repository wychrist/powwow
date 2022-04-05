<?php

namespace Modules\CongregateTheme\Console;

use App\Mail\ConfirmContact;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Finder\Finder;

class InstallTheme extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'congregate:theme-install';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install a new theme';

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
        //
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
            ['name', InputArgument::REQUIRED, 'The name of the theme'],
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
            // ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }

    private function searchFolder () {
        $finder = new Finder();
        $finder->files()->in(theme_dir('paper_v2/templates'))->name('*.php');

        dump($finder->hasResults());
        $results = [];
        $replace = [
            '.blade' => ''
        ];
        foreach($finder as $file) {
           $fullpath = $file->getRealPath();
           $name = str_replace(array_keys($replace), array_values($replace), $file->getFilenameWithoutExtension());
            dump(explode('_', $name));
            dump([$file->getRelativePathname(), $file->getFilenameWithoutExtension()]);
        }
    }
}
