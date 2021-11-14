<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses';

    protected $fillable = [
        'label',
        'type',
        'road',
        'block',
        'number',
        'bis',
        'stairs',
        'floor',
        'door',
        'postal_code',
        'locality',
        'province',
        'customer_id',
        'country'
    ];

    protected $attributes = [
        'label' => '',
        'type' => '',
        'road' => '',
        'block' => '',
        'number' => '',
        'bis' => '',
        'stairs' => '',
        'floor' => '',
        'door' => '',
        'postal_code' => '',
        'locality' => '',
        'province' => '',
        'country' => ''
    ];

    protected $appends = [
        'short_address',
        'short_location'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function getShortAddressAttribute():string
    {
        $components = collect([
            $this->type,
            $this->road,
            $this->number
        ])
            ->filter(function ($item)
            {
                return !!$item;
            })
            ->toArray();

        return implode(', ', $components);
    }

    public function getShortLocationAttribute():string
    {
        $components = collect([
            $this->postal_code,
            $this->locality,
            $this->province,
            $this->country
        ])
            ->filter(function ($item)
            {
                return !!$item;
            })
            ->toArray();

        return implode(', ', $components);
    }

    public function getFullAddressAttribute():string
    {
        return $this->short_address . ' ' . $this->short_location;
    }

}
