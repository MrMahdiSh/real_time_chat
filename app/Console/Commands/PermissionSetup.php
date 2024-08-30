<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PermissionSetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'modules:setup {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permission Setup';

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
        $name = $this->argument('module');
        $module = $this->laravel['modules']->all()[$name];
        if($module->enabled()) {
            $className = '\\Modules\\' . $name . '\\Config\\ModuleSetting';
            $setting = new $className;
            $setting->setup();
        }
        $this->info('Your module has been created.');
    }

    /**
     * Get the value of a command argument.
     *
     * @param  string  $key
     * @return string|array
     */
    public function argument($key = null)
    {
        if (is_null($key)) {
            return $this->input->getArguments();
        }

        return $this->input->getArgument($key);
    }

    /**
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('module', InputArgument::OPTIONAL, 'The name of module will be used.'),
        );
    }
}
