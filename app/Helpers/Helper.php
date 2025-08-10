<?php

use App\Models\HomePage;

if (!function_exists('home')) {
    /**
     * Get the first record of a model.
     *
     * @param  string  $modelClass  Fully qualified model class name
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    function home()
    {
    	return HomePage::first();
    }
}
