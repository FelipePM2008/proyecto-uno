<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model
{
    /** @use HasFactory<ProviderFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nit',
        'name',
        'phone',
        'email',
        'address',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
