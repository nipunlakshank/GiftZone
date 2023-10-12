<?php

/**
 * Cart controller
 */

class Cart extends Controller
{

    public function index(): void
    {
        $data = $this->loadData();
        $this->view("cart", $data);
    }


    public function add(): void
    {
        $req = json_decode(file_get_contents("php://input"));
        if (!isset($req->productId)) exit;
        $total = str_replace('.00', '', number_format(CartData::getTotal(), 2));
        $count = count(CartData::getItems() ?? []);
        $id = intval($req->productId);
        if (CartData::hasProduct($id)) {
            $cartItem = new CartItem();
            $item = $cartItem->selectOne(["products_id" => $id]);
            if (!empty($item)) {
                $this->edit(["id" => $item->id, "qty" => intval($item->qty) + 1]);
                exit(json_encode(["success" => true, "total" => $total, "count" => $count]));
            }
            exit(json_encode(["success" => false, "total" => $total, "count" => $count]));
        }
        $insertId = CartData::addItem($id);
        $success = $insertId > 0;
        exit(json_encode(["success" => $success, "total" => $total, "count" => $count]));
    }

    public function edit($item = []): void
    {
        if (empty($item)) {
            $req = json_decode(file_get_contents("php://input"));
            $item['id'] = $req->itemId;
            $item['qty'] = $req->qty;
        }
        $newItem = CartData::updateItem($item);
        $total = str_replace('.00', '', number_format(CartData::getTotal(), 2));
        $count = count(CartData::getItems() ?? []);
        $result = ["item" => $newItem, "total" => $total, "count" => $count];
        exit(json_encode($result));
    }

    public function remove(): void
    {
        $req = json_decode(file_get_contents("php://input"));
        if (isset($req->productId)) {
            $result = [];
            $id = intval($req->productId);
            CartData::removeItem(["products_id" => $id]);
            $total = str_replace('.00', '', number_format(CartData::getTotal(), 2));
            $count = count(CartData::getItems() ?? []);
            exit(json_encode(["total" => $total, "count" => $count]));
        }
        if (!isset($req->itemId)) exit;
        $id = intval($req->itemId);
        CartData::removeItem(["id" => $id]);
        $total = str_replace('.00', '', number_format(CartData::getTotal(), 2));
        $count = count(CartData::getItems() ?? []);
        $result = ["id" => $id, "total" => $total, "count" => $count];
        exit(json_encode($result));
    }

    private function loadData()
    {
        $data = [];

        $category = new Category();
        $categories = $category->selectAll();
        foreach ($categories as $cat) {
            $data['categories'][$cat->id] = $cat->name;
        }

        $product = new Product();
        $data['products'] = $product->selectAll();
        return $data;
    }
}
