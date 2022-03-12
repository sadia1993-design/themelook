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
                    ->editColumn('status', function ($row) {
                        $status = '';
                        if ($row->status == 'active') {
                            $status .= "<label class='badge badge-success'> Active </label>";
                        } else {
                            $status .= "<label class='badge badge-secondary'> Inactive </label>";
                        }
                        return $status;
                    })
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="'.route('user.edit', $row->id).'" class="edit btn btn-primary btn-sm" title="Edit"><i class="fa fa-edit"></i></a> | '.
                            '<a  href="'.route('user.destroy', $row->id).'" class="edit btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'status'])
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

            if ($request->status == 'active') {
                $status = "active";
            } else {
                $status = "inactive";
            }

            $data = new User();
            $data->username = $request->username;
            $data->email = $request->email;
            $data->password = Hash::make($request->password);
            $data->date_of_birth = $request->dob;
            $data->city = $request->city;
            $data->status = $status;
            $data->country = $request->country;
            $data->save();

            event(new Registered($data));

//            Auth::login($user);

            return redirect('login');
        }
        catch (\Exception $e){
            return $e;

        }
    }


    public function edit($id){
        $user = User::find($id);
        return view('user.show', compact('user'));
    }

    public function update(Request $request , $id){


        $request->validate([
            'username' => ['required','string'],
            'email' => ['required', 'email'],
            'password' => ['required' , ' min:8'],
            'city' => ['required'],
            'country' => ['required'],
            'date_of_birth' => ['required'],

        ]);

        try {
            if ($request->status == 'active') {
                $status = "active";
            } else {
                $status = "inactive";
            }

            $data = User::find($id);
            $data->username = $request->username;
            $data->email = $request->email;
            $data->password = Hash::make($request->password);
            $data->date_of_birth = $request->date_of_birth;
            $data->city = $request->city;
            $data->status = $status;
            $data->country = $request->country;
            $data->save();
            return redirect()->route('user')->with('success', 'User updated successfully');
        } catch (\exception $e) {
            return $e;
        }

    }

    public function destroy($id){
        try {

            $user = User::find($id);
            if ($user->delete()) {
                return redirect()->back();
            }
            return redirect()->back();
        } catch(\Exception $e){
            return $e;

        }
    }
}
