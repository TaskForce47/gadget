<?php

namespace App\Http\Controllers\Auth;

use App\Http\Models\Ticketlog;
use App\Http\Models\Action;
use App\Http\Controllers\Controller;
use App\Http\Models\User;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


/**
 * @property array|string passwordOld
 */
class ChangePasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function validator(array $data)
    {
        $validator = Validator::make($data, [
            'passwordOld' => 'required|min:6',
            'password' => 'required|min:6|confirmed',
        ]);
        $validator->after(function ($validator) {
            var_dump($this);
        });

        return $validator;
    }

    public function changePassword(Request $request) {
        $data = array('passwordOld' => $request->input('passwordOld'),
            'password' => $request->input('password'),
            'password_confirmation' => $request->input('password_confirmation'));

        $validator = Validator::make($data, [
            'passwordOld' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
        $this->passwordOld = $request->input('passwordOld');


        $validator->after(function ($validator) {
            //$creds = $request->input('password');
            if(Auth::once(['name' => Auth::user()->name, 'password' => $this->passwordOld])) {
            } else {
                $validator->errors()->add('wrongPassword', 'Das Passwort ist falsch!');
            }
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $user = User::find(Auth::id());
            $user->fill([
                'password' => Hash::make($request->input('password'))
            ])->save();
            return '';
        }



        return redirect()->back();
    }
}
