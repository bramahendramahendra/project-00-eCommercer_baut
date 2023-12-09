<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialMedia extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['application', 'image', 'name', 'link', 'created_by', 'updated_by'];

}
