<?php

namespace App\Http\Controllers\Api;

use App\Models\BasicSalary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\HttpResponseService;

class BasicSalaryController extends Controller
{
    protected $response;

    public function __construct(HttpResponseService $httpResponseService)
    {
        $this->response = $httpResponseService;
    }

    // index
    public function index()
    {
        $basicSalaries = \App\Models\BasicSalary::all();

        return $this->response->http200(
            'Basic Salaries fetched successfully',
            ['basic_salaries' => $basicSalaries]
        );
    }

    // store
    public function store(Request $request)
    {
        $request->validate([
            'basic_salary' => 'required',
            'user_id' => 'required',
        ]);

        $user = $request->user();

        $basicSalary = new BasicSalary();
        $basicSalary->company_id = 1;
        $basicSalary->user_id = $request->user_id;
        $basicSalary->basic_salary = $request->basic_salary;
        $basicSalary->save();

        return $this->response->http201('Basic Salary created successfully', $basicSalary);
    }

    // show
    public function show($id)
    {
        $basicSalary = \App\Models\BasicSalary::find($id);

        if (!$basicSalary) {
            return response()->json([
                'message' => 'Basic Salary not found',
            ], 404);
        }

        return $this->response->http200('Basic Salary fetched successfully', $basicSalary);
    }
    // update
    public function update(Request $request, $id)
    {
        $request->validate([
            'basic_salary' => 'required',
            'user_id' => 'required',
        ]);

        $basicSalary = \App\Models\BasicSalary::find($id);

        if (!$basicSalary) {
            return response()->json([
                'message' => 'Basic Salary not found',
            ], 404);
        }

        $basicSalary->basic_salary = $request->basic_salary;
        $basicSalary->user_by = $request->user_id;
        $basicSalary->save();

        return $this->response->http200('Basic Salary updated successfully', $basicSalary);
    }

    // destroy
    public function destroy($id)
    {
        $basicSalary = \App\Models\BasicSalary::find($id);

        if (!$basicSalary) {
            return response()->json([
                'message' => 'Basic Salary not found',
            ], 404);
        }

        $basicSalary->delete();

        // return response()->json([
        //     'message' => 'Basic Salary deleted successfully',
        // ], 200);

        return $this->response->http200('Basic Salary deleted successfully');
    }
}
