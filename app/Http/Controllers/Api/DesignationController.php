<?php

namespace App\Http\Controllers\Api;

use App\Models\Designation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\HttpResponseService;

class DesignationController extends Controller
{
    private $response;

    public function __construct(HttpResponseService $httpResponseService)
    {
        $this->response = $httpResponseService;
    }

    // index
    public function index()
    {
        $designations = Designation::all();

        return $this->response->http200('Designations fetched successfully', ['designations' =>  $designations]);
    }

    // store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $user = $request->user();

        $designation = new Designation();
        $designation->company_id = 1;
        $designation->created_by = $user->id;
        $designation->name = $request->name;
        $designation->description = $request->description;
        $designation->save();

        return $this->response->http201('Designation created successfully', $designation);
    }

    // show
    public function show($id)
    {
        $designation = Designation::find($id);

        if (!$designation) {
            return $this->notFoundResponse();
        }

        return $this->response->http200('Designation fetched successfully', $designation);
    }

    // update
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $designation = Designation::find($id);

        if (!$designation) {
            return $this->notFoundResponse();
        }

        $designation->name = $request->name;
        $designation->description = $request->description;
        $designation->save();

        return $this->response->http200('Designation updated successfully', $designation);
    }

    // destroy
    public function destroy($id)
    {
        $designation = Designation::find($id);

        if (!$designation) {
            return $this->notFoundResponse();
        }

        $designation->delete();

        return $this->response->http200('Designation deleted successfully');
    }

    private function notFoundResponse()
    {
        return $this->response->http404('Designation not found');
    }
}
