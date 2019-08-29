<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminUsersController extends Controller
{

    private $adminUser;

    public function __construct(AdminUser $adminUser)
    {

        $this->adminUser = $adminUser;


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin_users.index', ['adminUsers'=>$this->adminUser->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_users.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $adminUser = AdminUser::create(request(['name', 'email', 'password']));

        Auth::attempt(request(['email', 'password']));

        return redirect()->route('admin_users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(AdminUser $adminUser)
    {
        return view('admin_users.show', compact('adminUser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminUser $adminUser)
    {
        return view('admin_users.edit', compact('adminUser'));
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
        $adminUser = $this->adminUser->find($id);


        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $input = $request->all();

        $adminUser->fill($input)->save();




        return Redirect::to('admin/admin_users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getLogin(){
        return view('admin_users/session.login');
    }

    public function postLogin(Request $request){


        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)){
            return redirect()->route('admin_users.index');

        }else{
            return back()->with('error','your username and password are wrong.');
        }
    }
    public function getLogout(){
        Auth::logout();
        return redirect()->route('admin_users.index');
    }
}
