<?php

/**
 * Category Model
 */

class Category extends Model
{
    protected string $table = "categories";
    protected array $insert_columns = [
        'name',
    ];
    protected array $select_columns = [
        'id',
        'name',
    ];

}
