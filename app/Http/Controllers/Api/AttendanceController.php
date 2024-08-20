<?php

namespace App\Http\Controllers\Api;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\HttpResponseService;

class AttendanceController extends Controller
{
    private $response;

    public function __construct(HttpResponseService $httpResponseService)
    {
        $this->response = $httpResponseService;
    }

    // index
    public function index()
    {
        $attendances = Attendance::all();

        return $this->response->success('Attendances fetched successfully', ['attendances' =>  $attendances]);
    }

    // store
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'user_id' => 'required',
            'is_holiday' => 'nullable',
            'is_leave' => 'nullable',
            'leave_id' => 'nullable',
            'holiday_id' => 'nullable',
            'clock_in_date_time' => 'required',
            'clock_out_date_time' => 'nullable',
            'total_duration' => 'nullable',
            'is_late' => 'nullable',
            'is_half_day' => 'nullable',
            'is_paid' => 'nullable',
            'status' => 'required',
            'reason' => 'nullable',
        ]);

        $attendance = new Attendance();
        $attendance->company_id = 1;
        $attendance->user_id = $request->user_id;
        $attendance->date = $request->date;
        $attendance->is_holiday = $request->is_holiday;
        $attendance->is_leave = $request->is_leave;
        $attendance->leave_id = $request->leave_id;
        $attendance->holiday_id = $request->holiday_id;
        $attendance->clock_in_date_time = $request->clock_in_date_time;
        $attendance->clock_out_date_time = $request->clock_out_date_time;
        $attendance->total_duration = $request->total_duration;
        $attendance->is_late = $request->is_late;
        $attendance->is_half_day = $request->is_half_day;
        $attendance->is_paid = $request->is_paid;
        $attendance->status = $request->status;
        $attendance->reason = $request->reason;
        $attendance->save();

        return $this->response->created('Attendance created successfully', $attendance);
    }

    // show
    public function show($id)
    {
        $attendance = Attendance::find($id);

        if (!$attendance) {
            return $this->notFoundResponse();
        }

        return $this->response->success('Attendance fetched successfully', $attendance);
    }

    // update
    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required',
            'user_id' => 'required',
            'is_holiday' => 'nullable',
            'is_leave' => 'nullable',
            'leave_id' => 'nullable',
            'holiday_id' => 'nullable',
            'clock_in_date_time' => 'required',
            'clock_out_date_time' => 'nullable',
            'total_duration' => 'nullable',
            'is_late' => 'nullable',
            'is_half_day' => 'nullable',
            'is_paid' => 'nullable',
            'status' => 'required',
            'reason' => 'nullable',
        ]);

        $attendance = Attendance::find($id);

        if (!$attendance) {
            return $this->notFoundResponse();
        }

        $attendance->user_id = $request->user_id;
        $attendance->date = $request->date;
        $attendance->is_holiday = $request->is_holiday;
        $attendance->is_leave = $request->is_leave;
        $attendance->leave_id = $request->leave_id;
        $attendance->holiday_id = $request->holiday_id;
        $attendance->clock_in_date_time = $request->clock_in_date_time;
        $attendance->clock_out_date_time = $request->clock_out_date_time;
        $attendance->total_duration = $request->total_duration;
        $attendance->is_late = $request->is_late;
        $attendance->is_half_day = $request->is_half_day;
        $attendance->is_paid = $request->is_paid;
        $attendance->status = $request->status;
        $attendance->reason = $request->reason;
        $attendance->save();

        return $this->response->success('Attendance updated successfully', $attendance);
    }

    // destroy
    public function destroy($id)
    {
        $attendance = Attendance::find($id);

        if (!$attendance) {
            return $this->notFoundResponse();
        }

        $attendance->delete();

        return $this->response->success('Attendance deleted successfully');
    }

    private function notFoundResponse()
    {
        return $this->response->notFound('Attendance not found');
    }
}
