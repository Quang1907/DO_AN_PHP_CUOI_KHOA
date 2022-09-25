<?php

namespace App\Controllers;

use App\Models\Menu;
use App\Requests\Admin\Menu\CreateMenuRequest;
use App\Requests\Admin\Menu\UpdateMenuRequest;
use Core\Request;
use Core\Session;

class MenuController{
    private $menus = null, $request = null;
    // construct
    public function __construct() {
        $this->menus = Menu::all();
        $this->request = new Request();
    }

    // index
    public function index() {
        $menus = $this->menus;
        return view("admin/menu/index", compact("menus"));
    }

    // create
    public function create() {
        $menus = $this->menus;
        return view("admin/menu/create", compact("menus"));
    }

    // store
    public function store() {
        $this->request->validation(CreateMenuRequest::class);
        $data = $this->request->getFields();
        $data['slug_menu'] = create_slug($data['menu_name']);
        Menu::insert($data);
        Session::data("success", "Thêm menu thành công");
        return redirect("admin/menu");
    }

    // show
    public function show($id = "") {
        
    }
    
    // edit
    public function edit($id = "") {
        $menus = $this->menus;
        $menu = Menu::find($id);
        return view("admin/menu/edit", compact("menus", "menu"));
    }
    
    // update
    public function update( $id = "" ) {
        $this->request->validation(UpdateMenuRequest::class);
        $data = $this->request->getFields();
        $data['slug_menu'] = create_slug($data['menu_name']);
        Menu::where( "id", "=", $id )->update($data);
        return redirect("admin/menu");
    }
    
    // destroy
    public function delete($id = "") {
        Menu::where("id", "=", $id)->delete();
        return redirect("admin/menu");
    }
}
