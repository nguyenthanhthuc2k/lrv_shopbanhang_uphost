<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    public $timestamps = false; // set time to false
    protected $fillable =['name_qh','type_qh','matp'];
    protected $primaryKey = 'maqh';
    protected $table = 'tbl_quanhuyen';
}
