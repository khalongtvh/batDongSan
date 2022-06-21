<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\hangMuc;

class tinTuc extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
        'maHangMuc',
        'tieuDe',
        'noiDung',
        'huongDan',
        'trangThai',
        'hinhAnh'
    ];
    protected $primaryKey = 'maTinTuc';
    protected $table = 'tintuc';

    public function hangMuc(){
        return $this->belongsTo('App\Models\hangMuc','maHangMuc','maHangMuc');
    }

}
