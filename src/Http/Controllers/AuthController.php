<?php



namespace OpenJournalTeam\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use OpenJournalTeam\Core\Models\Role;
use OpenJournalTeam\Core\Models\User;

class AuthController extends BaseController
{

    public function __construct()
    {
        $this->middleware('throttle:5,1')->only('login');
    }

    public function index()
    {
        return render('core::pages.auth.login');
    }

    public function register(Request $request)
    {
        if ($request->ajax()) {
            // Ajax Request here
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => ['required', Rules\Password::defaults()],
            ]);

            $userModel = config('auth.providers.users.model', User::class);

            $user = $userModel::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->assignRole(Role::SUPER_ADMIN);

            Auth::login($user);

            $data = ['msg' => 'Register Success..', 'redirect' => route('core.home')];

            return response_success($data);
        }

        return view('core::pages.auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->input('remember_me', false))) {
            $request->session()->regenerate();

            $data = ['msg' => 'Login Success..', 'redirect' => route('core.home')];

            return response_success($data);
        }

        return response_error('Email or Password incorrect');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($request->ajax()) {
            $data = ['msg' => 'Logout Success..', 'redirect' => route('core.home')];

            return response_success($data);
        }

        return redirect(route('core.index'));
    }
}
