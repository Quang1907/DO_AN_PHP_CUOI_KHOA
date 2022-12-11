@extends("layouts/client_layout")
@section("title","Cửa hàng")
@section("content")
<div class="relative w-full mx-auto">
    <div class="slide relative">
        <img class="w-full h-[400px] object-cover"
            src="https://shopkyyeu.com/wp-content/uploads/2017/06/ts250191-1.jpg">
        <div class="absolute bottom-0 w-full px-5 py-3 bg-black/40 text-center text-white">Trang phục chuẩn tác phong</div>
    </div>

    <div class="slide relative">
        <img class="w-full h-[400px] object-cover"
            src="https://dongphucmientrung.vn/StoreData/PageData/2214/ao-doan-thanh-nien-la-gi.jpg">
        <div class="absolute bottom-0 w-full px-5 py-3 bg-black/40 text-center text-white">Cùng chung tay</div>
    </div>

    <div class="slide relative">
        <img class="w-full h-[400px] object-cover"
            src="https://dongphucmientrung.vn/StoreData/PageData/2214/lich-su-ra-doi-ao-doan-thanh-nien.jpg">
        <div class="absolute bottom-0 w-full px-5 py-3 bg-black/40 text-center text-white">Trang phục nghiêm túc
        </div>
    </div>

    <!-- The previous button -->
    <a class="absolute left-0 top-1/2 p-4 -translate-y-1/2 bg-black/30 hover:bg-black/50 text-white hover:text-amber-500 cursor-pointer"
        onclick="moveSlide(-1)">❮</a>

    <!-- The next button -->
    <a class="absolute right-0 top-1/2 p-4 -translate-y-1/2 bg-black/30 hover:bg-black/50 text-white hover:text-amber-500 cursor-pointer"
        onclick="moveSlide(1)">❯</a>

</div>
<br>

<div class="flex justify-center items-center space-x-5">
    <div class="dot w-4 h-4 rounded-full cursor-pointer" onclick="currentSlide(1)"></div>
    <div class="dot w-4 h-4 rounded-full cursor-pointer" onclick="currentSlide(2)"></div>
    <div class="dot w-4 h-4 rounded-full cursor-pointer" onclick="currentSlide(3)"></div>
</div>

<div class="bg-white sm:container">
    <div class="mx-auto max-w-2xl py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
        <h2 class="text-3xl mb-4 border-b-2"><a href="https://fb.com" class="border-t-2 hover:text-blue-500">Products</a></h2>
        <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
            <a href="#" class="group">
                <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-w-7 xl:aspect-h-8">
                    <img src="https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-01.jpg" alt="Tall slender porcelain bottle with natural clay textured body and cork stopper." class="h-full w-full object-cover object-center group-hover:opacity-75">
                </div>
                <h3 class="mt-4 text-sm text-gray-700">Earthen Bottle</h3>
                <p class="mt-1 text-lg font-medium text-gray-900">$48</p>
            </a>
        </div>
    </div>
</div>

{{-- <div class="sm:container">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
        <div class="cursor-pointer rounded-xl bg-white p-3 shadow-lg hover:shadow-xl">
          <div class="relative flex items-end overflow-hidden rounded-xl">
            <img src="https://thumbnails.production.thenounproject.com/gA9eZOvsBYSHrMumgrslmRGoBto=/fit-in/1000x1000/photos.production.thenounproject.com/photos/BCBA88B6-5B41-4B50-A786-E60CAA0ECDA3.jpg" alt="wallpaper" />
      
            <div class="absolute bottom-3 left-3 inline-flex items-center rounded-lg bg-white p-2 shadow-md">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
              </svg>
      
              <span class="ml-1 text-sm text-slate-400">4.9</span>
            </div>
          </div>
      
          <div class="mt-1 p-2">
            <h2 class="text-slate-700">The Malta Hotel</h2>
            <p class="mt-1 text-sm text-slate-400">Italy, Europe</p>
      
            <div class="mt-3 flex items-end justify-between">
              <p>
                <span class="text-lg font-bold text-orange-500">$1,421</span>
                <span class="text-sm text-slate-400">/night</span>
              </p>
      
              <div class="group inline-flex rounded-xl bg-orange-100 p-2 hover:bg-orange-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-orange-400 group-hover:text-orange-500" viewBox="0 0 20 20" fill="currentColor">
                  <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z" />
                </svg>
              </div>
            </div>
          </div>
        </div>
      
        <div class="cursor-pointer rounded-xl bg-white p-3 shadow-lg hover:shadow-xl">
          <div class="relative flex items-end overflow-hidden rounded-xl">
            <img src="https://thumbnails.production.thenounproject.com/gA9eZOvsBYSHrMumgrslmRGoBto=/fit-in/1000x1000/photos.production.thenounproject.com/photos/BCBA88B6-5B41-4B50-A786-E60CAA0ECDA3.jpg" alt="wallpaper" />
      
            <div class="absolute bottom-3 left-3 inline-flex items-center rounded-lg bg-white p-2 shadow-md">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
              </svg>
      
              <span class="ml-1 text-sm text-slate-400">4.9</span>
            </div>
          </div>
      
          <div class="mt-1 p-2">
            <h2 class="text-slate-700">The Malta Hotel</h2>
            <p class="mt-1 text-sm text-slate-400">Italy, Europe</p>
      
            <div class="mt-3 flex items-end justify-between">
              <p>
                <span class="text-lg font-bold text-orange-500">$1,421</span>
                <span class="text-sm text-slate-400">/night</span>
              </p>
      
              <div class="group inline-flex rounded-xl bg-orange-100 p-2 hover:bg-orange-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-orange-400 group-hover:text-orange-500" viewBox="0 0 20 20" fill="currentColor">
                  <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z" />
                </svg>
              </div>
            </div>
          </div>
        </div>
      
        <div class="cursor-pointer rounded-xl bg-white p-3 shadow-lg hover:shadow-xl">
          <div class="relative flex items-end overflow-hidden rounded-xl">
            <img src="https://thumbnails.production.thenounproject.com/gA9eZOvsBYSHrMumgrslmRGoBto=/fit-in/1000x1000/photos.production.thenounproject.com/photos/BCBA88B6-5B41-4B50-A786-E60CAA0ECDA3.jpg" alt="wallpaper" />
      
            <div class="absolute bottom-3 left-3 inline-flex items-center rounded-lg bg-white p-2 shadow-md">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
              </svg>
      
              <span class="ml-1 text-sm text-slate-400">4.9</span>
            </div>
          </div>
      
          <div class="mt-1 p-2">
            <h2 class="text-slate-700">The Malta Hotel</h2>
            <p class="mt-1 text-sm text-slate-400">Italy, Europe</p>
      
            <div class="mt-3 flex items-end justify-between">
              <p>
                <span class="text-lg font-bold text-orange-500">$1,421</span>
                <span class="text-sm text-slate-400">/night</span>
              </p>
      
              <div class="group inline-flex rounded-xl bg-orange-100 p-2 hover:bg-orange-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-orange-400 group-hover:text-orange-500" viewBox="0 0 20 20" fill="currentColor">
                  <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z" />
                </svg>
              </div>
            </div>
          </div>
        </div>
    </div>
</div> --}}
@endsection

@section("script")
<script>
    // set the default active slide to the first one
    let slideIndex = 1;
    showSlide(slideIndex);

    // change slide with the prev/next button
    function moveSlide(moveStep) {
        showSlide(slideIndex += moveStep);
    }

    // change slide with the dots
    function currentSlide(n) {
        showSlide(slideIndex = n);
    }

    function showSlide(n) {
        let i;
        const slides = document.getElementsByClassName("slide");
        const dots = document.getElementsByClassName('dot');
        
        if (n > slides.length) { slideIndex = 1 }
        if (n < 1) { slideIndex = slides.length }

        // hide all slides
        for (i = 0; i < slides.length; i++) {
            slides[i].classList.add('hidden');
        }

        // remove active status from all dots
        for (i = 0; i < dots.length; i++) {
            dots[i].classList.remove('bg-yellow-500');
            dots[i].classList.add('bg-green-600');
        }

        // show the active slide
        slides[slideIndex - 1].classList.remove('hidden');

        // highlight the active dot
        dots[slideIndex - 1].classList.remove('bg-green-600');
        dots[slideIndex - 1].classList.add('bg-yellow-500');
    }
</script>
@endsection