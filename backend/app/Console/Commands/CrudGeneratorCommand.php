<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Artisan;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CrudGeneratorCommand extends Command
{
    protected $signature = 'crud:generator
    {name : Class (singular) for example User} {--folder=} {--table=} {--fields=*}';

    protected $description = 'Create crud operations';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = $this->argument('name');
        $tableName = $this->option('table');
        $folderName = $this->option('folder');
        $fields = $this->option('fields');
        $properties = $this->gerarProperties($fields);
        $this->controller($name,$properties,$folderName);
        $this->service($name,$folderName);
        $this->model($name, $fields, $tableName,$folderName);
        $this->request($name,$folderName);
        $nameController = $name . "Controller";

       //File::append(base_path('routes/groups/'.strtolower($folderName).'.php'), "\n \n Route::apiResource('" . Str::plural(strtolower($name)) . "'" . str_replace(".", "", ",App\Http\Controllers\.$folderName.\.$nameController.::class)") . "->middleware(['check.auth'])->parameters(['".Str::plural(strtolower($name))."' => 'id']);");
       File::append(base_path('routes/groups/'.strtolower($folderName).'.php'), "\n \n Route::apiResource('" . Str::plural(strtolower($name)) . "'" . str_replace(".", "", ",App\Http\Controllers\.$folderName.\.$nameController.::class)") . "->parameters(['".Str::plural(strtolower($name))."' => 'id']);");
       Artisan::call(command: 'make:migration create_' . strtolower($name) . '_table --create=' . strtolower($name));
    }

    protected function controller($name,$properties,$folderName)
    {
        $controllerTemplate = str_replace(
            [
                '{{modelName}}',
                '{{properties}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{folderName}}',
                '{{folderNameLowerCase}}'
            ],
            [
                $name,
                $properties,
                strtolower(Str::plural($name)),
                strtolower(Str::snake($name)),
                $folderName,
                strtolower($folderName),
            ],
            $this->getStub('Controller')
        );

        if (!file_exists($path = app_path("/Http/Controllers/{$folderName}")))
            mkdir($path, 0777, true);

        file_put_contents(app_path("/Http/Controllers/{$folderName}/{$name}Controller.php"), $controllerTemplate);
    }
    protected function service($name,$folderName)
    {
        $serviceTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{folderName}}'
            ],
            [
                $name,
                strtolower(Str::plural($name)),
                 strtolower(Str::snake($name)),
                 $folderName
            ],
            $this->getStub('Service')
        );

        if (!file_exists($path = app_path("/Services/{$folderName}")))
            mkdir($path, 0777, true);

        file_put_contents(app_path("/Services/{$folderName}/{$name}Service.php"), $serviceTemplate);
    }

    protected function model($name, $fields, $tableName,$folderName)
    {
        $modelTemplate = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('Model')
        );
        $fields = '"' . implode('","', $fields) . '"';
        $modelTemplate = str_replace(
            ['{{fillable}}'],
            [$fields],
            $modelTemplate
        );
        $modelTemplate = str_replace(
            ['{{tableName}}'],
            [$tableName],
            $modelTemplate
        );

        $modelTemplate = str_replace(
            ['{{folderName}}'],
            [$folderName],
            $modelTemplate
        );

        if (!file_exists($path = app_path("/Models/{$folderName}")))
            mkdir($path, 0777, true);

        file_put_contents(app_path("/Models/{$folderName}/{$name}.php"), $modelTemplate);
    }

    protected function request($name,$folderName)
    {
        $requestTemplate = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('Request')
        );

        $requestTemplate = str_replace(
            ['{{folderName}}'],
            [$folderName],
            $requestTemplate
        );

        if (!file_exists($path = app_path('/Http/Requests')))
            mkdir($path, 0777, true);

        if (!file_exists($path = app_path("/Http/Requests/{$folderName}")))
            mkdir($path, 0777, true);

        file_put_contents(app_path("/Http/Requests/{$folderName}/{$name}Request.php"), $requestTemplate);
    }


    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs_crud_generator/$type.stub"));
    }
    public function gerarProperties($fields)
    {
        $propety = '';
        foreach ($fields as  $field) {
            $propety .= "\n" ."\t\t" ."*"."\t". '@OA\Property(property="' . $field . '"),';
        }
        return $propety;
    }
}
