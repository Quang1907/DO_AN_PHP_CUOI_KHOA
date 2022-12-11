@extends('layouts/client_layout')
@section('title', 'Thay doi mat khau')
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
                    <h2 class="text-3xl font-bold text-green-800 bg-transparent mt-12">{{ $user['fullName'] }}</h2>
                </div>
                <div class="text-end">
                    <div class="w-5/6">
                        <a href="{{ route('profile') }}"
                            class="bg-blue-600 rounded text-white text-clip p-2 hover:bg-blue-500">Back</a>
                    </div>
                </div>
                <div class="container max-w-3xl">
                    <div class="flex p-4 w-5/6 m-auto mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800 "
                        id="divError" role="alert">
                        <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <span class="font-medium">Vui lòng kiểm tra lại:</span>
                            <ul class="mt-1.5 ml-4  mx-2 text-red-700 list-disc list-inside" id="error">
                            </ul>
                        </div>
                    </div>
                    @if( Core\Session::data("message") ) 
                    <div id="toast-simple" class=" my-4 flex items-center p-4 space-x-4 w-full max-w-sm text-gray-500 bg-white rounded-lg divide-x divide-gray-200 shadow dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800" role="alert">
                        <svg aria-hidden="true" class="w-5 h-5 text-red-600 dark:text-blue-500" focusable="false" data-prefix="fas" data-icon="paper-plane" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M511.6 36.86l-64 415.1c-1.5 9.734-7.375 18.22-15.97 23.05c-4.844 2.719-10.27 4.097-15.68 4.097c-4.188 0-8.319-.8154-12.29-2.472l-122.6-51.1l-50.86 76.29C226.3 508.5 219.8 512 212.8 512C201.3 512 192 502.7 192 491.2v-96.18c0-7.115 2.372-14.03 6.742-19.64L416 96l-293.7 264.3L19.69 317.5C8.438 312.8 .8125 302.2 .0625 289.1s5.469-23.72 16.06-29.77l448-255.1c10.69-6.109 23.88-5.547 34 1.406S513.5 24.72 511.6 36.86z"></path></svg>
                        <div class="pl-4 text-sm font-normal">{{ Core\Session::flash("message") }}</div>
                    </div>
                    @endif
                    <form action="{{ route('password') }}" method="post">
                        @csrf
                        <div class="mb-6">
                            <label for="old_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Mật khẩu cũ</label>
                            <input type="password" name="old_password" id="old_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" required>
                        </div> 
                        <div class="mb-6">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Mật khẩu mới</label>
                            <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" required>
                        </div> 
                        <div class="mb-6">
                            <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nhập lại mật khẩu</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" required>
                        </div> 
                        <button type="submit" class=" mb-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('script')
    <script src="{{ asset('js/address.js') }}"></script>
    <script>
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
