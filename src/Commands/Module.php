<?php

namespace mariojgt\checkout\Commands;

use Illuminate\Console\Command;

class Module extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {moduleName?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Laravel Package module (folder structure)';


    protected $stubDetails = [
        'name'      => null,
        'namespace' => null,
        'package'   => null,
        'model'     => null
    ];

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

        $confirmedDetails = false;
        $firstLoop        = true;
        self::loadConfig();

        $this->stubDetails['name'] =
            $this->stubDetails['name'] == ''
            ? $this->argument('moduleName')
            : $this->stubDetails['name'];

        while (!$confirmedDetails) {
            if (!$firstLoop || $this->argument('moduleName') == null) {
                $this->stubDetails['name'] = $this->ask('What is your new module called?', $this->argument('moduleName'));
            }

            $this->stubDetails['namespace'] = $this->ask('What is your new modules namespace?', $this->stubDetails['namespace']);
            $this->stubDetails['package']   = $this->ask('What is your package called?', $this->stubDetails['package']);
            $this->stubDetails['model']     = $this->confirm('Does the module require a model?', $this->stubDetails['model']);

            $this->info('Module details');
            $this->info('--------------------------');
            $this->info('Name: '.$this->stubDetails['name']);
            $this->info('Namespace: '.$this->stubDetails['namespace']);
            $this->info('Package: '.$this->stubDetails['package']);
            $this->info('Model: '.($this->stubDetails['model'] ? 'Create' : 'Ignore'));

            if ($this->confirm('Is the above information correct?', true)) {
                $confirmedDetails = true;
            }
            $firstLoop = false;
        }

        $this->makeModule();
    }

    private function makeModule()
    {
        $controller = $this->loadStub('Controller');
        $routes     = $this->loadStub('Routes');
        $view       = $this->loadStub('View');

        $modulesDir = __DIR__.'/../Modules/';

        $moduleDir      = $modulesDir.$this->stubDetails['name'];
        $controllersDir = $moduleDir.'/Controllers';
        $viewsDir       = $moduleDir.'/Views';
        $routesDir      = $moduleDir.'/Routes';
        $eventsDir      = $moduleDir.'/Events';

        mkdir($moduleDir);
        mkdir($controllersDir);
        mkdir($viewsDir);
        mkdir($routesDir);
        mkdir($eventsDir);

        $newFile = fopen($controllersDir.'/'.$this->stubDetails['name'].'Controller.php', "w") or die("Unable to open file!");
        fwrite($newFile, $controller);
        fclose($newFile);

        $newFile = fopen($routesDir.'/web.php', "w") or die("Unable to open file!");
        fwrite($newFile, $routes);
        fclose($newFile);

        $newFile = fopen($viewsDir.'/index.blade.php', "w") or die("Unable to open file!");
        fwrite($newFile, $view);
        fclose($newFile);
        $newFile = fopen($viewsDir.'/create.blade.php', "w") or die("Unable to open file!");
        fwrite($newFile, $view);
        fclose($newFile);
        $newFile = fopen($viewsDir.'/show.blade.php', "w") or die("Unable to open file!");
        fwrite($newFile, $view);
        fclose($newFile);
        $newFile = fopen($viewsDir.'/edit.blade.php', "w") or die("Unable to open file!");
        fwrite($newFile, $view);
        fclose($newFile);

        if ($this->stubDetails['model']) {
            $modelsDir     = $moduleDir.'/Models';
            $databaseDir   = $moduleDir.'/Database';
            $migrationsDir = $databaseDir.'/Migrations';
            $seedsDir      = $databaseDir.'/Seeds';

            $model = $this->loadStub('Model');

            mkdir($modelsDir);
            mkdir($databaseDir);
            mkdir($migrationsDir);
            mkdir($seedsDir);

            $newFile = fopen($modelsDir.'/'.$this->stubDetails['name'].'.php', "w") or die("Unable to open file!");
            fwrite($newFile, $model);
            fclose($newFile);

            $migrationsDir = str_replace($this->laravel->basePath(), '', $migrationsDir);

            $table = str_plural(snake_case(studly_case($this->stubDetails['name'])));
            $this->call('make:migration', [
                'name'     => "create_{$table}_table",
                '--create' => $table,
                '--path'   => $migrationsDir
            ]);
        }

        $this->info('Success');
    }

    private function loadStub($stub)
    {
        $stub = file_get_contents(__DIR__.'/Stubs/'.$stub.'.php');

        $routes = explode('\\', $this->stubDetails['namespace']);
        $route  = end($routes);
        $route  = str_replace('Package', '', $route);

        $stub = str_replace('DummyNamespace', $this->stubDetails['namespace'], $stub);
        $stub = str_replace('DummyRouteName', strtolower($route), $stub);
        $stub = str_replace('DummyModuleNameLower', strtolower($this->stubDetails['name']), $stub);
        $stub = str_replace('DummyModuleName', $this->stubDetails['name'], $stub);
        $stub = str_replace('DummyPackage', $this->stubDetails['package'], $stub);

        return $stub;
    }

    public function loadConfig()
    {
        $configPath = __DIR__.'/../Config/modules.php';
        if (is_file($configPath)) {
            $userConfig = include $configPath;
            $this->stubDetails = array_merge($this->stubDetails, $userConfig);
        }
        return $this->stubDetails;
    }
}
