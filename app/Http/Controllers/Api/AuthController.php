<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiTrait;
class AuthController extends Controller
{
    use ApiTrait;

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return   $this->apiResponse(null, $validator->errors()->first(), 422);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $data['token'] = $user->createToken('MyApp')->plainTextToken;
            $data['user'] = $user;

            return  $this->apiResponse($data, 'User login successfully.');
        } else {
            return  $this->apiResponse(null, 'Unauthorised', 401);
        }
    }
}
