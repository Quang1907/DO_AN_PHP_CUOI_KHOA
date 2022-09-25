@extends("layouts/client_layout")
@session("title","Quản lý Danh mục")

@session("content")
@include("components/popper")

@php
$message = Core\Session::flash("success") ?? "";
echo "<input id='message' type='hidden' value='" . $message . "'>";
@endphp

<div class="container">
    <div class="mt-3 p-2 w-1/2 m-auto">
        <div class="flex justify-center">
            <h2 class="font-semibold text-2xl border-b-2 text-center">Danh mục sản phẩm</h2>
            <a href="{{ route('admin.category.create') }}" class="border ml-2 border-green-600 bg-green-600 text-white p-1 px-2 rounded">+</a>
        </div>
        <div class="p-2" id="categoryList">
        </div>
    </div>
</div>

@endsession
@session("script") <script>
    var href = window.location.href;
    if (href.indexOf("admin/category")) {
        $("#category").addClass("border-blue-600 text-blue-600 ");
        $("#svgCategory").addClass("text-blue-600");
    }

    if ($("#message").val() != "") {
        Toast.fire({
            icon: 'success',
            title: $("#message").val()
        })
    }

    categoryList();

    function categoryList() {
        $("#categoryList").html("");
        $.ajax({
            url: "{{ route('admin.api.category') }}",
            type: "GET",
            success: function(response) {
                response = $.parseJSON(response);
                recurseCategory(response.data)
            }
        })
    }

    function recurseCategory(categories, html = '', parent = 0, char = "", padding = 0) {
        $.each(categories, function(key, cate) {
            if (cate["parent_id"] == parent) {
                $("#categoryList").append(" <div class='flex justify-between border-b'>" +
                    "<h3 class='text-1xl font-semibold px-" + padding + "'>" + char + cate["category_name"] + "</h3>" +
                    "<div>"+
                    "<a href='{{ route('admin.category.edit') }}/" + cate["id"] + "' class='float-end px-2 text-blue-600 hover:text-blue-500'>Sửa</a>" +
                    "<button onClick='deleteCategory(" + cate["id"] + ")' class='float-end text-red-600 hover:text-red-400'>Xoá</button>" +
                    "</div>"+
                    "</div>");
                categories.slice(key, 1);
                recurseCategory(categories, html, cate["id"], char + "--", padding + 3);
            }
        })
    }

    function deleteCategory(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'bg-green-600 p-3 rounded text-white m-2',
                cancelButton: 'bg-red-600 p-3 rounded text-white'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Bạn có muốn tiếp tục',
            text: "Xoá danh mục này",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Tiếp tục',
            cancelButtonText: 'Không!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                var route = "{{ route('admin.category.delete') }}" + "/" + id;
                $.ajax({
                    type: "GET",
                    url: route,
                    success: function(response) {
                        response = $.parseJSON(response);
                        swalWithBootstrapButtons.fire(
                            'Xoá danh mục',
                            response.data.messages,
                            'success'
                        )
                        categoryList();
                    }
                })
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Dừng lại',
                    'Bạn không xoá danh mục',
                    'error'
                )
            }
        })

    }
</script>
@endsession