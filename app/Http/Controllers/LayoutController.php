<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class LayoutController extends Controller
{
    /**
     * Liest anhand der aktuellen oder einer gegebenen Route den übersetzten Seitentitel aus
     *
     * @return string
     */
    public static function getSiteTitle(): string
    {

        $routeName = Route::getCurrentRoute()->getName();
        if (str_contains($routeName, 'edit') && count(Route::getCurrentRoute()->parameters) == 0) {
            $routeName = str_replace('edit', 'create', $routeName);
        }
        if (__('routes.' . $routeName) != 'routes.' . $routeName) {
            $title = __('routes.' . $routeName);
        } else {
            $title = config("app.name");
        }
        return $title;
    }

    /**
     * @return string Gibt den Favicon-Link zur gewählten Sektion zurück oder als Default das Standard-Icon
     */
    public static function getFavicon(): string
    {
        // Default-Icon festlegen
        $icon = "favicon.ico";

        $icon = asset('images/logo/' . $icon);
        return $icon;
    }
}
