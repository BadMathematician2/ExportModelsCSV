<?php


namespace Export;

use Illuminate\Support\Collection;

/**
 * Interface Export
 * @package Export
 */
interface Export
{
    /**
     * @param Collection $models
     * @param array $params
     * @return mixed
     */
    public function export(Collection $models, array $params);

}
