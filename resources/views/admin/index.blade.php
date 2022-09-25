@extends("layouts/client_layout")
@session("title","Trang chủ")
@session("content")
@include("components/popper")
<div class="overflow-x-auto md:container relative shadow-md sm:rounded-lg mb-5 mt-2">
    <div class="mt-4 flex justify-center">
        <h2 class="font-semibold text-2xl border-b-2 text-center">Danh sách đoàn viên quản lý</h2>
        <button class="border ml-2 border-green-600 bg-green-600 text-white p-1 px-2 rounded" onclick="showViewUpload()">+</button>
    </div>
    <div class="flex justify-center mt-2">
        {{ import_message() }}
    </div>
    <div class="text-center w-full hidden" id="showViewUpload">
        <form action="{{ route('admin.export') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="flex justify-center items-center w-1/4 m-auto mt-4">
                <label id="label-file" for="dropzone-file" class="flex flex-col justify-center items-center w-full bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <div class="flex flex-col justify-center items-center pt-5 pb-6">
                        <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">xls, csv, xlsx</p>
                    </div>
                </label>
                <input id="dropzone-file" type="file" name="uploadFile" class="hidden">
            </div>
            <button type="submit" id="upload" name="upload" class="bg-green-500 text-white rounded p-2 mt-2">Upload</button>
        </form>
    </div>
    <div class="flex justify-center xl:justify-end xl:pr-10 items-center pb-4 bg-white dark:bg-gray-900">
        <div class="relative">
            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <input type="text" id="table-search-users" class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tìm kiếm tài khoản">
        </div>
    </div>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="p-4">
                    <div class="flex items-center">
                        <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-all-search" class="sr-only">checkbox</label>
                    </div>
                </th>
                <th scope="col" class="py-3 px-6">
                    Họ và Tên
                </th>
                <th scope="col" class="py-3 px-6">
                    Địa chỉ
                </th>
                <th scope="col" class="py-3 px-10">
                    Số điện thoại
                </th>
                <th scope="col" class="py-3 px-10">
                    Status
                </th>
                <th scope="col" class="py-3 text-center">
                    Action
                </th>
            </tr>
        </thead>
        <tbody id="listUder">
        </tbody>
    </table>
</div>
<!-- <input type="hidden" id="routefetchData" value="{{ route('admin') }}"> -->
<!-- <input type="hidden" id="routeDeleteUser" value="{{ route('admin/delete') }}"> -->
<!-- <input type="hidden" id="routeSearchUser" value="{{ route('admin/search') }}"> -->
<!-- <input type="hidden" id="routeShow" value="{{ route('admin/show') }}"> -->
<!-- <input type="hidden" id="routeAdrress" value="{{ route('address/find') }}"> -->

<input type="hidden" id="start" value="0">
<input type="hidden" id="totalRecords" value="0">

<!-- Modal -->
<div class="modal fade fixed top-0 left-0 hidden w-full border-spacing-2  px-44 py-3 h-full outline-none overflow-x-hidden overflow-y-auto" id="showUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="p-4 w-full max-w-xl m-auto bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-between items-center mb-4">
            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white" id="nameUser">Thông tin tài khoản</h5>
        </div>
        <div class="flow-root">
            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700" id="infomation">
            </ul>
        </div>
        <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 rounded-b-md px-2">
            <div class="mx-2" id="active">
            </div>
            <button type="button" id="closeInfo" class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</div>
@endsession
@session("script")
<script>
    $("#dropzone-file").change(function(e) {
        var fileName = e.target.files[0].name;
        $("#label-file").html("Tên file: " + fileName);
    })

    var href = window.location.href;

    if (href.indexOf("admin/profile")) {
        $("#profile").addClass("border-blue-600  text-blue-600 ");
        $("#svgProfile").addClass("text-blue-600");
    }

    function detail(id) {
        $("#showUser").show();

        $.ajax({
            type: "GET",
            url: "{{ route('admin/show') }}" + "/" + id,
            data: "",
            success: function(response) {
                response = $.parseJSON(response);
                if (response.status == 200) {
                    var detailUser = "";
                    $.each(response.data, function(index, value) {
                        if (index != "password") {
                            detailUser += renderInfoDetail(index, value);
                        }
                    });
                    $("#infomation").html(detailUser);

                    $("#active").html('<button type="button" onclick="btnActive(' + response.data.id + ')" id="btnActive" value="' + response.data.id + '" class="inline-block px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out">Active</button>');

                }
            }
        })

        $("#closeInfo").click(function() {
            $("#showUser").hide();
        })
    }

    function btnActive(id) {
        
        $.ajax({
            type: "POST",
            url: "{{ route('admin/update') }}" + "/" + id,
            success: function(response) {
                response = $.parseJSON(response);
                
                if (response.status == 200) {
                    $("#showUser").hide();
                    fetchData();
                }
            }
        })
    }

    fetchData();

    function fetchData() {
        var start = Number( $("#start").val() );
        var rowperpage = start + 5;
        var data = {
            "id": "{{ $user['id'] }}",
            "start": start,
            "rowperpage":rowperpage
        };

        $.ajax({
            type: "GET",
            url: "{{ route('admin') }}",
            data: data,
            success: function(response) {
                response = $.parseJSON(response);
                
                if (response.status == 200) {
                    var listUser = "";
                    
                    $.each(response.data, function(index, value) {
                        listUser += render(value);
                    });
                    $("#listUder").html(listUser);
                }

                if (response.status == 412) {
                    $("#listUder").html("<tr><td colspan='5' class='text-center p-3'>" + response.data.error + "</td></tr>");
                }
            }
        })
    }

    function deleteUser(id) {
        $.ajax({
            type: "GET",
            url: "{{ route('admin/delete') }}" + "/" + id,
            data: "",
            success: function(response) {
                response = $.parseJSON(response);
                // console.log(response);
                fetchData();
                console.log(3);
                Toast.fire({
                    icon: 'success',
                    title: response.data.messages
                });
            }
        })
    }

    $("#table-search-users").keyup(function() {
        var search = $(this).val();
        if (search && search.trim()) {
            $.ajax({
                type: "GET",
                url: "{{ route('admin/search') }}" + "/" + search,
                data: "",
                success: function(response) {
                    response = $.parseJSON(response);
                    if (response.status == 200) {
                        var listUser = "";
                        $.each(response.data, function(index, value) {
                            listUser += render(value);
                        });

                        $("#listUder").html(listUser);
                    }
                }
            })
        } else {
            fetchData();
        }
    })

    function render(value) {
        return '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">' +
            '<td class="p-4 w-4">' +
            '<div class="flex items-center">' +
            '<input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">' +
            '<label for="checkbox-table-search-1" class="sr-only">checkbox</label>' +
            '</div>' +
            '</td>' +
            '<th scope="row" class="flex items-center py-4 px-6 text-gray-900 whitespace-nowrap dark:text-white">' +
            '<img class="w-10 h-10 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-1.jpg" alt="' + value.lastName + '">' +
            '<div class="pl-3">' +
            '<div class="text-base font-semibold">' + value.fullName + '</div>' +
            '<div class="font-normal text-gray-500">' + value.email + '</div>' +
            '</div>' +
            '</th>' +
            '<td class="py-4 px-6">' +
            value._name_address +
            '</td>' +
            '<td class="py-4 px-6">' +
            '<div class="flex items-center">' + value.phoneNumber +
            ' </div>' +
            '</td>' +
            '<td class="py-4 px-6">' +
            '<div class="flex justify-center">' + (value.status ? "<span class='bg-green-600 p-1 rounded-full'></span>" : "<span class='bg-red-600 p-1 rounded-full'></span>") +
            ' </div>' +
            '</td>' +
            '<td class="py-4 text-center">' +
            '<button type="button"  value="1" onClick="detail(' + value.id + ')" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ">Xem</button>' +
            '<button type="button" value="3" onClick="deleteUser(' + value.id + ')" class="delete text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Xoá</button>' +
            '</td>' +
            '</tr>';
    };

    function renderInfoDetail(index, value) {
        return '<li class="py-3 sm:py-4">' +
            '<div class="flex items-center space-x-4">' +
            '<div class="flex-1 min-w-0">' +
            '<p class="text-sm font-medium text-gray-900 truncate dark:text-white uppercase">' +
            index +
            '</p>' +
            '<p class="text-sm text-gray-500 truncate dark:text-gray-400">' +
            '<input class="w-full bg-white" disabled="disabled" value="' + value + '">' +
            '</p>' +
            '</div>' +
            '</div>' +
            '</li>';
    };

    function showViewUpload() {
        $("#showViewUpload").toggle();
    }

</script>
@endsession