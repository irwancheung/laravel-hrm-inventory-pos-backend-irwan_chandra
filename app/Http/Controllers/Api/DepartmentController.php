<?php

namespace App\Http\Controllers\Api;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\HttpResponseService;

class DepartmentController extends Controller
{
    private $response;

    public function __construct(HttpResponseService $httpResponseService)
    {
        $this->response = $httpResponseService;
    }

    // index
    public function index()
    {
        $departments = Department::all();

        return $this->response->success('Departments fetched successfully', ['departments' =>  $departments]);
    }

    // store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $user = $request->user();

        $department = new Department();
        $department->company_id = 1;
        $department->created_by = $user->id;
        $department->name = $request->name;
        $department->description = $request->description;
        $department->save();

        return $this->response->created('Department created successfully', ['department' =>  $department]);
    }

    // show
    public function show($id)
    {
        $department = Department::find($id);

        if (!$department) {
            return $this->notFoundResponse();
        }

        return $this->response->success('Department fetched successfully',   $department);
    }

    // update
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $department = Department::find($id);

        if (!$department) {
            return $this->notFoundResponse();
        }

        $department->name = $request->name;
        $department->description = $request->description;
        $department->save();

        return $this->response->success('Department updated successfully', $department);
    }

    // destroy
    public function destroy($id)
    {
        $department = Department::find($id);

        if (!$department) {
            return $this->notFoundResponse();
        }

        $department->delete();

        return $this->response->success('Department deleted successfully');
    }

    private function notFoundResponse()
    {
        return $this->response->notFound('Department not found');
    }
}
