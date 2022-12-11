@extends('layouts/client_layout')
@section('title', 'Thay doi dia')
@section('content')
    @if (!empty($user))
        <div class=" dark:bg-gray-900 flex flex-wrap items-center justify-center">
            <div class="w-full bg-white dark:bg-gray-800 shadow-lg transform duration-200 easy-in-out">
                <div class="h-2/4 sm:h-64 overflow-hidden">
                    <img class="w-full"
                        src="https://images.unsplash.com/photo-1638803040283-7a5ffd48dad5?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=774&q=80"
                        alt="Photo by aldi sigun on Unsplash" />
                </div>
                <div class="flex justify-start px-5 -mt-12 mb-5">
                    <span clspanss="block relative h-32 w-32">
                        <img alt="Photo by aldi sigun on Unsplash"
                            src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTJ8fHByb2ZpbGUlMjBwaWN0dXJlfGVufDB8fDB8fA%3D%3D&auto=format&fit=crop&w=500&q=60"
                            class="mx-auto object-cover rounded-full h-24 w-24 bg-white p-1" />
                    </span>
                    <input disabled id="fullName" type="text" class="text-3xl font-bold text-green-800 bg-transparent mt-10"
                        value="{{ $user['fullName'] }}"></h2>
                </div>
                <div class="text-end">
                    <div class="w-5/6">
                        <a href="{{ route('profile') }}"
                            class="bg-blue-600 rounded text-white text-clip p-2 hover:bg-blue-500">Back</a>
                    </div>
                </div>
                <div class="container max-w-3xl">
                    <form action="{{ route('password') }}" method="post" class="space-y-6 w-1/2 m-auto">
                        @csrf
                        <div class="relative z-0 w-full group">
                            <div class="relative z-0 w-full group">
                               <label for=""> {{ error("province") }}</label>
                                <select id="province" name="province"
                                    class="block p-2 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                    <option value="">Choose a province</option>
                                    <?php
                                    foreach ($provinces as $province) {
                                        $select = "";
                                        if($province['id'] == old("province")) {
                                            $select = "selected";
                                        }
                                        echo '<option '.  $select  .' value=' . $province['id'] . '>' . $province['_name_province'] . '</option>';
                                       
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
                                <label for=""> {{ error("district") }}</label>
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
                                <label for="">{{ error("ward") }}</label>
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
                                <label for="">{{ error("manager") }}</label>
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
                            <label for="street"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tổ
                            dân phố</label>
                            <label for="">{{ error("street") }}</label>
                            <input type="text" name="street" id="street"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" ">
                        </div>
                        <div class="text-end pb-5">
                            <button type="submit" id="create"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Xác
                                nhận</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('script')
    <script src="{{ asset('js/address.js') }}"></script>
    <script>
        province();
        district();
        admin();
    
        function province() {
            $("#province").change(function() {
                $("#district").html("<option selected> Choose a district</option>");
                $.ajax({
                    url: "{{ route('district') }}" + "/" + $(this).val(),
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
                $("#ward").html("<option selected> Choose a district</option>");
                $.ajax({
                    url: "{{ route('ward') }}" + "/" + $(this).val(),
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
                    url: "{{ route('showAdmin') }}" + "/" + $(this).val(),
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
        var check = false;
        $("#divError").toggle();
        $("#editProfile").click(function() {
            clickEdit(check)
            var data = {
                'fullName': $("#fullName").val(),
                'email': $("#email").val(),
                'birthday': $("#birthday").val(),
                'phoneNumber': $("#phoneNumber").val(),
                'id': "{{ $user['id'] }}",
            };

            if (check) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('user/update', $user['id']) }}",
                    data: data,
                    success: function(response) {
                        response = $.parseJSON(response);

                        if (response.status == 412) {
                            var listErr = "";
                            $.each(response.data, function(key, value) {
                                listErr += "<li class='list-style-none'>" + value + "</li>";
                            })
                            $("#divError").toggle();
                            $("#error").html(listErr);
                            clickEdit(false)
                        }

                        if (response.status == 200) {
                            $("#divError").hide()
                            Toast.fire({
                                icon: 'success',
                                title: response.data
                            });
                        }
                    }
                })
            }
            check = !check;
        });

        function clickEdit(condition) {
            $('#email, #phoneNumber, #fullName, #birthday').prop("disabled", condition);
            if (condition == false) {
                $('#email, #phoneNumber, #fullName, #birthday').addClass("border border-green-700");
            } else {
                $('#email, #phoneNumber, #fullName, #birthday').removeClass("border border-green-700");
            }
        }
    </script>
@endsection
