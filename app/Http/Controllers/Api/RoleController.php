<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\HttpResponseService;

class RoleController extends Controller
{
    private $response;

    public function __construct(HttpResponseService $httpResponseService)
    {
        $this->response = $httpResponseService;
    }

    // index
    public function index()
    {
        $roles = Role::all();

        return $this->response->success('Roles fetched successfully', ['roles' => $roles]);
    }

    // store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $role = new Role();
        $role->company_id = 1;
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();

        // return response()->json([
        //     'message' => 'Role created successfully',
        //     'data' => $role,
        // ], 201);

        return $this->response->created('Role created successfully', $role);
    }

    // show
    public function show($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return $this->notFoundResponse();
        }

        return $this->response->success('Role fetched successfully', $role);
    }

    // update
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            // 'permissionIds' => 'required|array',
        ]);

        $role = Role::find($id);

        if (!$role) {
            return $this->notFoundResponse();
        }

        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();

        // $role->permissions()->sync($request->permissionIds);

        return $this->response->success('Role updated successfully', $role);
    }

    // destroy
    public function destroy($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return $this->notFoundResponse();
        }

        $role->delete();

        return $this->response->success('Role deleted successfully');
    }

    private function notFoundResponse()
    {
        return $this->response->notFound('Role not found');
    }
}
