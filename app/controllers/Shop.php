<?php

/**
 * Shop Controller
 */

class Shop extends Controller
{

    private static string $search_keyword = "";

    public function index(): void
    {
        $data = $this->loadData();
        $data['cat_id'] = 0;
        $data['filtered_items'] = $data['products'];
        $data = $this->pagination($data);
        $this->view("shop", $data);
    }

    public function search(string ...$params): void
    {
        $data = $this->loadData();

        if ($_SERVER['REQUEST_METHOD'] !== "POST") {
            $data['cat_id'] = empty($params[0]) ? 0 : intval($params[0]);
            $data['keyword'] = empty($params[1]) ? "" : $params[1];
        } else {
            $data['cat_id'] = empty($_POST['cat_id']) ? 0 : intval($_POST['cat_id']);
            $data['keyword'] = empty($_POST['keyword']) ? "" : $_POST['keyword'];
        }

        $product = new Product();
        $filtered_by_cat = $data['cat_id'] < 1 ? $product->selectAll() : $product->select(["categories_id" => $data['cat_id']]);
        self::$search_keyword = $data['keyword'];
        show(self::$search_keyword);
        $filtered_by_keyword = array_filter($filtered_by_cat, "filter");

        $data['filtered_items'] = $filtered_by_keyword;
        $data = $this->pagination($data);

        $this->view('shop', $data);
    }

    public static function get_keyword(){
        return self::$search_keyword;
    }

    public function category(string ...$params): void
    {
        if (empty($params)) {
            $this->index();
            return;
        }
        $data = $this->loadData();
        $cat_id = intval($params[0]);

        $cat_id = $cat_id < 0 ? 0 : $cat_id;
        $data['cat_id'] = $cat_id;

        $product = new Product();
        if ($cat_id == 0) {
            $data['filtered_items'] = $data['products'];
        } else {
            $data['filtered_items'] = $product->select(['categories_id' => $cat_id]);
        }

        unset($params[0]);
        $data = $this->pagination($data, [...$params]);

        $this->view("shop", $data);
    }


    private function loadData(): array
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

    private function pagination($data, $params = []): array
    {
        $pagination = [];

        $pagination['last'] = ceil(count($data['filtered_items'] ?? []) / 12);

        if (empty($params)) {
            $pagination['active'] = 1;
            $pagination['start'] = 1;
            $pagination['end'] = $pagination['last'] > 4 ? 4 : $pagination['last'];
        } else {
            $active = intval($params[0]) < 1 ? 1 : intval($params[0]);
            $active = $active > $pagination['last'] ? $pagination['last'] : $active;
            $pagination['active'] = $active;
            $pagination['start'] = $active > 2 ? $active - 2 : 1;
            $pagination['end'] = $active < $pagination['last'] ? $active + 1 : $pagination['last'];
        }

        $pagination['show_prev'] = $pagination['active'] == 1 ? 0 : 1;
        $pagination['show_next'] = $pagination['last'] > $pagination['active'] ? 1 : 0;

        $data['pagination'] = $pagination;
        $data['total_items'] = count($data['filtered_items']);
        $items = array_chunk($data['filtered_items'], 12, true);
        if (!empty($items)) {
            $data['filtered_items'] = $items[$pagination['active'] - 1];
        }
        return $data;
    }
}
