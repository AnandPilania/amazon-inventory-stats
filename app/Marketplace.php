<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marketplace extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user ()
    {
        return $this->belongsToMany(User::class)->withPivot('mws_auth_token');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region ()
    {
        return $this->belongsTo(Region::class);
    }
}
