<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::INTENT_FORM;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $regex = '/(\+?\d{2}?\s?\d{3}\s?\d{3}\s?\d{4})|([0]\d{3}\s?\d{3}\s?\d{4})/';
        
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'course' => ['required', 'string'],
            'student_number' => ['required', 'int'],
            'mobile_number' => ['required', 'string', 'regex:'.$regex]
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name'              => $data['last_name'],
            'email'             => $data['email'],
            'first_name'        => ucwords(strtolower($data['first_name'])),
            'middle_name'       => ucwords(strtolower($data['middle_name'])),
            'last_name'         => ucwords(strtolower($data['last_name'])),
            'password'          => Hash::make($data['password']),
            'birthday'          => now(),
            'mobile_number'     => $data['mobile_number'],
            'picture'           => '',
            'role_id' => 0
        ]);

        $user->student()->create([
            'user_id'           => $user->id,
            'student_number'    => $data['student_number'],
            'course_id'         => $data['course'],
            'ojt_status'        => 0
        ]);

        $user->student->studentProgress()->create([
            'student_id'    => $user->student->id
        ]);
            
        return $user;
    }
}
