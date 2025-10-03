<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ReporterController extends Controller
{
    public function index()
    {
        $reporters = User::where('role', 'reporter')->paginate(10);
        return view('reporters.manage', compact('reporters'));
    }

    public function create()
    {
        return view('reporters.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'reporter', 
        ]);

        return redirect()->route('reporters.index')->with('success', 'Reporter berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $reporter = User::where('role', 'reporter')->findOrFail($id);
        return view('reporters.edit', compact('reporter'));
    }

    public function update(Request $request, $id)
    {
        $reporter = User::where('role', 'reporter')->findOrFail($id);

        $request->validate([
            'name'  => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $reporter->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password 
                            ? Hash::make($request->password) 
                            : $reporter->password,
        ]);

        return redirect()->route('reporters.index')->with('success', 'Reporter berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $reporter = User::where('role', 'reporter')->findOrFail($id);
        $reporter->delete();

        return redirect()->route('reporters.index')->with('success', 'Reporter berhasil dihapus!');
    }
}
