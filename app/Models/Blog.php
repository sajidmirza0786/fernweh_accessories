<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'url_key';
    }

    protected $casts = [
        'published_at' => 'immutable_datetime'
    ];
}
