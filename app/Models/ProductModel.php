<?php

namespace App\Models;
use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'tbl_product';
    protected $primaryKey = 'product_id';
    protected $allowedFields = [
        'navbar_title_id',
        'navbar_page_id',
        'product_name',
        'brand',
        'price',
        'offer_price',
        'discount_percentage',
        'sizes',
        'arrival_status',
        'stock_status',
        'product_img',
        'img_1',
        'img_2',
        'img_3',
        'key_feature',
        'details',
        'ingredient_details',
        'keywords',
        'flag',
        'created_at',
        'updated_at'
    ];


}