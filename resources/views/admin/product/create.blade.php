@extends("layouts/client_layout")
@section("title","Thêm sản phẩm")
@section("content")
@include("components/popper")
<div class="sm:container my-5">
    <div class="flex justify-end pr-32 ">
        <div class="bg-blue-500 rounded">
            <a href="{{ route('admin/product') }}" class="flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="w-5 h-5 m-2 text-white">
                    <path strokeLinecap="round" strokeLinejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                </svg>
                <span class="text-white pr-2 py-2">Back</span>
            </a>
        </div>
    </div>
    <form class="space-y-6 w-1/2 m-auto" method="post" action="{{ route('admin/product/store') }}" enctype="multipart/form-data">
        @csrf
        <div class="text-3xl font-semibold text-center">Thêm sản phẩm</div>
        <div class="relative z-0 mb-6 w-full group">
            <label class="block text-sm font-medium text-gray-900 dark:text-gray-300" for="multiple_files">Tên sản phẩm</label>
            <input type="text" name="product_name" value="{{ old('product_name') }}" id="product_name" class="block py-2 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="">
            {{ error("product_name") }}
        </div>
        <div class="relative z-0 mb-6 w-full group">
            <label class="block text-sm font-medium text-gray-900 dark:text-gray-300" for="multiple_files">Giá</label>
            <input type="number" name="price" id="price" value="{{ old('price') }}" class="block py-2 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="">
            {{ error("price") }}
        </div>
        <div class="overflow-hidden relative w-ful mt-4 mb-4">
            <button type="button" id="btnimage" class="bg-blue-600 hover:bg-indigo-dark text-white font-bold py-2 px-4 w-full inline-flex items-center">
                <svg fill="#FFF" height="18" viewBox="0 0 24 24" width="18" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path d="M9 16h6v-6h4l-7-7-7 7h4zm-4 2h14v2H5z" />
                </svg>
                <span class="ml-2">Tải lên hình ảnh đại diện</span>
            </button>
            <img class="w-20 h-auto mt-2 hidden" src="" size="10px" alt="image description" id="showimage">
            <input class="cursor-pointer absolute block opacity-0 pin-r pin-t" name="image" type="file" name="vacancyImageFiles" id="fileImage">
        </div>
        <div class="overflow-hidden relative w-full mt-4 mb-4">
            <button type="button" id="btnimages" class="bg-blue-600 hover:bg-indigo-dark text-white font-bold py-2 px-4 w-full inline-flex items-center">
                <svg fill="#FFF" height="18" viewBox="0 0 24 24" width="18" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path d="M9 16h6v-6h4l-7-7-7 7h4zm-4 2h14v2H5z" />
                </svg>
                <span class="ml-2">Tải lên hình ảnh chi tiết</span>
            </button>
            <div id="showimages" class="flex flex-row flex-wrap gap-2 justify-center mt-2"></div>
            <input class="cursor-pointer absolute block opacity-0 pin-r pin-t" name="images[]" type="file" name="vacancyImageFiles" id="fileImages" multiple>
        </div>

        <div class="relative z-0 mb-6 w-full group">
            <label class="block text-sm font-medium text-gray-900 dark:text-gray-300" for="multiple_files">Danh mục</label>
            <select id="underline_select" name="category_id" class="block py-2 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                <option value="">Choose a category</option>
                @php("id", $product['category_id'])
                {{ categoryRaw($categories, $id) }}
            </select>
            {{ error("category_id") }}
        </div>
        <div class=" relative z-0 mb-6 w-full group">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="multiple_files">Mô tả</label>
            <div class="mb-4 w-full bg-gray-50 rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600">
                <div class="py-2 px-4 bg-white rounded-b-lg dark:bg-gray-800">
                    <label for="editor" class="sr-only">Publish post</label>
                    <textarea id="editor" name="descript" rows="8" class="block px-0 w-full text-sm text-gray-800 bg-white border-0 focus:ring-0" placeholder="Mô tả sản phầm">{{ old('descript') }}</textarea>
                    {{ error("descript") }}
                </div>
            </div>
        </div>
        <button type="submit" id="create" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Thêm sản phẩm</button>
    </form>
</div>
@endsection

@section("script")
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showimage').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    // show preview image
    $("#btnimage").click(function() {
        $("#fileImage").trigger("click");
        $("#fileImage").change(function() {
            $("#showimage").show();
            readURL(this);
        });
    })

    // show preview list image
    $(function() {
        var imagesPreview = function(input, placeToInsertImagePreview) {
            if (input.files) {

                console.log(input.files);
                var filesAmount = input.files.length;
                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        image = $($.parseHTML("<div class=''>")).appendTo(placeToInsertImagePreview);
                        $($.parseHTML('<img class="w-24">')).attr('src', event.target.result).appendTo(image);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }

        };

        $('#btnimages').on('click', function() {
            $("#fileImages").trigger("click");
            $("#fileImages").change(function() {
                $("#showimages").show();
                imagesPreview(this, 'div#showimages');
            });
        });
    });

    // popper
    var href = window.location.href;

    if (href.indexOf("admin/product")) {
        $("#product").addClass("border-blue-600  text-blue-600 ");
        $("#svgProduct").addClass("text-blue-600");
    }
</script>

@endsection