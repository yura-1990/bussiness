<?php

namespace App\Http\Controllers\Web;

use App\DTOs\AuthDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Route;
use Vyuldashev\LaravelOpenApi\Attributes\PathItem;

#[Prefix('auth')]
#[PathItem]
class AuthController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    #[Get('login', name: 'auth.login')]
    public function login(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('auth.login');
    }

    /**
     * @throws UnknownProperties
     */
    #[Post('/authenticate')]
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->redirectTo('/admin');
        }

        return response()->redirectTo('/auth/login');
    }


    #[Get('/register')]
    public function register(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('auth.register');
    }


    /**
     * @throws UnknownProperties
     */
    #[Post('/sign-up')]
    public function signUp(AuthRequest $request): RedirectResponse
    {
        $credentials = new AuthDTO($request->validated());

        $user = User::query()->create($this->filterDate($credentials));

        auth()->login($user);

        return response()->redirectTo('/admin');
    }


}
