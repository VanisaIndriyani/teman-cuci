<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Admin::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
        }

        $admins = $query->paginate(10);
        return view('admin.admins.index', compact('admins'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
        ]);

        $data['password'] = Hash::make($data['password']);
        Admin::create($data);
        return back()->with('success', 'Admin berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,' . $id,
            'password' => 'nullable|min:6',
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $admin->update($data);
        return back()->with('success', 'Admin berhasil diperbarui');
    }

    public function destroy($id)
    {
        if (Admin::count() <= 1) {
            return back()->with('error', 'Tidak dapat menghapus admin terakhir');
        }
        Admin::findOrFail($id)->delete();
        return back()->with('success', 'Admin berhasil dihapus');
    }
}
