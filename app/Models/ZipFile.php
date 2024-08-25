<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZipFile extends Model
{
    use HasFactory;

    protected $table = 'zip_files';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_user',
        'nama_file',
        'created_at',
        'updated_at'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
