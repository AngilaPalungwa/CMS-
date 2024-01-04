<?php

namespace Modules\Login\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Stringable;

class ResetPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('login::passwordResetForm');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email'=>'required|email|exists:users'
        ]);
        $token=Str::random(50);
        DB::table('password_resets')->insert([
            'email'=>$request->email,
            'token'=>$token,
            'created_at'=>Carbon::now(),
        ]);
        Mail::to($request->email)->send(new ForgotPasswordMail($token));
        session()->flash('success','Please check your email');
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function showResetForm($token)
    {
        if(!$token){
            session()->flash('error','Try again');
        return redirect()->route('login');
        }
        return view('login::finalResetForm',compact('token'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function handleReset(Request $request,$token)
    {

        $request->validate([
            'email'=>'required|email|exists:users',
            'password'=>'required|min:6|confirmed',
            'password_confirmation'=>'required'
        ]);
        $users=DB::table('password_resets')->where([
            'email'=>$request->email,
            'token'=>$token,
        ])->first();
        if($users){
            User::where('email',$request->email)->update(['password'=>bcrypt($request->password)]);
            session()->flash('success','Password UPdated');
            return redirect()->route('login');
        }
        else{
            session()->flash('error','Try again');
            return redirect()->route('login');
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
