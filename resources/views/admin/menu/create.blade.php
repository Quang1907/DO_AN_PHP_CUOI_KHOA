@extends("layouts/client_layout")
@section("title","Thêm danh mục")
@section("content")

@include("components/popper")

<div class="container">
    <div class="mt-3 p-2 w-1/2 m-auto">
        <div class="flex justify-end">
            <div class="bg-blue-500 rounded">
                <a href="{{ route('admin/menu') }}" class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="w-5 h-5 m-2 text-white">
                        <path strokeLinecap="round" strokeLinejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                    </svg>
                    <span class="text-white pr-2 py-2">Back</span>
                </a>
            </div>
        </div>
        <div class="flex justify-center">
            <h2 class="font-semibold text-2xl border-b-2 text-center">Thêm danh mục Menu</h2>
        </div>
        <div class="p-2">
            <div class="overflow-x-auto mt-4">
                <form action="{{ route('admin/menu/store') }}" method="post">
                    @csrf
                    <div class="grid grid-cols-3 gap-4 items-center mb-2">
                        <label for="" class="col-span-1 text-center">Tên danh mục</label>
                        <input type="text" name="menu_name" class="border-2 border-gray rounded p-1 col-span-2" placeholder="Nhập tên danh mục">
                        <div class="col-span-3 text-center"> {{ error("menu_name") }}</div>
                        <label for="" class="col-span-1 text-center">Danh mục cha</label>
                        <select name="parent_id" id="" class="border-2 border-gray rounded p-1 col-span-2">
                            <option value="0" selected>Chọn danh mục cha</option>
                            {{ menuRaw( $menus ) }}
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button class="bg-green-700 p-2 text-white rounded">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section("script") <script>
    var href = window.location.href;
    if (href.indexOf("admin/menu")) {
        $("#menu").addClass("border-blue-600 text-blue-600 ");
        $("#svgmenu").addClass("text-blue-600");
    }
</script>
@endsection