<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogHarian extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'tanggal', 'aktivitas', 'status', 'catatan_verifikasi', 'verified_by'];
    protected $table = 'log_harian';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function verifikator()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
