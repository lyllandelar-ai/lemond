<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $fillable = [
        'tracking_number',
        'customer_name',
        'origin',
        'destination',
        'carrier',
        'estimated_delivery',
        'status',
        'notes',
        'user_id'
    ];

    protected $casts = [
        'estimated_delivery' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($shipment) {
            if (empty($shipment->tracking_number)) {
                $shipment->tracking_number = 'TRK-' . strtoupper(substr(uniqid(), -8));
            }
        });
    }
}
