<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KetuaProdi extends Model
{
    use HasFactory;
    protected $table = 'ketua_program_studi';
    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nip',
        'prodi',
    ];
}
