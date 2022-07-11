<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function scopeFinished($query)
    {
        return $query->whereDate('end_date', '<', Carbon::now());
    }

    public function scopeUpcomming($query)
    {
        return $query->whereDate('start_date', '>', Carbon::now());
    }

    public function scopeUpcommingInDays($query, $days)
    {
        $fromDate = Carbon::now();
        $toDate = Carbon::now()->addDays($days)->endOfDay();
        return $query->whereBetween('start_date', [$fromDate, $toDate]);
    }

    public function scopeFinishedInDays($query, $days)
    {
        $fromDate =  Carbon::now()->subDays($days)->startOfDay();
        $toDate = Carbon::now();
        return $query->whereBetween('end_date', [$fromDate, $toDate]);
    }
}
