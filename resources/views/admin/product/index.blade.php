@extends("layouts/client_layout")
@section("title","Quản lý sản phẩm")
@section("content")
@include("components/popper")
<?php

use Core\Session;

$message = "";
if (!empty(Session::data("success"))) {
    $message = Session::flash("success");
}
echo "<input id='message' type='hidden' value='" . $message . "'>";
?>
<div class="container">
    <div class="flex justify-end pt-4">
        <a href="{{ route('admin/product/create') }}" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">Add Product</a>
    </div>
    <div class="overflow-x-auto relative sm:rounded-lg mb-5 mt-2">
        <div class="flex justify-center xl:justify-end xl:pr-10 items-center pb-4 dark:bg-gray-900">
            <div class="relative">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" id="table-search-users" class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tìm kiếm sản phẩm">
            </div>
        </div>
        <table class="w-full text-sm text-left  text-blue-100 dark:text-blue-100">
            <thead class="text-xs text-white border-t uppercase bg-blue-600 dark:text-white text-center">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Product name
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Image
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Category
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Price
                    </th>
                    <th scope="col" class="py-3 px-6 w-2/6">
                        Descript
                    </th>
                    <th scope="col" class="py-3 px-6 w-1/6">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody class="">
                @foreach($products as $product)
                <tr class="bg-blue-500 border-b border-blue-400">
                    <th scope="row" class="py-1 px-6 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100">
                        {{ $product['product_name'] }}
                    </th>
                    <td class="py-1 px-6 flex justify-center">
                        <img class="w-14 h-auto" src="{{ _WEB_ROOT .'images/products/'. $product['image']}}" alt="image description">
                    </td>
                    <td class="py-1 px-6 text-center">
                        {{ $product['category_name'] }}
                    </td>
                    <td class="py-1 px-6 text-center">
                        {{ number_format( $product['price']) }}
                    </td>
                    <td class="py-1 px-6">
                        <article class="descript">{{ $product['descript'] }}</article>
                    </td>
                    <td class=" py-1 px-6 text-center">
                        <a href="{{ route('admin/product/edit', $product['id']) }}" class="font-medium bg-yellow-500 p-2 rounded text-white hover:underline">Edit</a>
                        <a href="{{ route('admin/product/delete', $product['id']) }}" class="font-medium bg-red-600 p-2 rounded text-white hover:underline">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section("script")
<script>
    var href = window.location.href;

    if (href.indexOf("admin/product")) {
        $("#product").addClass("border-blue-600 text-blue-600 ");
        $("#svgProduct").addClass("text-blue-600");
    }

    if ($("#message").val() != "") {
        Toast.fire({
            icon: 'success',
            title: $("#message").val()
        })
    }

    $.each($(".descript"), function(index, value) {
        var str = $(this).text();
        if (str.length > 40) {
            $(this).text(str.substring(0, 40) + " ...");
        }
    })
</script>
@endsection