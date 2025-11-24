<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterableColumns = ['email_verified_at'];

        // Kolom yang boleh dicari
        $searchableColumns = ['name', 'email'];

        // Ambil data dengan filter + search
        $pageData['dataUser'] = User::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.user.index', $pageData);
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
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data['password'] = Hash::make($data['password']);

        // Upload foto jika ada
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads/profile/', $filename, 'public');
            $data['profile_picture'] = $filename;
        } else {
            $data['profile_picture'] = null;
        }

        User::create($data);

        return redirect()->route('user.index')
            ->with('success', 'User berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Jika ingin menambahkan detail user
        $user = User::findOrFail($id);
        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        // Validasi dengan password opsional
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update data user
        $user->name = $data['name'];
        $user->email = $data['email'];

        // Update password hanya jika diisi
        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        // Upload foto baru jika ada
        if ($request->hasFile('profile_picture')) {
            // Hapus foto lama jika ada
            if ($user->profile_picture && Storage::disk('public')->exists('uploads/profile/'.$user->profile_picture)) {
                Storage::disk('public')->delete('uploads/profile/'.$user->profile_picture);
            }

            $file = $request->file('profile_picture');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads/profile/', $filename, 'public');
            $user->profile_picture = $filename;
        }

        $user->save();

        return redirect()->route('user.index')
            ->with('success', 'User berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Hapus foto profil jika ada
        if ($user->profile_picture && Storage::disk('public')->exists('uploads/profile/'.$user->profile_picture)) {
            Storage::disk('public')->delete('uploads/profile/'.$user->profile_picture);
        }

        $user->delete();

        return redirect()->route('user.index')
            ->with('success', 'User berhasil dihapus.');
    }
}
