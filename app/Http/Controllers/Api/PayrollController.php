<?php

namespace App\Http\Controllers\Api;

use App\Models\Payroll;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\HttpResponseService;

class PayrollController extends Controller
{
    private $response;

    public function __construct(HttpResponseService $httpResponseService)
    {
        $this->response = $httpResponseService;
    }

    // index
    public function index()
    {

        $payrolls = Payroll::all();

        return $this->response->success('Payrolls fetched successfully', ['payrolls' => $payrolls]);
    }

    // store
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'salary' => 'required',
            'month' => 'required',
            'year' => 'required',
            'status' => 'required',
        ]);

        $payroll = new Payroll();
        $payroll->company_id = 1;
        $payroll->user_id = $request->user_id;
        $payroll->salary = $request->salary;
        $payroll->month = $request->month;
        $payroll->year = $request->year;
        $payroll->status = $request->status;
        $payroll->save();

        return $this->response->created('Payroll created successfully', $payroll);
    }

    // show
    public function show($id)
    {
        $payroll = Payroll::find($id);

        if (!$payroll) {
            return $this->notFoundResponse();
        }

        return $this->response->success('Payroll fetched successfully', $payroll);
    }

    // update
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'salary' => 'required',
            'month' => 'required',
            'year' => 'required',
            'status' => 'required',
        ]);

        $payroll = Payroll::find($id);

        if (!$payroll) {
            return $this->notFoundResponse();
        }

        $payroll->user_id = $request->user_id;
        $payroll->salary = $request->salary;
        $payroll->month = $request->month;
        $payroll->year = $request->year;
        $payroll->status = $request->status;
        $payroll->save();

        return $this->response->success('Payroll updated successfully', $payroll);
    }

    // destroy
    public function destroy($id)
    {
        $payroll = Payroll::find($id);

        if (!$payroll) {
            return $this->notFoundResponse();
        }

        $payroll->delete();

        return $this->response->success('Payroll deleted successfully');
    }

    private function notFoundResponse()
    {
        return $this->response->notFound('Holiday not found');
    }
}
