<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Media;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        return view('profile.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function show(UserProfile $userProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $user = User::with('profile')->findOrFail($id);
            $user->update([
                'username' => $request->input('username'),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
            ]);

            if ($request->hasFile('avatar')) {

                if (File::exists(public_path() . '/storage' . $user->profile->avatar)) {
                    File::delete(public_path() . '/storage' . $user->profile->avatar);
                }

                $avatar = $request->file('avatar');

                $destinationPath = '/uploads/' . date('Y') . '/' . date('m') . '/' . date('d');
                $filename = $avatar->getClientOriginalName();

                $data = $destinationPath . '/' . $filename;

                $avatar->storeAs($destinationPath, $filename, 'public');

            } else {
                $data = $user->profile ? $user->profile->avatar : null;
            }

            UserProfile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'mobile' => $request->input('mobile'),
                    'gender' => $request->input('gender'),
                    'date_of_birth' => $request->input('date_of_birth'),
                    'url_website' => $request->input('url_website'),
                    'url_facebook' => $request->input('url_facebook'),
                    'url_twitter' => $request->input('url_twitter'),
                    'url_instagram' => $request->input('url_instagram'),
                    'url_linkedin' => $request->input('url_linkedin'),
                    'url_github' => $request->input('url_github'),
                    'country' => $request->input('country'),
                    'state' => $request->input('state'),
                    'city' => $request->input('city'),
                    'avatar' => $data,
                ]
            );

            return redirect()->route('profile.index')->with('success', __('global.successfully_updated'));
        } catch (\Throwable $th) {
            return redirect()->back()->with(['danger', 'Error' . $th->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->id == auth()->user()->id) {
            $user->delete();
            Auth::logout();
        }
        return redirect()->route('login')->with('warning', __('global.successfully_destroy'));
    }
}
