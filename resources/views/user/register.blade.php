@extends('layouts/client_layout')
@section('title', 'Đăng ký tài khoản')
@section('content')
    <div class="sm:container my-5">
        <div class="hidden flex p-4 w-1/2 m-auto mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800 "
            id="divError" role="alert">
            <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                    clip-rule="evenodd"></path>
            </svg>
            <div>
                <span class="font-medium">Vui lòng kiểm tra lại:</span>
                <ul class="mt-1.5 ml-4 text-red-700 list-disc list-inside" id="error">
                </ul>
            </div>
        </div>
        <form class="space-y-6 w-1/2 m-auto" method="post" action="{{ route('user/register') }}">
            <div class="text-3xl font-semibold text-center">Đăng ký tài khoản</div>
            <div class="relative z-0 mb-6 w-full group">
                <input type="text" name="fullName" id="fullName"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" ">
                <label for="fullName"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Họ
                    Tên</label>
            </div>
            <div class="relative z-0 mb-6 w-full group">
                <input type="email" name="email" id="email"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" ">
                <label for="email"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Địa
                    chỉ Email</label>
            </div>
            <div class="relative">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="date" name="birthday" id="birthday"
                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker-input"
                    placeholder="Ngày Sinh">
            </div>
            <div class="relative z-0 mb-6 w-full group">
                <input type="password" name="password" id="password"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" ">
                <label for="password"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Mật
                    khẩu</label>
            </div>
            <div class="relative z-0 mb-6 w-full group">
                <input type="password" name="confirm_password" id="confirm_password"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" ">
                <label for="confirm_password"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nhập
                    lại mật khẩu</label>
            </div>
            <!-- <div class="grid md:grid-cols-2 md:gap-6"> -->
            <div class="relative z-0 mb-6 w-full group">
                <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="phoneNumber" id="phoneNumber"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" ">
                <label for="phoneNumber"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Số
                    điện thoại (070-805-0907)</label>
            </div>
            <!-- <div class="grid md:grid-cols-3 md:gap-6 mb-6"> -->
            <div class="relative z-0 w-full group">
                <div class="relative z-0 w-full group">
                    <select id="province" name="province"
                        class="block p-2 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                        <option value="">Choose a province</option>
                        <?php
                        foreach ($provinces as $province) {
                            echo '<option value=' . $province['id'] . '>' . $province['_name_province'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <label for="province"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Thành
                    phố</label>
            </div>
            <div class="relative z-0 w-full group">
                <div class="relative z-0 w-full group">
                    <select id="district" name="district"
                        class="block p-2 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                        <option value="">Choose a district</option>
                    </select>
                </div>
                <label for="district"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Quận/Huyện</label>
            </div>
            <div class="relative z-0 w-full group">
                <div class="relative z-0 w-full group">
                    <select id="ward" name="ward"
                        class="block p-2 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                        <option value="">Choose a ward</option>
                    </select>
                </div>
                <label for="ward"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Xã/Phường</label>
            </div>
            <div class="relative z-0 w-full group">
                <div class="relative z-0 w-full group">
                    <select id="manager" name="manager"
                        class="block p-2 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                        <option value="">Choose a manager</option>
                    </select>
                </div>
                <label for="manager"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Ngườ
                    i quản lý</label>
            </div>
            <div class="relative z-0 w-full group">
                <input type="text" name="street" id="street"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" ">
                <label for="street"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tổ
                    dân phố</label>
            </div>
            <button type="button" id="create"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Đăng
                ký</button>
        </form>
    </div>
    <input type="hidden" id="routeCreateUser" value="{{ route('user/store') }}">
    <input type="hidden" id="routeDistrict" value="{{ route('district') }}">
    <input type="hidden" id="routeWard" value="{{ route('ward') }}">
    <input type="hidden" id="routeShowAdmin" value="{{ route('showAdmin') }}">
    <input type="hidden" id="routeCreateAddress" value="{{ route('address/create') }}">

@endsection

@section('script')
    <!-- <script src="{{ asset('js/address.js') }}"></script> -->
    <script>
        province();
        district();
        admin();

        function province() {
            $("#province").change(function() {
                $("#district").html("<option selected> Choose District</option>");
                $.ajax({
                    url: $("#routeDistrict").val() + "/" + $(this).val(),
                    type: "GET",
                    success: function(response) {
                        response = $.parseJSON(response);
                        if (response.status == 200) {
                            data = response.data;
                            $.each(data, function(key, value) {
                                $($.parseHTML("<option>" + value._name_district + "</option>"))
                                    .attr("value", value.id).appendTo("#district");
                            })
                        }
                    }
                })
            })
        }


        function district() {
            $("#district").change(function() {
                $("#ward").html("<option selected> Choose District</option>");
                $.ajax({
                    url: $("#routeWard").val() + "/" + $(this).val(),
                    type: "GET",
                    success: function(response) {
                        response = $.parseJSON(response);
                        if (response.status == 200) {
                            data = response.data;
                            $.each(data, function(key, value) {
                                $($.parseHTML("<option>" + value._name_ward + "</option>"))
                                    .attr("value", value.id).appendTo("#ward");
                            })
                        }
                    }
                })
            })
        }

        function admin() {
            $("#ward").change(function() {
                $("#manager").html("");
                $.ajax({
                    url: $("#routeShowAdmin").val() + "/" + $(this).val(),
                    type: "GET",
                    success: function(response) {
                        response = $.parseJSON(response);
                        if (response.status == 200) {
                            data = response.data;
                            $.each(data, function(key, value) {
                                $($.parseHTML("<option>" + value.fullName + "</option>")).attr(
                                    "value", value.id).appendTo("#manager");
                            })
                        }
                        if (response.status == 412) {
                            $($.parseHTML("<option>" + response.data + "</option>")).appendTo(
                                "#manager");
                        }
                    }
                })
            })
        }

        // $("#province").change(function() {
        //     $("#district").html("");
        //     $.ajax({
        //         url: $("#routeDistrict").val() + "/" + $(this).val(),
        //         type: "GET",
        //         success: function(response) {
        //             response = $.parseJSON(response);
        //             if (response.status == 200) {
        //                 data = response.data;
        //                 $.each(data, function(key, value) {
        //                     $($.parseHTML("<option>" + value._name_district + "</option>")).attr("value", value.id).appendTo("#district");
        //                 })
        //             }
        //         }
        //     })
        // })

        // $("#district").change(function() {
        //     $("#ward").html("");
        //     $.ajax({
        //         url: $("#routeWard").val() + "/" + $(this).val(),
        //         type: "GET",
        //         success: function(response) {
        //             response = $.parseJSON(response);
        //             if (response.status == 200) {
        //                 data = response.data;
        //                 $.each(data, function(key, value) {
        //                     $($.parseHTML("<option>" + value._name_ward + "</option>")).attr("value", value.id).appendTo("#ward");
        //                 })
        //             }
        //         }
        //     })
        // })

        $("#create").click(function() {
            const routeUser = $("#routeCreateUser").val();

            var ward = $("#ward option:selected").text();
            var district = $("#district option:selected").text();
            var province = $("#province option:selected").text();
            var street = $("#street").val();
            var manager = $("#manager").val();
            const address = street + ", " + ward + ", " + district + ", " + province;

            var data = {
                "email": $("#email").val(),
                "password": $("#password").val(),
                "confirm_password": $("#confirm_password").val(),
                "fullName": $("#fullName").val(),
                "phoneNumber": $("#phoneNumber").val(),
                "birthday": $("#birthday").val(),
                "_name_address": address,
                "manager": manager
            };

            $.ajax({
                type: "POST",
                url: routeUser,
                data: data,
                success: function(response) {
                    response = $.parseJSON(response);
                    data = response.data;
                    if (response.status == 412) {
                        var listErr = "";
                        $.each(data.error, function(index, value) {
                            listErr += "<li>" + value + "</li>";
                        });

                        $("#divError").addClass("block");
                        $("#divError").removeClass("hidden");
                        $("#error").html(listErr);
                        $("html, body").animate({
                            scrollTop: 0
                        }, 1000);
                    }
                    if (response.status == 200) {
                        window.location.href = data;
                    }
                }
            })
        })
    </script>
@endsection
