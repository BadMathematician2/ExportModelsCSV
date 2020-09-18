<?php


namespace ExportModelsCSV;


use Illuminate\Support\ServiceProvider;

class ExportModelsCSVProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('ExportModels', function () {
            return new ExportModelsCSV();
        });
    }
}
