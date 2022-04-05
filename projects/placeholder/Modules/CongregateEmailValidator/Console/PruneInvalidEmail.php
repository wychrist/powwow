<?php

namespace Modules\CongregateEmailValidator\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Date;
use Modules\CongregateEmailValidator\Entities\EmailPending;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class PruneInvalidEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'congregate:email-prune';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes emails that have not being validated';

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
        $date = Date::now();
        $date->addDays(2);

        EmailPending::whereDay('expire_at', '<', $date)->delete();
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
