<?php

namespace App\Console\Commands;

use App\Helpers\Utils;
use Illuminate\Console\Command;

class ChangeTemplate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'template:change {template} {--L|link}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change template on the system';

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
     * @return int
     */
    public function handle()
    {
        $template = $this->argument('template');
        $availableTemplates = array_keys(config('app_template.configuration'));
        if(!in_array($template, $availableTemplates)) {
            $this->error("The template \"$template\" not found in \"app_template\" configurations");
            return 1;
        }

        Utils::updateDotEnv('APP_TEMPLATE', $template);
        $this->call('storage:link');

        $link = $this->option('link');
        if(!$link) {
            $refreshBase =  (config('app.env') != 'prod') ?
                'Y' : $this->confirm('Are you sure you want to change the template in a production environment and fresh base? (Y/n)');

            if($refreshBase) {
                $this->call('migrate:fresh');
                $this->call('db:seed');
            }
        }

        $this->info("The template was successfully changed to \"$template\"");
        return 0;
    }
}
