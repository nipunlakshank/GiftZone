<?php

/**
 * Product Model
 */

class Product extends Model
{
    protected string $table = "products";
    protected array $insert_columns = [
        'name',
        'img',
        'price',
        'categories_id'
    ];
    protected array $select_columns = [
        'id',
        'name',
        'img',
        'price',
        'categories_id',
    ];

}
