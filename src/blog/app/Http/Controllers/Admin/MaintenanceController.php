<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\MaintenanceService;
use App\Http\Requests\Admin\MaintenanceRequest;

class MaintenanceController extends Controller
{
    protected $maintenance;

    public function __construct(MaintenanceService $maintenance)
    {
        $this->maintenance = $maintenance;
    }

    public function index()
    {
        try {
            $checked = $this->maintenance->getMaintenance();
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return view('admin.maintenance.index', compact('checked'));
    }

    public function maintenance(MaintenanceRequest $request)
    {
        try {
            $this->maintenance->maintenanceMode($request);
            $result = $this->maintenance->getMaintenance();
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        
        if ($result) {
            return redirect()->back()->with(['flag' => 'success', 'message' => 'Turn On Maintenance Mode Success!!']);
        } else {
            return redirect()->back()->with(['flag' => 'success', 'message' => 'Turn Off Maintenance Mode Success!!']);
        }
    }
}
