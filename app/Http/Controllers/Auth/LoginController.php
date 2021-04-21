<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\session;
use Browser;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request, Session $session)
    {
        //dd($request);
        $input = $request->all();
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        //dd(auth()->user()->is_admin);
        //dd($input);

        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            //dd('toto');
            if (auth()->user()->is_admin == 1) {
            //dd(auth()->user());
                return redirect()->route('admin_dashboard');
            }else{
                //dd(Browser::isMac());
                //dd(Auth::user()->id);
                //dd($user_id);
                Session::create([
                    'user_id'=> Auth::user()->id,
                    'isDesktop'=> Browser::isDesktop(),
                    'isTablet'=> Browser::isTablet(),
                    'isMobile'=> Browser::isMobile(),
                    'browserName' => Browser::browserName(),
                    'platformName' => Browser::platformName(),
                    'isWindows' => Browser::isWindows(),
                    'isLinux' => Browser::isLinux(),
                    'isMac' => Browser::isMac(),
                    'isAndroid'=> Browser::isAndroid(),
                    'isChrome'=> Browser::isChrome(),
                    'isFirefox'=> Browser::isFirefox(),
                    'isOpera'=> Browser::isOpera(),
                    'isSafari'=> Browser::isSafari(),
                    'isIE'=> Browser::isIE(),
                    'isEdge'=> Browser::isEdge(),
                ]);

                return redirect()->route('home');
            }
        }else{
            //dd('toto2');
            return redirect()->route('login')
            ->with('error','le mail et/ou le mot de passe ne sont pas corrects.');
        }
    }
}
