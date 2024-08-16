<?php

namespace App\Http\Controllers\Api;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\HttpResponseService;

class PermissionController extends Controller
{
    private $response;

    public function __construct(HttpResponseService $httpResponseService)
    {
        $this->response = $httpResponseService;
    }

    // index
    public function index()
    {
        $permissions = Permission::all();

        return $this->response->success('Permissions fetched successfully', $permissions);
    }

    // store
    public function store(Request $request)
    {
        $request->validate([
            'name',
            'display_name',
            'description',
            'module_name'
        ]);

        $permission = new Permission();
        $permission->name = $request->name;
        $permission->display_name = $request->display_name;
        $permission->description = $request->description;
        $permission->module_name = $request->module_name;
        $permission->save();

        return $this->response->created('Permission created successfully', $permission);
    }

    // show
    public function show($id)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            return $this->notFoundResponse();
        }

        return $this->response->success('Permission fetched successfully', $permission);
    }

    // update
    public function update(Request $request, $id)
    {
        $request->validate([
            'name',
            'display_name',
            'description',
            'module_name'
        ]);

        $permission = Permission::find($id);

        if (!$permission) {
            return $this->notFoundResponse();
        }

        $permission->name = $request->name;
        $permission->display_name = $request->display_name;
        $permission->description = $request->description;
        $permission->module_name = $request->module_name;
        $permission->save();

        return $this->response->success('Permission updated successfully', $permission);
    }

    // destroy
    public function destroy($id)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            return $this->notFoundResponse();
        }

        $permission->delete();

        return $this->response->success('Permission deleted successfully');
    }

    private function notFoundResponse()
    {
        return $this->response->notFound('Permission not found');
    }
}
