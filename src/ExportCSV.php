<?php


namespace Export;


use Export\Exceptions\FilePathException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class ExportCSV
 * @package Export
 */
class ExportCSV implements Export
{
    /**
     * @var array
     */
    private $columns = [];
    /**
     * @var string[]
     */
    private $except;

    /**
     * @param Collection $models
     * @param array $params
     * @throws FilePathException
     */
    public function export(Collection $models, array $params )
    {
       $this->checkParams($params);
        $f = fopen($params['file_path'] . '.csv', 'w');

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
            if (! in_array($column, $this->except)) {
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
            if (in_array($key, $this->except)) {
                unset($values[$key]);
            }
        }

        return $values;
    }

    /**
     * @param array $params
     * @throws FilePathException
     */
    private function checkParams(array $params)
    {
        if (isset($params['except'])) {
            $this->except = $params['except'];
        }
        if (! isset($params['file_path'])) {
            throw new FilePathException('In params must be file_path and it must be not null!');
        }
    }

}
