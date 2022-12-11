@extends("layouts/client_layout")
@section("title","Quản lý Danh mục")

@section("content")
@include("components/popper")

<div class="container">
    <div class="mt-3 p-2 w-1/2 m-auto">
        <div class="flex justify-center">
            <h2 class="font-semibold text-2xl border-b-2 text-center">Danh mục Menu</h2>
            <a href="{{ route('admin.menu.create') }}" class="border ml-2 border-green-600 bg-green-600 text-white p-1 px-2 rounded">+</a>
        </div>
        <div class="p-2">
            <?php
            menu( $menus, $html);
            echo $html;
            function menu( $menus, &$html = "", $id = null, $char = "" ) {
                foreach ( $menus as $key => $menu ) {
                    if ( $menu['parent_id'] ==  $id ) {
                        $html .= '<div class="flex justify-between border-b">
                                <h3 class="text-1xl font-semibold px-0">' . $char . $menu['menu_name'] . '</h3>
                                <div><a href="' . route('admin/menu/edit', $menu['id'] ) . '" class="float-end px-2 text-blue-600 hover:text-blue-500">Sửa</a>
                                <a href="' . route('admin/menu/delete', $menu['id'] ) . '" class="float-end text-red-600 hover:text-red-400">Xoá</a></div>
                            </div>';
                        unset($menus[$key]);
                        menu( $menus, $html, $menu['id'], $char . "--");
                    }
                }
            }
            ?>
        </div>
    </div>
</div>

@endsection

@section("script")
<script>
        var href = window.location.href;
        if (href.indexOf("admin/menu")) {
            $("#menu").addClass("border-blue-600 text-blue-600 ");
            $("#svgMenu").addClass("text-blue-600");
        }

</script>
@endsection