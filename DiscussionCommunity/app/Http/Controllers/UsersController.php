<?php

namespace App\Http\Controllers;

use App\User;
//use Faker\Provider\Image;
//use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Support\MessageProvider;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;


class UsersController extends Controller
{

    public function register()
    {
        return view('users.register');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\UserRegisterRequest $request)
    {
        $data = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'confirm_code' => str_random(48),
            'avatar' => '/images/default-avatar.png',
        ];

        User::register($data);

        return redirect('/');
    }

    public function confirmEmail($confirm_code)
    {
//        dd($confirm_code);
        $user = DB::table('users')->where('confirm_code', $confirm_code)->first();

        if (is_null($user)) {
            return redirect('/');
        }

        DB::table('users')
            ->where('id', $user->id)
            ->update(['is_confirmed' => 1, 'confirm_code' => str_random(48)]);

        return redirect('user/login');
    }

    public function login()
    {
        return view('users.login');
    }

    public function signin(Requests\UserLoginRequest $request)
    {
        if (Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'is_confirmed' => 1
        ])
        ) {
            return redirect('/');
        }
        session()->flash('user_login_failed', '密码不正确或邮箱没验证');
        return redirect('/user/login')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function avatar()
    {
        return view('users.avatar');
    }

    public function changAvatar(Request $request)
    {
        $file = $request->file('avatar');
        $input = array('image' => $file);
        $rules = array(
            'image' => 'image'
        );
        $validator = Validator::make($input, $rules);
        if ( $validator->fails() ) {
            return response()->json([
                'success' => false,
                'errors' => $validator->MessageProvider->getMessageBag()->toArray()
            ]);
        }
        $destinationPath = 'uploads/';
        $filename = Auth::user()->id . '_' . time() . $file->getClientOriginalName();
        $file->move($destinationPath, $filename);
        Facades\Image::make($destinationPath . $filename)->fit(200)->save();
        $user = User::find(Auth::user()->id);
        $user->avatar = '/' . $destinationPath . $filename;
        $user->save();
        return response()->json(
            [
                'success' => true,
                'avatar' => asset($destinationPath.$filename),
            ]
        );
    }
}
