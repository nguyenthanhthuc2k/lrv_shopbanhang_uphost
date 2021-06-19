<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false; // set time to false
    protected $fillable =['category_id','brand_id','product_desc','product_meta_keywords','product_name','product_content','product_price','product_image','product_size','product_color','product_status'];
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';
}
