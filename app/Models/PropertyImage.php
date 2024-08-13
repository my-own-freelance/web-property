<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    use HasFactory;
    protected $fillable = [];
    protected $guarded = [];

    public function Property()
    {
        return $this->belongsTo(Property::class);
    }
}
