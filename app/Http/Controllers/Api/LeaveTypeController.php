<?php

namespace App\Http\Controllers\Api;

use App\Models\LeaveType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\HttpResponseService;

class LeaveTypeController extends Controller
{
    private $response;

    public function __construct(HttpResponseService $httpResponseService)
    {
        $this->response = $httpResponseService;
    }

    // index
    public function index()
    {
        $leaveTypes = LeaveType::all();

        return $this->response->success('Leave Types fetched successfully', ['leave_types' => $leaveTypes]);
    }

    // store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'is_paid' => 'required',
            'total_leaves' => 'required',
            'max_leave_per_month' => 'required',
        ]);

        $user = $request->user();

        $leaveType = new LeaveType();
        $leaveType->company_id = 1;
        $leaveType->created_by = $user->id;
        $leaveType->name = $request->name;
        $leaveType->is_paid = $request->is_paid;
        $leaveType->total_leaves = $request->total_leaves;
        $leaveType->max_leave_per_month = $request->max_leave_per_month;
        $leaveType->save();

        return $this->response->created('Leave Type created successfully', $leaveType);
    }

    // show
    public function show($id)
    {
        $leaveType = LeaveType::find($id);

        if (!$leaveType) {
            return $this->notFoundResponse();
        }

        return $this->response->success('Leave Type fetched successfully', $leaveType);
    }

    // update
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'is_paid' => 'required',
            'total_leaves' => 'required',
            'max_leave_per_month' => 'required',
        ]);

        $leaveType = LeaveType::find($id);

        if (!$leaveType) {
            return $this->notFoundResponse();
        }

        $leaveType->name = $request->name;
        $leaveType->is_paid = $request->is_paid;
        $leaveType->total_leaves = $request->total_leaves;
        $leaveType->max_leave_per_month = $request->max_leave_per_month;
        $leaveType->save();

        return $this->response->success('Leave Type updated successfully', $leaveType);
    }

    // destroy
    public function destroy($id)
    {
        $leaveType = LeaveType::find($id);

        if (!$leaveType) {
            return $this->notFoundResponse();
        }

        $leaveType->delete();

        return $this->response->success('Leave Type deleted successfully');
    }

    private function notFoundResponse()
    {
        return $this->response->notFound('Leave Type not found');
    }
}
