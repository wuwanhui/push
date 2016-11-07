<?php

namespace App\Http\Controllers\Auth;

use App\Models\Enterprise;
use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new member as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect member after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/member';

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
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:member',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new member instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        $enterprise = Enterprise::where("name", $data['enterprise'])->first();


        if (!$enterprise) {
            $enterprise = new Enterprise();
            $enterprise->name = $data['enterprise'];
            $enterprise->shortName = $data['name'];
            $enterprise->linkMan = $data['linkMan'];
            $enterprise->mobile = $data['mobile'];
            $enterprise->configId = 0;
            $enterprise->save();
        }

        return Member::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'enterpriseId' => $enterprise->id,
        ]);
    }

    public function guard()
    {
        return Auth::guard('member');
    }
}
