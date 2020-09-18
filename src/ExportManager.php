<?php


namespace Export;


use GoogleMap\Exceptions\InvalidKeyException;
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
     * @throws InvalidKeyException
     */
    static function export(string $type, Collection $models, array $params)
    {
        if (! key_exists($type, static::$types)) {
            throw new InvalidKeyException('Invalid export type');
        }
        (new static::$types[$type])->export($models, $params);
    }


}
