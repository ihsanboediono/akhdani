<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.profile.profile');
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, User $user)
    {
        $user = auth()->user();
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique(User::class)->ignore($user->id)],
        ]);
        if ($request->file('image')) {
            $request->validate([
                'image'=>['image','file','max:3024'],
            ]);
        }
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        if ($request->file('image')) {
            if ($user->image != null) {
                Storage::disk('public')->delete($user->image);
            }
            $data['image'] = $request->file('image')->store('user');
        }
        // dd($data);
        $update = User::find($user->id)->update($data);
        if ($update) {
            Alert::toast('Berhasil mengubah profil.', 'success');
        }else{
            Alert::toast('Gagal mengubah profil.', 'error');
        }
        return redirect()->to(route('admin.profile.index'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find(auth()->user()->id);
        
        $request->validate([
            'password' => ['required', Password::min(8)->mixedCase()],
            'new_password' => ['required', Password::min(8)->mixedCase()],
            'password_confirmation' => ['required', 'same:new_password', Password::min(8)->mixedCase()],
        ]);
            
        if ( !Hash::check($request->password, $user->password, []) ) {
            Alert::toast('Gagal mengubah password.', 'error');
        }else{
            User::find($user->id)->update([
                'password' => Hash::make($request->new_password),
            ]);
            Alert::toast('Berhasil mengubah password.', 'success');
        }
        
        return redirect()->to(route('admin.profile.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        
    }
}
