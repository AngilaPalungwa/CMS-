<?php

namespace Modules\AdminUser\Http\Controllers;

use App\Models\User;
use App\Models\UserDetal;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {

        $query=User::query();
        $searchTerm=$request->search;
        if($searchTerm){
            $query->where('username','LIKE','%'.$searchTerm.'%')
            ->orWhere('email','LIKE','%'.$searchTerm.'%')
            ->orWhere('name','LIKE','%'.$searchTerm.'%');
            $data['users']=$query->get();
            return view('adminuser::index',$data);
        }
        $data['users'] = User::paginate(20);
        return view('adminuser::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('adminuser::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
        ]);
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'username' => $request->username,
            'mobile' => $request->mobile,
            // 'status'=>$request->status??'active',
        ];
        $user_id = User::insertGetId($userData);
        $profile = '';
        if ($request->has('profile') && $request->file('profile')) {
            $file = $request->file('profile');
            $newName = time() . $file->getClientOriginalExtension();
            $path = public_path('Profiles/');
            $file->move($path, $newName);
            $profile = $newName;
        }

        if ($user_id) {
            $userDetailData = [
                'user_id' => $user_id,
                'address' => $request->address,
                'profile' => $profile,
                'designation' => $request->designation,

            ];
            UserDetal::insert($userDetailData);
        }
        $request->session()->flash('Success', 'User created successfully');
        return redirect()->route('users.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('adminuser::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {

        if (!$id) {
            session()->flash('error', 'something went wrong');
            return redirect()->route('users.index');
        }
        $data['user'] = User::with('profile')->find($id);
        return view('adminuser::edit', $data);
    }
    public function reset(Request $request)
    {
        $id=$request->id;
        $password=$request->password;

       if(!$id||!$password){
        $request->session()->flash('error','Something is wrong');
        return redirect()->route('users.index');
       }
       $user=User::find($id);
       if($user){
            $user->update(['password'=>bcrypt($password)]);
        $request->session()->flash('success','password reset successfully');
        return redirect()->route('users.index');
       }
       $request->session()->flash('error','User not found');
       return redirect()->route('users.index');

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        if (!$id) {
            session()->flash('error', 'something went wrong');
            return redirect()->route('users.index');
        }
        $user = User::with('profile')->find($id);
        if ($user) {

            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'username' => 'required',
            ]);
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'username' => $request->username,
                'mobile' => $request->mobile,
                // 'status'=>$request->status??'active',
            ];
            $user->update($userData);
            $profile = '';
            if ($request->has('profile') && $request->file('profile')) {
                // if (file_exists(public_path('profiles/') . $user->profile->profile)) {
                //     unlink(public_path('profiles/') . $user->profile->profile);
                // }
                $file = $request->file('profile');
                $newName = time() . $file->getClientOriginalExtension();
                $path = public_path('Profiles/');
                $file->move($path, $newName);
                $profile = $newName;
            }


            $userDetailData = [
                'user_id' => $id,
                'address' => $request->address,
                'profile' => $profile,
                'designation' => $request->designation,

            ];
            UserDetal::where('user_id', $id)->update($userDetailData);

            $request->session()->flash('Success', 'User Updated successfully');
            return redirect()->route('users.index');
        }
        session()->flash('error', 'something went wrong');
        return redirect()->route('users.index');
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    //
    public function destroy($id)
    {
        if (!$id) {
            session()->flash('error', 'Something went Wrong!!');
            return redirect()->route('users.index');
        }

        $user = User::find($id);
        if ($user) {
            $user->delete();
            session()->flash('success', 'User Delete Successfully');
            return redirect()->route('users.index');
        }

        session()->flash('error', 'Something went Wrong!!');
        return redirect()->route('users.index');
    }
}
