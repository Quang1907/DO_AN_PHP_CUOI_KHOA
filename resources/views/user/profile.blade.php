@extends("layouts/client_layout")
@section("title","Trang cá nhân")
@section("content")
@if(!empty($user))
<?php
    echo "<input id='message' type='hidden' value='". Core\Session::flash("message") ."'>";
?>
<div class=" dark:bg-gray-900 flex flex-wrap items-center justify-center">
    <div class="w-full bg-white dark:bg-gray-800 shadow-lg transform duration-200 easy-in-out">
        <div class="h-2/4 sm:h-64 overflow-hidden">
            <img class="w-full" src="https://images.unsplash.com/photo-1638803040283-7a5ffd48dad5?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=774&q=80" alt="Photo by aldi sigun on Unsplash" />
        </div>
        <div class="flex justify-start px-5 -mt-12 mb-5">
            <span clspanss="block relative h-32 w-32">
                <img alt="Photo by aldi sigun on Unsplash" src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTJ8fHByb2ZpbGUlMjBwaWN0dXJlfGVufDB8fDB8fA%3D%3D&auto=format&fit=crop&w=500&q=60" class="mx-auto object-cover rounded-full h-24 w-24 bg-white p-1" />
            </span>
        </div>
        <div class="container max-w-3xl">
            <div class="flex p-4 w-5/6 m-auto mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800 " id="divError" role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                <div>
                    <span class="font-medium">Vui lòng kiểm tra lại:</span>
                    <ul class="mt-1.5 ml-4  mx-2 text-red-700 list-disc list-inside" id="error">
                    </ul>
                </div>
            </div>
            <div class="px-7 mb-8">
                <input disabled id="fullName" type="text" class="text-3xl font-bold text-green-800 dark:bg-white" value="{{ $user['fullName'] }}"></h2>
                <div class="grid grid-cols-4 gap-4">
                    <span class="mt-2">Email: </span><input disabled id="email" type="text" class="col-span-3 text-black mt-2 px-2 border-2  dark:border-gray-500 dark:text-gray-400" value="{{ $user['email'] }}">
                    <span class="mt-2">Ngày sinh: </span><input disabled id="birthday" type="date" class="col-span-3 text-black mt-2 px-2 border-2  dark:border-gray-500 dark:text-gray-400" value="{{ $user['birthday'] }}">
                    <span class="mt-2">Phonenumber: </span><input disabled id="phoneNumber" type="text" class="col-span-3 text-black mt-2 px-2 border-2  dark:border-gray-500 dark:text-gray-400" value="{{ $user['phoneNumber'] }}">
                    <span class="mt-2">Địa chỉ: </span><input disabled id="_name_address" type="text" class="col-span-3 text-black mt-2 px-2 border-2  dark:border-gray-500 dark:text-gray-400" value="{{ $user['_name_address'] }}">
                    <!-- <div class="col-span-4 hidden" id="chooseAddress">
                        <div class="relative z-0 w-full group p-4">
                            <div class="relative z-0 w-full group">
                                <select id="province" name="province" class="block p-2 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                    <option value="">Choose a province</option>
                                    <?php
                                    foreach ($provinces as $province) {
                                        echo "<option value=" . $province['id'] . ">" . $province['_name_province'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <label for="province" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Thành phố</label>
                        </div>
                        <div class="relative z-0 w-full group p-4">
                            <div class="relative z-0 w-full group">
                                <select id="district" name="district" class="block p-2 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                    <option value="">Choose a district</option>
                                </select>
                            </div>
                            <label for="district" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Quận/Huyện</label>
                        </div>
                        <div class="relative z-0 w-full group p-4">
                            <div class="relative z-0 w-full group">
                                <select id="ward" name="ward" class="block p-2 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                    <option value="">Choose a ward</option>
                                </select>
                            </div>
                            <label for="ward" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Xã/Phường</label>
                        </div>
                        <div class="relative z-0 w-full group p-4">
                            <input type="text" name="street" id="street" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" ">
                            <label for="street" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tổ dân phố</label>
                        </div>
                    </div> -->
                </div>
                <div class="text-center py-3">
                    <a href="{{ route('change-address') }}" class="text-blue-700  p-2 hover:bg-blue-500 hover:text-white rounded">Thay đổi địa chỉ</a>
                    <a href="{{ route('change-password') }}" class="text-blue-700  p-2 hover:bg-blue-500 hover:text-white rounded">Thay đổi mật khẩu</a>
                </div>
                <button id="editProfile" type="button" class="text-center m-auto justify-center px-4 py-2 cursor-pointer bg-green-900 max-w-fit mx-auto mt-8 rounded-lg text-gray-300 hover:bg-green-800 hover:text-gray-100 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-gray-200">
                    Thay đổi thông tin
                </button>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@section("script")
<script src="{{ asset('js/address.js') }}"></script>
<script>
    if ($("#message").val()) {
        Toast.fire({
            icon: 'success',
            title: $("#message").val()
        });
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