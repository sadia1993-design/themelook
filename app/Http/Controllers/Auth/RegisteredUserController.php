<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Yajra\DataTables\Facades\DataTables;

class RegisteredUserController extends Controller
{

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = User::select('*');
            try {
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {

                        $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a> | '.
                            '<a href="javascript:void(0)" class="edit btn btn-danger btn-sm">Delete</a>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            } catch (\Exception $e) {
                return $e;
            }
        }

        return view('user.index');
    }
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required','string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'city' => ['required'],
            'country' => ['required'],

        ]);

        try{
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'date_of_birth' => $request->dob,
                'city' => $request->city,
                'country' => $request->country,
            ]);

            event(new Registered($user));

            Auth::login($user);

            return redirect(RouteServiceProvider::HOME);
        }
        catch (\Exception $e){
            return $e;

        }
    }
}
