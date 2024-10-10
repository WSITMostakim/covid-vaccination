<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'nid', 'center_id', 'scheduled_date'];

    protected $appends  = ['status'];

    public function getStatusAttribute()
    {
        $scheduledDate = Carbon::parse($this->scheduled_date);

        if ($scheduledDate->isToday()) {
            return 'Scheduled';
        } elseif ($scheduledDate->isFuture()) {
            return 'Not scheduled';
        } else {
            return 'Vaccinated';
        }
    }

    public function center()
    {
        return $this->belongsTo(Center::class);
    }
}
