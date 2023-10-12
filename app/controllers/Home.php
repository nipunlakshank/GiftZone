<?php

class Home extends Controller
{

    public function index()
    {
        $data = $this->loadData();
        $this->view("home", $data);
    }

    private function loadData(): array
    {
        $data = [];

        $category = new Category();
        $categories = $category->selectAll();

        foreach($categories as $cat){
            $data['categories'][$cat->id] = $cat->name;
        }

        $product = new Product();
        $data['products'] = $product->selectAll();

        return $data;
    }

}
