<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Http\Request;
use App\Utility\CommonHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\User;

class UserController extends Controller {

	protected $common_helper;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct(CommonHelper $common_helper) {
        $this->common_helper = $common_helper;
    }

    public function login(Request $request){
    	try {
        	// dd($request->all());

            $validator = Validator::make($request->all(), [
                        'email' => 'required',
                        'password' => 'required'
                      
            ]);

            if ($validator->fails()) {

                $errors = [];
                foreach ($validator->errors()->messages() as $key => $value)
                {
                    $errors[$key] = is_array($value) ? implode(',', $value) : $value;
                }

                return $this->common_helper->generateResponse(false, 'validation error.', 200, [], $errors);
            }
        	
        	
       
            $commonHelper = new CommonHelper();
          
            $user = User::where('email', $request->email)->where('status', 1)->first();


            if (!empty($user)) {
                    //Matching password using hash
                    $isPasswordMatched = \Hash::check($request->password, $user->password);
                    if ($isPasswordMatched) {
                        /*Auth::loginUsingId($user->id, $rememberMe);*/

                        return $commonHelper->generateResponse(true, 'User list found Successfully', 200, $user);
                    }

                    return $this->common_helper->generateResponse(false, 'Password Not Match', 200);

                }

           	if (empty($user) || is_null($user)) {
            	return $this->common_helper->generateResponse(false, 'No user found', 200);
            }

       
        } catch (\Exception $e) {
             
            return $this->common_helper->generateResponse(false, "Something went wrong", 422);
        }
    }

	public function ProfileUpdate(Request $request){

            $validator = Validator::make($request->all(), [
            			'id' => 'required',
                        'first_name' => 'required',
                        'last_name' => 'required',
                        'email' => 'required',
                        'phone' => 'required'
            ]);

            if ($validator->fails()) {

                $errors = [];
                foreach ($validator->errors()->messages() as $key => $value)
                {
                    $errors[$key] = is_array($value) ? implode(',', $value) : $value;
                }

                return $this->common_helper->generateResponse(false, 'validation error.', 200, [], $errors);
            }
        	
        	

       		$isUpdated = User::where('id',$request->id)->update(
       		 	array(
       		 		'first_name' => $request->first_name,
       		 		'last_name' => $request->last_name,
       		 		'phone' => $request->phone,
       		 		'email' => $request->email
       		 	));

       		$updateData = User::find($request->id);

       		return $this->common_helper->generateResponse(true, 'Profile data updated successfully.', 200, $updateData);
       
    }

	public function ForgotPassword(Request $request){
		// dd($request);
	}

	

}