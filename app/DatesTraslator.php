<?php

namespace App;

use Jenssegers\Date\Date;

trait DatesTraslator{
     
    public function getCreatedAtAttribute($date)
    {
        return new Date($date);
    }
    public function getUpdatedAtAttribute($date)
    {
        return new Date($date);
    }

}