<?php

namespace App\Http\Controllers;

use App\Authority;
use App\Http\Requests\LoginRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['login', 'signin', 'apiSignin', 'initUser']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

//        dd($authorities);
        return view('user.create', ['authorities'=>$this->getAuthorities()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoginRequest $request)
    {
        $allRequest = $request->except('_token');
//        dd(array_merge($allRequest, ['vipass' => $allRequest['password']]));
        $newUser = User::create(array_merge($allRequest, ['vipass' => $allRequest['password']]));
//        dd($newUser);
        return redirect('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findorFail($id);
//        dd($user->name);
        return view('user.edit', ['user' => $user, 'authorities' => $this->getAuthorities()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findorFail($id);
        $allRequest = $request->except('_token');
        $user->update(array_merge($allRequest, ['vipass' => $allRequest['password']]));
        $users = User::all();
        return view('user.index', ['users' => $users]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findorFail($id)->delete();
        return view('user.index', ['users' => User::all()]);

    }

    public function initUser() {
        User::create(['name'=>'管理员1', 'cellphone'=>'15382105748', 'password'=>'15382105748', 'authority_id'=>0, 'vipass'=>'15382105748']);
    }

    public function search($name) {
        $users = User::where('name', 'like', '%'.$name.'%')->get();
        return view('user.index', ['users' => $users]);
    }

    public function login() {
        if (!is_writable(config('session.files')))
            dd('session can not writable');
        return view('user.login');
    }

    public function signin(LoginRequest $request) {
        if (!is_writable(config('session.files')))
            dd('session can not writable');

        if (Auth::attempt([
            'cellphone' =>$request->get('cellphone'),
            'password'  =>$request->get('password'),
        ])) {
            return redirect('/');
        } else {
            \Session::flash('login_failed', '手机号或密码错误！');
            return redirect('login')->withInput();
        }
    }

    public function logout() {
        \Auth::logout();
        return redirect('/');
    }

    private function getAuthorities() {
        $authorities = Authority::select('name')->get();
        $authes = array();
        foreach ($authorities as $auth) {
            array_push($authes, $auth['name']);
        }
        return $authes;
    }



//    API functions
    public function apiSignin(Request $request) {
        $users = User::select('id','name', 'cellphone', 'authority_id')
            ->where('cellphone', $request->get('cellphone'))
            ->where('vipass', $request->get('password'))
            ->get();
//        dd($users);
        if (count($users) > 0) {
            return ['success'=>true, 'user' => $users[0]];
        } else {
            return ['success'=>false];
        }
    }

}
