<?php

namespace App\Http\Controllers\Api;

use App\Models\Holiday;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\HttpResponseService;

class HolidayController extends Controller
{
    private $response;

    public function __construct(HttpResponseService $httpResponseService)
    {
        $this->response = $httpResponseService;
    }

    // index
    public function index()
    {
        $holidays = Holiday::all();

        return $this->response->success('Holidays fetched successfully', ['holidays' => $holidays]);
    }

    // store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'date' => 'required',
            'month' => 'required',
            'year' => 'required',
            'is_weekend' => 'required',
        ]);

        $user = $request->user();

        $holiday = new Holiday();
        $holiday->company_id = 1;
        $holiday->created_by = $user->id;
        $holiday->name = $request->name;
        $holiday->date = $request->date;
        $holiday->month = $request->month;
        $holiday->year = $request->year;
        $holiday->is_weekend = $request->is_weekend;
        $holiday->save();

        return $this->response->created('Holiday created successfully', $holiday);
    }

    // show
    public function show($id)
    {
        $holiday = Holiday::find($id);

        if (!$holiday) {
            return $this->notFoundResponse();
        }

        return $this->response->success('Holiday fetched successfully', $holiday);
    }

    // update
    public function update(Request $request, $id)
    {
        $request->validate([
            'name',
            'date',
            'month',
            'year',
            'is_weekend',
        ]);

        $holiday = Holiday::find($id);

        if (!$holiday) {
            return $this->notFoundResponse();
        }

        $holiday->name = $request->name;
        $holiday->date = $request->date;
        $holiday->month = $request->month;
        $holiday->year = $request->year;
        $holiday->is_weekend = $request->is_weekend;
        $holiday->save();

        return $this->response->success('Holiday updated successfully', $holiday);
    }

    // destroy
    public function destroy($id)
    {
        $holiday = Holiday::find($id);

        if (!$holiday) {
            return $this->notFoundResponse();
        }

        $holiday->delete();

        return $this->response->success('Holiday deleted successfully');
    }

    private function notFoundResponse()
    {
        return $this->response->notFound('Holiday not found');
    }
}
