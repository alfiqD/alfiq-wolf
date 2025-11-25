<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataUser'] = user::all();
        return view('admin.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'name'     => 'required',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data['name']     = $request->name;
    $data['email']    = $request->email;
    $data['password'] = Hash::make($request->password);

    // Upload Foto
    if ($request->hasFile('profile_picture')) {
        $data['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
    }

    User::create($data);

    return redirect()->route('user.index')->with('success', 'Penambahan Data Berhasil!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataUser'] = user::findOrFail($id);
        return view('admin.user.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
{
    $data = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'profile_picture' => 'nullable|image|max:2048'
    ]);

    if ($request->hasFile('profile_picture')) {
        // hapus file lama kalau ada
        if($user->profile_picture && Storage::exists('public/profile/'.$user->profile_picture)){
            Storage::delete('public/profile/'.$user->profile_picture);
        }

        $file = $request->file('profile_picture');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->storeAs('public/profile', $filename);
        $data['profile_picture'] = $filename;
    }

    $user->update($data);

    return redirect()->back()->with('success','Profil diperbarui.');
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        {$user = user::findOrFail($id);

        $user->delete();
        return redirect()->route('user.index')->with('succes', 'Perubahan Data Dihapus');}
    }
}
