<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Sburina\Whmcs\Facades\Whmcs;

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
    protected $redirectTo = '/login';
    private $name = 'successfully registered!';
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
        $result = Whmcs::AddClient([
            'firstname' => $data['name'],
            'lastname' => $data['name'],
            'email' => $data['email'],
            'address1' => '123 Main Street',
            'city' => 'Anytown',
            'state' => 'State',
            'postcode' => '12345',
            'country' => 'US',
            'phonenumber' => '800-555-1234',
            'password2' => $data['password'],
        ]);
        $data['whmcs'] = '';
        if($result['result'] == 'success')
            $data['whmcs'] = 'success';

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'whmcs' => ['required']
        ], [
            'whmcs.required' => 'User exist in whmcs, please try another one',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // $result = Whmcs::AddClient([
        //     'firstname' => $data['name'],
        //     'lastname' => '',
        //     'email' => $data['email'],
        //     'password2' => Hash::make($data['password']),
        // ]);
        
        return User::create([
            'id' => $result['clientid'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /*
     * Override the register function.
     * Make a custom registration and
     * Stop auto login after registration
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        /*$this->guard()->login($user);*/ #Restricted auto login while registration.

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath())
                ->with('success_message', $this->name);
    }



}
