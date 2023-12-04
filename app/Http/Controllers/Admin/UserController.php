<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\User\CreateUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;

class UserController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $results = User::where('name', 'like', "%$query%")
            ->orWhere('email', 'like', "%$query%")
            ->orWhere('address', 'like', "%$query%")
            ->get();

        return view('admin.user.index', ['users' => $results]);
    }

    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(CreateUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'email_verified_at' => now(),
        ]);
    
        $user->save();
    
        return redirect()->route('role.admin.user')->with('success', 'User berhasil di buat');
    }

    public function edit($id)
    {
        $responseProvince = Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY'),
        ])->get('https://api.rajaongkir.com/starter/province');
        // dd($responseProvince->json());

        $responseCity = Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY'),
        ])->get('https://api.rajaongkir.com/starter/city');
        // dd($response->json());

        $province = $responseProvince['rajaongkir']['results'];
        $cities = $responseCity['rajaongkir']['results'];
        $user = User::findOrFail($id);

        return view('admin.user.edit', compact('user', 'province', 'cities'));
    }


    public function update(UpdateUserRequest $request, $id)
    {
        // Ambil data user berdasarkan ID
        $user = User::findOrFail($id);

        // Hapus gambar avatar sebelumnya jika ada
        if ($request->hasFile('avatar') && $user->avatar) {
            Storage::disk('public')->delete('avatars/' . $user->avatar);
        }

        // Update data user
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->first_name = $request->input('first_name', '-');
        $user->last_name = $request->input('last_name', '-');
        $user->province_id = $request->input('province_id', '-');
        $user->province = $request->input('province', '-');
        $user->city_id = $request->input('city_id', '-');
        $user->city = $request->input('city', '-');
        $user->postal_code = $request->input('postal_code', '-');
        $user->address = $request->input('address', '-');
        $user->phone = $request->input('phone', '-');
        $user->role = $request->input('role');

        // Update avatar jika ada file yang diunggah
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->storeAs('avatars', $avatarName, 'public');
            $user->avatar = $avatarName;
        }

        // Update password jika ada perubahan
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        // Simpan perubahan
        $user->save();

        // Respon sukses atau pindahkan ke halaman tertentu
        return redirect()->route('role.admin.user')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->avatar) {
            Storage::disk('public')->delete('avatars/' . $user->avatar);
        }

        $user->delete();

        return redirect()->route('role.admin.user')->with('success', 'User deleted successfully');
    }

    public function exportUsers()
    {
        $users = User::all();
        return Excel::download(new UsersExport($users), 'users.xlsx');
    }

    public function DownloadUserPDF()
    {
        $users = User::all();

        $mpdf = new \Mpdf\Mpdf();

        $html = view('admin.user.pdf', compact('users'))->render();
        $mpdf->WriteHTML($html);
        $mpdf->Output('users.pdf','D');
    }
}
