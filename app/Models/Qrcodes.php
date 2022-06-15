<?php

namespace App\Models;

use App\Models\User;
use App\Models\Dokumen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Qrcodes extends Model
{
    use HasFactory;

    protected $guarded= ['id'];

    public function dokumen()
    {
        return $this->belongsTo(Dokumen::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // public function getRouteKeyName()
    // {
    //     return 'hash';
    // }
}
