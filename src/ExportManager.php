<?php


namespace Export;


use Illuminate\Database\Eloquent\Collection;

/**
 * Class ExportManager
 * @package Export
 */
class ExportManager
{
    /**
     * @var string[]
     */
    static $types = [
        'csv' => ExportCSV::class,
    ];

    /**
     * @param string $type
     * @param Collection $models
     * @param array $params
     */
    static function export(string $type, Collection $models, array $params)
    {
        (new static::$types[$type])->export($models, $params);
    }


}
