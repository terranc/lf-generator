<?php

namespace Lookfeel\Boilerplate\Commands;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class AppModelCommand extends AppGeneratorCommand
{
    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Model';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:model {name : The name of the class} {--m|migration : Create a new migration file for the model.} {--c|controller : Create a new controller for the model.} {--r|resource : Indicates if the generated controller should be a resource controller}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Eloquent model class with attribute, relationship and scope traits';


    /**
     * The methods available.
     *
     * @var array
     */
    protected function getMethods()
    {
        return ['all', 'paginated', 'find', 'create', 'update', 'delete'];
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/model.stub';
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (parent::handle() !== false) {
            $this->call('app:attribute', ['name' => $this->argument('name')]);
            $this->call('app:relationship', ['name' => $this->argument('name')]);
            $this->call('app:scope', ['name' => $this->argument('name')]);
        }

        if ($this->option('migration')) {
            $this->createMigration();
        }

        if ($this->option('controller') || $this->option('resource')) {
            $this->createController();
        }
    }
    /**
     * Create a migration file for the model.
     *
     * @return void
     */
    protected function createMigration()
    {
        $table = Str::plural(Str::snake(class_basename($this->argument('name'))));

        $this->call('make:migration', [
            'name' => "create_{$table}_table",
            '--create' => $table,
        ]);
    }

    /**
     * Create a controller for the model.
     *
     * @return void
     */
    protected function createController()
    {
        $controller = Str::studly(class_basename($this->argument('name')));

        $modelName = $this->qualifyClass($this->getNameInput());

        $this->call('make:controller', [
            'name' => "{$controller}Controller",
            '--model' => $this->option('resource') ? $modelName : null,
        ]);
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Models' .'\\' . $this->argument('name');
    }
}
