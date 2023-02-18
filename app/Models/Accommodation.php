<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

class Accommodation extends Model
{
    use HasFactory, HasUuids, HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
