<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feeship extends Model
{
    use HasFactory;
    public $timestamps = false; // set time to false
    protected $fillable =['feeship_matp','feeship_maqh','feeship_xaid','feeship'];
    protected $primaryKey = 'feeship_id';
    protected $table = 'tbl_feeship';
    
    public function city(){
    	return $this->belongsTo('App\Models\City','feeship_matp');
    }
    public function province(){
    	return $this->belongsTo('App\Models\Province','feeship_maqh');
    }
     public function wards(){
    	return $this->belongsTo('App\Models\Wards','feeship_xaid');
    }

}
