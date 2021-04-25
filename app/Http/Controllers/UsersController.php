<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUsersRequest;
use App\Http\Requests\UpdateUsersRequest;

class UsersController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:users.index', ['only' => ['index']]);
        $this->middleware('permission:users.create', ['only' => ['create','store']]);
        $this->middleware('permission:users.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:users.show', ['only' => ['show']]);
        $this->middleware('permission:users.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the users.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('users.index');
    }

    /**
     * Show the form for creating a new users.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::get()->pluck('name', 'id');
        return view('users.create', compact('roles'));
    }

    /**
     * Store a new users in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(StoreUsersRequest $request)
    {
        try {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $roles = $request->input('roles') ? $request->input('roles') : [];
            $user->assignRole($roles);

            return redirect()->route('users.index')->with('success', __('global.successfully_updated'));
        } catch (\Exception $th) {
            return back()->withInput()->withErrors(['danger' => "Error: " . $th->getMessage()]);
        }
    }

    /**
     * Display the specified users.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $users = User::findOrFail($id);

        return view('users.show', compact('users'));
    }

    /**
     * Show the form for editing the specified users.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $roles = Role::get()->pluck('name', 'id');
        $users = User::findOrFail($id);
        return view('users.edit', compact('users', 'roles'));
    }

    /**
     * Update the specified users in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, UpdateUsersRequest $request)
    {
        try {
            $user = User::findOrFail($id);
            $user->update($request->all());

            $roles = $request->roles ? $request->roles : [];
            $user->syncRoles($roles);

            return redirect()->route('users.index')->with('success', __('global.successfully_updated'));
        } catch (\Exception $th) {
            return back()->withInput()->withErrors(['danger' => "Error: " . $th->getMessage()]);
        }
    }

    /**
     * Remove the specified users from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $users = User::findOrFail($id);
            $users->delete();
            return response()->json(['status' => 'warning', 'message' => __('global.successfully_destroy')]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', "Error: " . $th->getMessage());
        }
    }

    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
            'email' => 'required|string|min:1|max:255',
            'name' => 'required|string|min:1|max:255',
            'roles' => 'required',
        ];

        $data = $request->validate($rules);
        return $data;
    }

    public function ajaxIndex(){
        $data = User::with('roles')->orderBy("updated_at", 'desc');

        return Datatables::of($data)
        ->addColumn('email', function($data){
            $email = '<a href="mailto:'. $data->email .'">' .$data->email . '</a>';
            return $email;
        })
        ->addColumn('updated_at', function($data){
            $updated_at = $data->updated_at->format('Y/m/d');
            return $updated_at;
        })
        ->addColumn('action', 'users.actions' )
        ->rawColumns(['email', 'roles', 'updated_at', 'action'])->make(true);
    }
}
