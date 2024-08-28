<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [];
    protected $guarded = [];

    public function PropertyImages()
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function Agen()
    {
        return $this->belongsTo(User::class);
    }

    public function PropertyTransaction()
    {
        return $this->belongsTo(PropertyTransaction::class);
    }

    public function PropertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function PropertyCertificate()
    {
        return $this->belongsTo(PropertyCertificate::class);
    }

    public function Province()
    {
        return $this->belongsTo(Province::class);
    }

    public function District()
    {
        return $this->belongsTo(District::class);
    }

    public function SubDistrict()
    {
        return $this->belongsTo(SubDistrict::class);
    }
}
