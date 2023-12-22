<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformationCompany extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image', 'image_mime', 'image_size', 'email', 'operating_days', 'operating_hours', 'phone', 'address', 'city', 'state', 'zipcode', 'country', 'created_by', 'updated_by'];
}
