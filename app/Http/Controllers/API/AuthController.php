<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Twilio\Rest\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{


    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'verify']]);
    }

    /**
     * Register user.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'username' => ['required', 'string', 'max:255'], //  required | string|max:255
                'phone_number' => ['required', 'numeric', 'unique:users'], //  required | numeric | unique
                'password' => ['required', 'string', 'min:6'],// required | string | min:6
            ], []);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        //------------------------------------------------
        $data = $request->only(["username", "phone_number"]);
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        try {
            $token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_sid = getenv("TWILIO_SID");
            $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
            $twilio = new Client($twilio_sid, $token);
            $twilio->verify->v2->services($twilio_verify_sid)
                ->verifications
                ->create($data['phone_number'], "sms");
        }catch (\Exception $e) {
            return response()->json(['data' => ["user" => UserResource::make($user)], 'message' => "good regiseter eroor ensend sms ", 'status' => true], 200);
        }
        return response()->json(['data' => ["user" => UserResource::make($user)], 'message' => "good regiseter verify mobile number", 'status' => true], 200);
    }

    /**
     * verify mobile number
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function verify(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'phone_number' => ['required', 'numeric'], //  required | numeric
                'verification_code' => ['required', 'numeric'],
            ], []);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid = getenv("TWILIO_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client($twilio_sid, $token);
        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create($request->verification_code, array('to' => $request->phone_number));
        if ($verification->valid) {

            User::where('phone_number', $request->phone_number)->update(['is_verified' => true]);
            $user = User::where('phone_number', $request->phone_number)->first();
            $token = Auth::login($user);
            return response()->json(['data' => $this->respondWithToken($token, $user), 'message' => "Phone number verified", 'status' => true], 200);
        }
        return response()->json(['data' => null, 'message' => "Invalid verification code", 'status' => false], 200);
    }

    /**
     * login user..
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'phone_number' => ['required'],
                'password' => ['required'],
            ], []);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $credentials = $request->only('phone_number', 'password');
        if ($token = $this->guard()->attempt($credentials)) {
            $user = auth('api')->user();
            if ($user->is_verified == true) {
                return response()->json(['data' => $this->respondWithToken($token, $user), 'message' => "good login", 'status' => true], 200);
            }
            return response()->json(['data' => null, 'message' => "uncompleted profile ", 'status' => false], 200);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $user = $this->guard()->user();
        return response()->json(['data' => ["user" => UserResource::make($user)], 'message' => "my profile", 'status' => true], 200);

    }


    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard('api')->refresh(), $this->guard()->user());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $user)
    {
        return [
            'user' => UserResource::make($user),
            'token' => [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60
            ]
        ];
    }


}

