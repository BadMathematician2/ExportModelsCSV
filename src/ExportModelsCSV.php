<?php


namespace ExportModelsCSV;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class ExportModelsCSV
 * @package App\Packages\ExportModelsCSV\src
 */
class ExportModelsCSV
{
    /**
     * @var array
     */
    private $columns = [];
    /**
     * @var string[]
     */
    private $exept;

    /**
     * @param Collection $models
     * @param string $file_name
     * @param array $exept
     */
    public function exportModels(Collection $models, string $file_name, array $exept = ['created_at','updated_at'])
    {
        $this->exept = $exept;
        $f = fopen($file_name . '.csv', 'w');

        $this->initColumns($models[0]);
        fputcsv($f, $this->columns);

        foreach ($models as $model) {
            fputcsv($f, $this->getValues($model));
        }

        fclose($f);
    }

    /**
     * Записує назви коллонок.
     * @param Model $model
     */
    private function initColumns(Model $model)
    {
        $columns = $model->getAttributes();

        foreach ($columns as $column => $value) {
            if (! in_array($column, $this->exept)) {
                $this->columns[] = $column;
            }
        }
    }

    /**
     * Отримує значення із моделі і видаляє зайві поля.
     * @param Model $model
     * @return array
     */
    private function getValues(Model $model)
    {
        $values = $model->getAttributes();

        foreach ($values as $key => $value) {
            if (in_array($key, $this->exept)) {
                unset($values[$key]);
            }
        }

        return $values;
    }

}
