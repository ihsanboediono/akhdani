<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('get_the_locale')) {
    function get_the_locale()
    {
        if (session('language')) {
            return session('language');
        }else {
            return app()->getLocale();
        }
    }
}

if (!function_exists('get_route_locale')) {
    function get_route_locale()
    {
        return Route::current()->parameters()['locale'];
    }
}

?>