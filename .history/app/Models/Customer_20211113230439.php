<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    /**
     * @var array
     */
    protected $fillable = [
        'first_name',
        'family_name',
        'last_name',
        'birth_date',
        'disabily_degree',
        'genre',
        'phone',
        'mobile_phone',
        'additional_contacts',
        'user_id',
        'status'
    ];

    protected $dates = [
        'birth_date'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}