<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PermissionRemove extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'modules:remove {module}';

    //protected $name = 'modules:remove';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permission Remove';

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
     * @throws \Exception
     */
    public function handle()
    {
        $name = $this->argument('module');
        $module = $this->laravel['modules']->all()[$name];

        $className = '\\Modules\\' . $name . '\\Config\\ModuleSetting';
        $setting = new $className;
        $setting->remove();

        $this->info('Your module has been removed.');
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
