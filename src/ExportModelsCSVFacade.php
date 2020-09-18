<?php


namespace ExportModelsCSV;


use Illuminate\Support\Facades\Facade;

/**
 * Class ExportModelsCSVFacade
 * @package App\Packages\ExportModelsCSV\src
 */
class ExportModelsCSVFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ExportModels';
    }
}
