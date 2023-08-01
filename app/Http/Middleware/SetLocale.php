<?php

namespace App\Http\Middleware;

use Closure;

class SetLocale
{
    /**
     * List of valid locales
     *
     * @var array
     */
    public static $knownLocales = [
        'en',
        'de',
        'fr',
        'es',
        'jp',
        'cn',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $has_locale_subdomain = [];
        preg_match_all(
            '/^(us|en|de|fr|jp|cn)(\..*)/',
            $request->server('HTTP_HOST'),
            $has_locale_subdomain
        );

        // - has parameter "lang"
        if ($request->has('lang')) {
            // change detected
            $language = $request->only('lang')['lang'];
            if (!in_array($language, SetLocale::$knownLocales)) $language = config('app.locale');

            // persist
            session()->put('locale', $language);
        }
        elseif (!empty($has_locale_subdomain[1])) {
            // change detected
            $language = $has_locale_subdomain[1][0];
            if ($language === 'us') $language = 'en';
            if (!in_array($language, SetLocale::$knownLocales)) $language = config('app.locale');

            // persist
            session()->put('locale', $language);
        }
        // - or read from session or config fallback
        else $language = session()->get('locale', config('app.locale'));

        // set correct locale
        app()->setLocale($language);
        return $next($request);
    }
}
