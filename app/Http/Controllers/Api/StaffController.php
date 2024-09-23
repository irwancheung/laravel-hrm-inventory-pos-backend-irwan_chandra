<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Services\HttpResponseService;

class StaffController extends Controller
{
    private $response;

    public function __construct(HttpResponseService $response)
    {
        $this->response = $response;
    }

    // index
    public function index()
    {
        $staffs = User::with('department', 'designation', 'shift', 'role')->get();

        return $this->response->success('Staffs fetched successfully', ['staffs' => $staffs]);
    }

    // store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'username' => 'required|unique:users,username',
            'is_superadmin' => 'required',
            'role_id' => 'required',
            'user_type' => 'required',
            'login_enabled' => 'required',
            'status' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
            'shift_id' => 'required',
        ]);

        $staff = new User();
        $staff->company_id = 1;
        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->password = Hash::make($request->password);
        $staff->username = $request->username;
        $staff->is_superadmin = $request->is_superadmin;
        $staff->role_id = $request->role_id;
        $staff->user_type = $request->user_type;
        $staff->login_enabled = $request->login_enabled;
        $staff->status = $request->status;
        $staff->phone = $request->phone;
        $staff->address = $request->address;
        $staff->department_id = $request->department_id;
        $staff->designation_id = $request->designation_id;
        $staff->shift_id = $request->shift_id;

        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('images/staff', $filename, 'public');
            $staff->profile_image = '/storage/' . $filePath;
        }

        $staff->save();

        return $this->response->created('Staff created successfully', $staff);
    }

    // show
    public function show($id)
    {
        $staff = User::with('department', 'designation', 'shift', 'role')->find($id);

        if (!$staff) {
            return $this->notFoundResponse();
        }

        return $this->response->success('Staff fetched successfully', $staff);
    }

    // update
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'role_id' => 'required',
            'status' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
            'shift_id' => 'required',
        ]);

        $staff = User::find($id);

        if (!$staff) {
            return $this->notFoundResponse();
        }

        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->username = $request->username;
        $staff->role_id = $request->role_id;
        $staff->status = $request->status;
        $staff->phone = $request->phone;
        $staff->address = $request->address;
        $staff->department_id = $request->department_id;
        $staff->designation_id = $request->designation_id;
        $staff->shift_id = $request->shift_id;

        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('images/staff', $filename, 'public');
            $staff->profile_image = '/storage/' . $filePath;
        }

        $staff->save();

        return $this->response->success('Staff updated successfully', $staff);
    }

    // destroy
    public function destroy($id)
    {
        $staff = User::find($id);

        if (!$staff) {
            return $this->notFoundResponse();
        }

        $staff->delete();

        return $this->response->success('Staff deleted successfully');
    }

    private function notFoundResponse()
    {
        return $this->response->notFound('Role not found');
    }
}
