<?php


namespace ExportModelsCSV;


use Illuminate\Support\Collection;

/**
 * Class ExportModelsCSV
 * @package App\Packages\ExportModelsCSV\src
 */
class ExportModelsCSV
{
    /**
     * @param Collection $models
     * @param string $file_name
     */
    public function exportModels(Collection $models, string $file_name)
    {
        $f = fopen($file_name . '.csv', 'w');
        fputcsv($f, $models->toArray());
        fclose($f);
    }
}
