<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    //
    public function marketplaces ()
    {
        return $this->hasMany(Marketplace::class);
    }

    public function reportRequests ()
    {
        return $this->hasMany(ReportRequest::class);
    }
}
