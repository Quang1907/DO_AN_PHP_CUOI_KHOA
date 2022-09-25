<?php
// if (!function_exists("error")) {
//     function error($name = "")
//     {
//         $error = Session::flash("error_" . $name);
//         if (isset($error)) {
//             $errorStr = "<div class='flex p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800' role='alert'>
//         <svg aria-hidden='true' class='flex-shrink-0 inline w-5 h-5 mr-3' fill='currentColor' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' d='M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z' clip-rule='evenodd'></path></svg>
//             <div>
//                 <span class='font-medium'>" . $error . "</span>
//             </div>
//         </div>";
//             return $errorStr;
//         }
//     }
// }



// if (!function_exists("old")) {
//     function old($name = "", $default = "")
//     {
//         $error = Session::flash("old_" . $name);
//         return (isset($error)) ? $error : $default;
//     }
// }


// if (!function_exists("route")) {
//     function route($name = "", $data = [])
//     {
//         View::render($name, $data);
//     }
// }

if (!function_exists("showCategory")) {
    function showCategory($categories = [], &$html, $parent = 0, $padding = 0, $char = "")
    {
        foreach ($categories as $key => $category) {
            if ($category["parent_id"] == $parent) {
                $html .= "
                <div class='flex justify-between border-b'>
                <h3 class='text-1xl font-semibold px-$padding'>$char" . $category["category_name"] . "</h3>
                <button onClick='deleteCategory(" . $category["id"] . ")' class='float-end text-red-600 hover:text-red-400'>Xoá</button>
                </div>";
                unset($categories[$key]);
                showCategory($categories, $html, $category["id"], $padding + 3, $char . '--');
            }
        }
    }
}

if (!function_exists("categoryRaw")) {
    function categoryRaw($categories, $selecte = null ,  $id = null,  $char = "", $parent = null)
    {
        foreach ($categories as $key => $category) {
            if ($category['parent_id'] == $parent) {
                $selected = ($selecte ==  $category['id']) ? "selected" : "";
                echo "<option $selected value='" . $category['id'] . "'>" . $char . $category['category_name'] . "</option>";
                unset( $categories[$key] );
                categoryRaw( $categories, $selecte, $id, $char . "--", $category['id'] );
            }
        }
    }
}

if (!function_exists("menuRaw")) {
    function menuRaw($menus, $selecte = null ,  $id = null,  $char = "", $parent = null)
    {
        foreach ($menus as $key => $menu) {
            if ($menu['parent_id'] == $parent) {
                $selected = ($selecte ==  $menu['id']) ? "selected" : "";
                echo "<option $selected value='" . $menu['id'] . "'>" . $char . $menu['menu_name'] . "</option>";
                unset( $menus[$key] );
                menuRaw( $menus, $selecte, $id, $char . "--", $menu['id'] );
            }
        }
    }
}

if ( !function_exists("import_message") ) {
    function import_message() {
        if ( !empty( Core\Session::data("import_message") ) ) {
            echo '<span class="text-white p-3 bg-blue-400 rounded">' .  Core\Session::flash("import_message") . '</span>';
        }
    }
}