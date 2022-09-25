<?php

namespace App\Controllers;

use App\Models\Category;
use App\Requests\Admin\Category\CategoryRequestCreate;
use Core\Request;
use Core\Session;

class CategoryController
{
    private $categories, $request;
    // construct
    public function __construct()
    {
        $this->categories = Category::all();
        $this->request = new Request();
    }

    // index
    public function index()
    {
        $categories = $this->categories;
        return view("admin/category/index", compact("categories"));
    }

    // create
    public function create()
    {
        $categories = $this->categories;
        return view("admin/category/create", compact("categories"));
    }

    // store
    public function store()
    {
        $this->request->validation(CategoryRequestCreate::class);
        $data = $this->request->getFields();
        $data['slug_category'] = create_slug($data['category_name']);
        Category::insert($data);
        Session::data("success", "Thêm danh mục thành công");
        return redirect("admin/category");
    }

    // show
    public function show($id = "")
    {
    }

    // edit
    public function edit($id = "")
    {
        $categories = $this->categories;
        $category = Category::find($id);
        return view("admin/category/edit", compact("category", "categories"));
    }

    // update
    public function update($id = "")
    {
        $this->request->rules([
            "category_name" => "required|max:50|unique:categories:id=" . $id
        ]);
        $this->request->messages([
            "category_name.required" => "Vui lòng không để trống tên danh mục",
            "category_name.max" => "Tên danh mục vui lòng không quá 50 ký tự",
            "category_name.unique" => "Tên danh mục đã tồn tại",
        ]);
        $this->request->validation();
        Category::where('id', "=", $id)->update($this->request->getFields());
        Session::data("success","Category Updated Successfully.");
        return redirect("admin/category");
    }

    // destroy
    public function delete($id = "")
    {
        $this->category::where("id", "=", $id)->delete();
        return response(["messages" => "Xoá danh mục thành công."]);
    }
}
