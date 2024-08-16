<?php

namespace App\Http\Controllers\Api;

use App\Models\Shift;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\HttpResponseService;

class ShiftController extends Controller
{
    private $response;

    public function __construct(HttpResponseService $httpResponseService)
    {
        $this->response = $httpResponseService;
    }

    // index
    public function index()
    {
        $shifts = Shift::all();

        return $this->response->http200('Shifts retrieved successfully', ['shifts' => $shifts]);
    }

    // store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'clock_in_time' => 'required',
            'clock_out_time' => 'required',
        ]);

        $user = $request->user();

        $shift = new Shift();
        $shift->company_id = 1;
        $shift->created_by = $user->id;
        $shift->name = $request->name;
        $shift->clock_in_time = $request->clock_in_time;
        $shift->clock_out_time = $request->clock_out_time;
        $shift->early_clock_in_time = $request->early_clock_in_time;
        $shift->allow_clock_out_until = $request->allow_clock_out_until;
        $shift->late_mark_after = $request->late_mark_after;
        $shift->save();

        return $this->response->http201('Shift created successfully', $shift);
    }

    // show
    public function show($id)
    {
        $shift = Shift::find($id);

        if (!$shift) {
            return $this->notFoundResponse();
        }

        return $this->response->http200('Shift fetched successfully', $shift);
    }

    // update
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'clock_in_time' => 'required',
            'clock_out_time' => 'required',
        ]);

        $shift = Shift::find($id);

        if (!$shift) {
            return $this->notFoundResponse();
        }

        $shift->name = $request->name;
        $shift->clock_in_time = $request->clock_in_time;
        $shift->clock_out_time = $request->clock_out_time;
        $shift->early_clock_in_time = $request->early_clock_in_time;
        $shift->allow_clock_out_until = $request->allow_clock_out_until;
        $shift->late_mark_after = $request->late_mark_after;
        $shift->save();

        return $this->response->http200('Shift updated successfully', $shift);
    }

    // destroy
    public function destroy($id)
    {
        $shift = Shift::find($id);

        if (!$shift) {
            return $this->notFoundResponse();
        }

        $shift->delete();

        return $this->response->http200('Shift deleted successfully');
    }

    private function notFoundResponse()
    {
        return $this->response->http404('Shift not found');
    }
}
