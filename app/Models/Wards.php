<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    use HasFactory;
    public $timestamps = false; // set time to false
    protected $fillable =['name_xa','type_xa','maqh'];
    protected $primaryKey = 'xaid';
    protected $table = 'tbl_xaphuongthitran';
}
