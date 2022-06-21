<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hangMuc extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
        'tieuDe ',
        'moTa',
    ];
    protected $primaryKey = 'maHangMuc';
    protected $table = 'hangMuc';
}
