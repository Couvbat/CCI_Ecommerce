<?php


namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

	public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $this->authorize('view', auth()->user());

        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function edit()
    {
        return view('user.profile.edit-profile');
    }

    // Update Username and EMail
    public function update(User $user, UserRequest $request)
    {
        if (!$user->realUser($user->id)) {
            return back();
        }

        $user->update($request->only(['name', 'email']));

        alert('Updated', 'Les changements ont bien été enregistrés', 'success');
        return back();

    }

    public function changePassword()
    {
        return view('user.profile.change-password');
    }

    public function change(User $user, Request $request)
    {
        if (!$user->realUser($user->id)) {
            return back();
        }

        // Simple validation
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required'
        ]);

        // Check old password
        if (Hash::check($request->old_password, $user->password)) {
            // Update password
            $user->update([
                'password' => Hash::make($request->password)
            ]);

        } else {
            alert('Error', 'Ancien mot de passe incorrect', 'error');
            return back();
        }

        alert('Updated!', 'Le mot de passe a été mis à jour', 'success');

        return redirect('/profiles');
    }

    public function destroy(Request $request, User $user)
    {
        if ($request->ajax() && $user->id == auth()->user()->id) {
            Auth::logout();
            $user->delete();
            return response()->noContent();
        }

        $user->delete();
        return back()->with('status', 'L\'utilisateur a été supprimé');
    }
}
