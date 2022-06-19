<?php

use App\Models\Setting;

if (!function_exists('setting')) {

    /**
     * description
     *
     * @param string $slug
     * @return mixed
     */
    function setting(string $slug)
    {
        return Setting::whereSlug($slug)->value('value');
    }
}
