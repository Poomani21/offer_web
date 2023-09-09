<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileCollection;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserProfile;
use App\Http\Traits\Upload;


class LoginController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','logout']]);
        auth()->setDefaultDriver('api');
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    
    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);
        $credentials['status'] = 1;
        $user = User::where('email',$request->email)->first();
        if(!$user) {
            return response()->json(['error' => 'Invalid User'], 401);
        }
        if($user->status == 0) {
            return response()->json(['error' => 'Your account is inactive. Please contact admin'], 401);
        } 
        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);

    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function me()
    {
        $userId = auth()->user()->id;
        $userProfileList = User::with('userProfile')->where('id',$userId)->first();
        if ($userProfileList) {
            $userProfile = new ProfileCollection($userProfileList);
            return response()->json(['message' => 'My Profile Details', 'userProfile' => $userProfile]);
        } else {
            return response()->json(['message' => 'Unauthorized User']);
        }
    }

    public function profileUpdate(Request $request) {
        $user = User::find(auth()->user()->id);
        $user->email = $request->email;
        if($request->password != '') {
            $user->password = bcrypt($request->password);
        }
        $user->update();
        $userProfileId = $user->userProfile->id;

        $userProfile = UserProfile::find($userProfileId);
        $userProfile->first_name = $request->first_name;
        $userProfile->last_name = $request->last_name;
        $userProfile->mobile_no = $request->mobile_no;
        $userProfile->address = $request->address;
        $userProfile->state = $request->state;
        $userProfile->city = $request->city;
        $userProfile->pincode = $request->pincode;
        if ($request->has('user_photo')) {
			$image = $request->file('user_photo');
			$folder = config('larasnap.uploads.user.path');
			
			$imgName = $this->upload($image, $folder, 'user', auth()->user()->id);
			
            $userProfile->user_photo  = $imgName;
		}
        $userProfile->update();
        if ($userProfile) {
            return response()->json(['message' => 'User Profile Updated Sucessfully']);
        } else {
            return response()->json(['message' => 'Unauthorized User']);
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */ 

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'message' => 'successfully login',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

}
