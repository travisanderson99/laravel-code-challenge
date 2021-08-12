<?php

namespace App\Http\Controllers\Auth;

use App\Invite;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/';

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
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            //'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
        // Find the invite
        $invite = Invite::where('token', $data['invite_token'])->first();

        // Create the user
        $user = User::create([
            'name'       => $data['name'],
            'username'   => $data['email'],
            'email'      => $data['email'],
            'password'   => Hash::make($data['password'])
        ]);

        // Grant user their role
        if ($invite) {
            $user->assignRole($invite->role);
            if ($invite->role == 'Coach') {
                if (!$user->teams()->where('team_id', $invite->team_id)->exists()) {
                    $user->teams()->attach($invite->team_id, ['accepted' => 1]);
                }
            } elseif ($invite->role == 'Program Director') {
                if (!$user->programs()->where('program_id', $invite->program_id)->exists()) {
                    $user->programs()->attach($invite->program_id);
                }
            }
            $invite->is_claimed = 1;
            $invite->save();
        }

        return $user;
    }

    /**
     * Redirect to login page
     */    
    public function showRegistrationForm()
    {
        return redirect('login');
    }
}
