<?php

namespace App\Models;

use App\Models\Dokumen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;

    protected $guarded =['id'];

    public function dokumens()
    {
        return $this->hasMany(Dokumen::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
