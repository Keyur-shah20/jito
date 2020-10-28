<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(){
        $users = User::select('id','first_name','last_name','email','phone')->get();
        return view('user/index',['users'=>$users]);
    }

    public function add(){
        return view('user/add');
    }

    public function save(RegisterRequest $request){
        try {
            $message = trans('messages.error');
            $user = User::create([
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'phone' => $request['phone'],
                'email' => $request['email'],
                // 'password' => bcrypt($request['password']),
            ]);
            if (!empty($user)) {
                $message = trans('messages.registered');
                    return redirect('admin/user')->with('success_msg', $message);
            }
        } catch (\Exception $e) {
            Log::error(__CLASS__ . "::" . __METHOD__ . "  " . $e->getMessage() . "on line" . $e->getLine());
        }
        return redirect('admin/user')->with('error_msg', $message);
    }

    public function edit(Request $request){
        $userDetails = User::select('id','first_name','last_name','email','phone')->where('id',$request->id)->first();
        return view('user/edit',['userDetails'=>$userDetails]);
    }

    public function update(UpdateUserRequest $request){
        $isUpdated = User::where('id',$request->id)->update(['first_name'=>$request->first_name,'last_name'=>$request->last_name,'phone'=>$request->phone,'email'=>$request->email]);
        if($isUpdated){
            return redirect()->back()->with('success_msg',trans('messages.user_updated'));
        }else{
            return redirect()->back()->with('error_msg',trans('messages.error_msg'));
        }

    }

    public function delete(Request $request){
        $isDeleted = User::where('id',$request->id)->delete();
        if($isDeleted){
            return redirect()->back()->with('success_msg',trans('messages.user_deleted'));
        }else{
            return redirect()->back()->with('error_msg',trans('messages.error_msg'));
        }
    }
}
