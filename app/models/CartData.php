<?php

/**
 * CartData Model
 */

class CartData extends Model
{
    protected string $table = "cart";
    protected array $insert_columns = [
        'users_id',
    ];
    protected array $select_columns = [
        'id',
        'users_id'
    ];
    private static CartData $instance;


    public static function load(): void
    {
        if (!Auth::logged_in()) return;

        self::$instance = new CartData();
        $cart = (array) self::$instance->selectOne(["users_id" => Auth::getId()]);
        if (empty($cart)) {
            self::create();
            $cart = (array) self::$instance->selectOne(["users_id" => Auth::getId()]);
        }
        $result = CartItem::getData($cart['id']);
        $items = $result['items'];
        $total = $result['total'];
        $cart['items'] = $items;
        $cart['total'] = $total;
        $_SESSION['CART_DATA'] = $cart;
    }


    private static function create(): void
    {
        self::$instance->insert(["users_id" => Auth::getId()]);
    }


    public static function updateCart(): void
    {
        $result = CartItem::getData($_SESSION['CART_DATA']['id']);
        $_SESSION['CART_DATA']['items'] = $result['items'] ?? [];
        $_SESSION['CART_DATA']['total'] = $result['total'] ?? 0;
    }


    public static function addItem($id): int
    {
        $cartItem = new CartItem();
        $data = ["products_id" => $id, "cart_id" => CartData::getId()];
        return $cartItem->insert($data);
    }


    public static function updateItem(array $item): array
    {
        $cartItem = new CartItem();
        $newItem = $cartItem->edit($item);
        self::updateCart();
        return $newItem;
    }


    public static function removeItem(array $data): void
    {
        $cartItem = new CartItem();
        $cartItem->delete($data);
        self::updateCart();
    }


    public static function hasProduct($productId): bool
    {
        if (!Auth::logged_in()) return false;

        if(empty($_SESSION['CART_DATA']['items'])) return false;

        $items = $_SESSION['CART_DATA']['items'];

        foreach($items as $item){
            if($item->products_id == intval($productId)) return true;
        }
        return false;
    }


    public static function __callStatic($name, $arguments)
    {
        if (!Auth::logged_in()) return;

        $key = str_replace("get_", "", $name);
        $key = str_replace("get", "", strtolower($key));

        self::updateCart();

        if (!empty($_SESSION['CART_DATA'][$key])) {
            return $_SESSION['CART_DATA'][$key];
        }
        return null;
    }
}
