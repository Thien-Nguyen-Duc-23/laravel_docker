<?php

namespace App\Services;

use Illuminate\Foundation\Application;
use App\Http\Requests\Admin\MaintenanceRequest;
use Illuminate\Support\Facades\Artisan;

class MaintenanceService
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function getMaintenance()
    {
        if ($this->app->isDownForMaintenance()) {
            return true;
        } else {
            return false;
        }
    }

    public function maintenanceMode(MaintenanceRequest $request)
    {
        if ($request->input('maintenanceMode')) {
            $content = $request->maintenanceContent;
            return Artisan::call('down', ['--message' => $content]);
        } else {
            return Artisan::call('up');
        }
    }
}
