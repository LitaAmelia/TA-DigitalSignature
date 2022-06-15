<?php

namespace App\Models;

use App\Models\User;
use App\Models\Qrcodes;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;

class Dokumen extends Model
{
    use Sluggable;
    
    use HasFactory;

    protected $guarded= ['id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function qrcode()
    {
        return $this->belongsTo(Qrcode::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'judul'
            ]
        ];
    }
}
