<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Requests\Admin\Product\ProductRequest;
use Core\Request;
use Core\Response;
use Core\Session;

class ProductController
{
    private $request, $categories;
    // construct
    public function __construct()
    {
        $this->request = new Request();
        $this->categories = Category::all();
    }

    // index
    public function index()
    {
        $products  = Product::table("products as p")
            ->select("p.id, p.product_name, p.price, p.images, p.descript, c.category_name, c.parent_id, p.image, p.images")
            ->join("categories as c", "p.category_id = c.id")->get();
        return view("admin/product/index", compact("products"));
    }

    // create
    public function create()
    {
        $categories = $this->categories;
        return view("admin/product/create", compact("categories"));
    }

    // store
    public function store()
    {
        $this->request->validation(ProductRequest::class);
        $data = $this->request->getFields();
        $images = $_FILES['images']['tmp_name'];
        $image = $_FILES['image'];
        $path = _DIR_ROOT . "public/images/products/";
        put_images($path, $images, $imagesList);
        put_image($path, $image, $linkimage);
        $data['images'] = $imagesList;
        $data['image'] = $linkimage;
        Product::insert($data);
        Session::flash("success", "Thêm sản phẩm thành công");
        return Response::redirect("admin/product");
    }

    // show
    public function show($id = "")
    {
    }

    // edit
    public function edit($id = "")
    {
        $product = Product::find($id);
        $categories = $this->categories;
        return view("admin/product/edit", compact("product", "categories"));
    }

    // update
    public function update($id = "")
    {
        $this->request->validation(ProductRequest::class);
        $data = $this->request->getFields();
        $path = _DIR_ROOT . "public/images/products/";
        if ($_FILES['image']['name'] != "") {
            $image = $_FILES['image'];
            put_image($path, $image, $linkimage);
            $data['image'] = $linkimage;
        }
        if ($_FILES['images']['name'] != "") {
            $images = $_FILES['images']['tmp_name'];
            put_images($path, $images, $imagesList);
            $data['images'] = $imagesList;
        }
        $data = array_filter($data);
        Product::where("id", "=", $id)->update($data);
        Session::flash("success", "Chỉnh sửa sản phẩm thành công");
        return Response::redirect("admin/product");
    }

    // delete
    public function delete($id = "")
    {
        Product::where("id", "=", $id)->delete();
        Session::flash("success", "Xoá sản phẩm thành công");
        return Response::redirect("admin/product");
    }
}
