<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(Request $request)
    {

        // $users = \app\Models\User::paginate(10);
        $users = DB::table('users')
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->orderBy('id', 'asc')
            ->paginate(10);
        return view('pages.users.index', compact('users'));
    }


    // function hapus data
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        // Update ID
        User::where('id', '>', $id)->decrement('id');

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
    // function edit data user
    public function edit(Request $request, $id)
    {
        $user = User::findOrFail($id);
        return response()->json(['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'poin' => 'required|numeric',
            'rupiah' => 'required|numeric',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'poin' => $request->poin,
            'rupiah' => $request->rupiah,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully');

    }

    public function tukarPoin(Request $request, $id)
    {
        $request->validate([
            'rupiah' => 'required|numeric',
        ]);

        try {
            $user = User::findOrFail($id);

            $user->update([
                'poin' => 0,
                'rupiah' => $request->rupiah,
            ]);

            // Return a JSON response indicating success
            return response()->json([
                'message' => 'User updated successfully. Poin has been reset to 0.',
                'user' => $user,
            ], 200);
        } catch (\Exception $e) {
            // Handle any errors that may occur
            return response()->json([
                'message' => 'Failed to update user',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


}
