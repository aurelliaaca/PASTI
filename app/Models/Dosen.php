<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';
    protected $primaryKey = 'nip';
    public $incrementing = false; // Because 'nip' is not auto-incrementing
    protected $keyType = 'string';

    protected $fillable = [
        'nama',
        'nip',
        'telp',
        'email',
        'alamat'
    ];

    public function dekan()
    {
        return $this->belongsTo(Dekan::class, 'nip', 'nip');
    }
    public function kaprodi()
    {
        return $this->belongsTo(KetuaProdi::class, 'nip', 'nip');
    }
}