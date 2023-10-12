<?php

/**
 * CartItem Model
 */

class CartItem extends Model
{
    protected string $table = "cart_items";
    protected array $insert_columns = [
        'cart_id',
        'products_id',
        'qty',
    ];
    protected array $update_columns = [
        'qty'
    ];
    protected array $select_columns = [
        'id',
        'cart_id',
        'products_id',
        'qty',
    ];
    private static CartItem $instance;

    public static function getData($cart_id): array
    {
        self::$instance = new CartItem();

        $items = self::$instance->select(["cart_id" => $cart_id]);
        if (empty($items)) return [];
        $product = new Product();
        $result = [];
        $result['items'] = [];
        $total = 0;
        foreach ($items as $item) {
            $prod = (array) $product->selectOne(["id" => $item->products_id]) ?? [];
            $item->name = $prod['name'];
            $item->img = $prod['img'];
            $item->cat_id = intval($prod['categories_id']);
            $item->price = doubleval($prod['price']);
            $item->total = $item->price * intval($item->qty);
            $total += $item->total;
            array_push($result['items'], $item);
        }
        $result['total'] = $total;
        return $result;
    }

    public function edit(array $item): array
    {
        $this->update($item['id'], ["qty" => $item['qty']]);
        $newItem = $this->selectOne(["id" => $item["id"]]) ?? [];
        $product = new Product();
        $prod = (array) $product->selectOne(["id" => $newItem->products_id]) ?? [];
        $newItem->price = str_replace('.00', '', number_format(doubleval($prod['price']), 2));
        $newItem->total = str_replace('.00', '', number_format(doubleval($prod['price']) * intval($newItem->qty), 2));

        return (array) $newItem;
    }

    public static function getId($productId) : int {
        $instance = new CartItem();
        $item = $instance->selectOne(["products_id" => intval($productId)]);
        if(!empty($item)){
            return $item->id;
        }
        return 0;
    }
}
