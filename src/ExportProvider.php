<?php


namespace Export;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\ServiceProvider;

/**
 * Class ExportProvider
 * @package Export
 */
class ExportProvider extends ServiceProvider
{
    public function register()
    {
        Collection::macro(
            'export',
            function ($type, $params) {
                ExportManager::export($type, $this, $params);
            }
        );

    }
}
