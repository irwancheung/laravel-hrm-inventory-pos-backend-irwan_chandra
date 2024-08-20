<?php

namespace App\Http\Controllers\Api;

use App\Models\Leave;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\HttpResponseService;

class LeaveController extends Controller
{
    private $response;

    public function __construct(HttpResponseService $httpResponseService)
    {
        $this->response = $httpResponseService;
    }


    // index
    public function index()
    {

        $leaves = Leave::all();

        return $this->response->success('Leaves fetched successfully', ['leaves' => $leaves]);
    }

    // store
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'leave_type_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'total_days' => 'required',
            'is_half_day' => 'required',
            'reason' => 'required',
            'is_paid' => 'required',
        ]);

        $leave = new Leave();
        $leave->company_id = 1;
        $leave->user_id = $request->user_id;
        $leave->leave_type_id = $request->leave_type_id;
        $leave->start_date = $request->start_date;
        $leave->end_date = $request->end_date;
        $leave->total_days = $request->total_days;
        $leave->is_half_day = $request->is_half_day;
        $leave->reason = $request->reason;
        $leave->is_paid = $request->is_paid;
        $leave->status = 'pending';
        $leave->save();

        return $this->response->created('Leave created successfully', $leave);
    }

    // show
    public function show($id)
    {
        $leave = Leave::find($id);

        if (!$leave) {
            return $this->notFoundResponse();
        }

        return $this->response->success('Leave fetched successfully', $leave);
    }

    // update
    public function update(Request $request, $id)
    {
        $leave = Leave::find($id);

        if (!$leave) {
            return $this->notFoundResponse();
        }

        $request->validate([
            'user_id' => 'required',
            'leave_type_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'total_days' => 'required',
            'is_half_day' => 'required',
            'reason' => 'required',
            'is_paid' => 'required',
            'status' => 'required',
        ]);

        $leave->user_id = $request->user_id;
        $leave->leave_type_id = $request->leave_type_id;
        $leave->start_date = $request->start_date;
        $leave->end_date = $request->end_date;
        $leave->total_days = $request->total_days;
        $leave->is_half_day = $request->is_half_day;
        $leave->reason = $request->reason;
        $leave->is_paid = $request->is_paid;
        $leave->status = $request->status;
        $leave->save();

        return $this->response->success('Leave updated successfully', $leave);
    }

    // destroy
    public function destroy($id)
    {
        $leave = Leave::find($id);

        if (!$leave) {
            return $this->notFoundResponse();
        }

        $leave->delete();

        return $this->response->success('Leave deleted successfully');
    }

    private function notFoundResponse()
    {
        return $this->response->notFound('Leave Type not found');
    }
}
