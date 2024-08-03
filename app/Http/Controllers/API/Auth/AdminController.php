<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Traits\ApiTrait;
use Exception;
use Illuminate\Validation\ValidationException;
use Validator;

class AdminController extends Controller
{
    use ApiTrait;


    public function login(Request $request)
    {
        try {

            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);
        } catch (Exception $e) {
            return $this->returnError(500, 'Error something went!');
        }

        $credentials = $request->only('email', 'password');

        $token = Auth::guard('admin-api')->attempt($credentials);

        if (!$token) {
            return $this->returnError(401, 'Unauthorized');
        }


        $admin = Auth::guard('admin-api')->user();
        $admin->api_token = $token;

        return $this->returnData('logined successfully!', $admin, 200);
    }

    public function register(Request $request)
    {

        try {
            $request->validate([
                'name' => 'required|string|max:60',
                'email' => 'required|string|email|max:255|unique:admins,email',
                'password' => 'required|string|min:6',
            ]);
        } catch (Exception $e) {
            return $this->returnError(500, $e->getMessage());
        }

        $user = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $credentials = $request->only('name', 'email', 'password');


        $token = Auth::guard('admin-api')->attempt($credentials);

        if (!$token) {
            return $this->returnError(401, 'Unauthorized');
        }
        $admin = Auth::guard('admin-api')->user();
        $admin->api_token = $token;

        return $this->returnData('Registed successfully!', $admin, 200);
    }



    public function logout()
    {
        try {
            Auth::guard('admin-api')->logout();
            return $this->returnSuccessMessage(200, 'Successfully logged out');

        } catch (Exception $e) {
            return $this->returnError(401, 'something went wrong');
        }
    }

    public function profile()
    {
        try {
            return response()->json(Auth::guard('admin-api')->user());

        } catch (Exception $e) {
            return $this->returnError(500, 'Error something went!');
        }
    }

}