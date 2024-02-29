<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Sales extends Model
{
    protected $table = 'sales';

    public $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'amount',
        'status'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->sale_id = (string) Str::uuid();
        });
    }
}
