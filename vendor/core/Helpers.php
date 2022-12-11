<?php

use Core\Response;
use Core\Session;
use Core\View;

$sessionKey = Session::isInvalid();
$old = Session::flash($sessionKey . "_old");
$error = Session::flash($sessionKey . "_error");

if (!function_exists("error")) {
    function error($fieldName = "", $before = "", $after = "")
    {
        global $error;
        if (!empty($error[$fieldName])) {
            if (!empty($before) && !empty($after)) {
                return $before . $error[$fieldName] . $after;
            }
            return "<small id='name' class='text-red-500'>" . $error[$fieldName] . "</small>";
        }
    }
}

if (!function_exists("old")) {
    function old($fieldName = "", $default = "")
    {
        global $old;
        if (!empty($old[$fieldName])) {
            return $old[$fieldName];
        }
        return $default;
    }
}

function put_images($path, $files, &$imagesList)
{
    $error = array();
    $extension = array("jpeg", "jpg", "png", "gif");
    foreach ($files as $key => $tmp_name) {
        $file_name = $_FILES["images"]["name"][$key];
        $file_name = trim($file_name);
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        if (in_array($ext, $extension)) {
            if (!file_exists($path . $file_name)) {
                move_uploaded_file($tmp_name, $path . $file_name);
                $imagesList .= "$file_name, ";
            } else {
                $filename = trim(basename($file_name, $ext), ".");
                $newFileName = $filename . "-" . time() . "." . $ext;
                move_uploaded_file($tmp_name, $path . $newFileName);
                $imagesList .= "$newFileName, ";
            }
        } else {
            array_push($error, "$file_name, Không đúng định dạng");
        }
    }
    $imagesList  = rtrim($imagesList, ", ");
    return !empty($error) ? $error : true;
}

function put_image($path, $fileName, &$linkimage)
{
    $error = array();
    $extension = array("jpeg", "jpg", "png", "gif");
    $tmp_name = $fileName["tmp_name"];
    $file_name = $fileName["name"];
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
    if (in_array($ext, $extension)) {
        if (!file_exists($path . $file_name)) {
            move_uploaded_file($tmp_name, $path . $file_name);
            $linkimage .= "$file_name, ";
        } else {
            $filename =  trim(basename($file_name, $ext), ".");
            $newFileName = $filename  . "-" . time() . "." . $ext;
            move_uploaded_file($tmp_name, $path . $newFileName);
            $linkimage .= "$newFileName, ";
        }
    } else {
        array_push($error, "$file_name, Không đúng định dạng");
    }
    $linkimage  = rtrim($linkimage, ", ");
    return !empty($error) ? $error : true;
}


if (!function_exists("response")) {
    function response($data, $httpStatus = 200)
    {
        // $allData = [];
        // array_push($allData, ["status" => $httpStatus, "data" => $data]);
        echo json_encode(["status" => $httpStatus, "data" => $data]);
    }
}

if (!function_exists("asset")) {
    function asset($urlFile = "")
    {
        $path = _DIR_ROOT . "public/" . $urlFile;
        if (file_exists($path)) {
            return _WEB_ROOT . $urlFile;
        }
    }
}

if (!function_exists("view")) {
    function view($name = "", $data = [])
    {
        return View::render($name, $data);
    }
}

if (!function_exists("redirect")) {
    function redirect($redirect = "")
    {
        return Response::redirect($redirect);
    }
}



if (!function_exists("csrf")) {
    function csrf()
    {
        $path = "";
        if (!empty($_SERVER["PATH_INFO"])) {
            $path = $_SERVER['PATH_INFO'];
            $path = trim($path, "/");
        }
        $url = _WEB_ROOT . $path;
        return Session::data("callback", $url);
    }
}

if (!function_exists("route")) {
    function route($url = "", $params = "")
    {
        $url = str_replace(".", "/", $url);
        $route = _WEB_ROOT . "$url";
        if (!empty($params)) {
            $route .= "/$params";
        }
        return $route;
    }
}

if (!function_exists('create_slug')) {
    function create_slug($string = "")
    {
        $search = array(
            '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
            '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
            '#(ì|í|ị|ỉ|ĩ)#',
            '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
            '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
            '#(ỳ|ý|ỵ|ỷ|ỹ)#',
            '#(đ)#',
            '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
            '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
            '#(Ì|Í|Ị|Ỉ|Ĩ)#',
            '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
            '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
            '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
            '#(Đ)#',
            "/[^a-zA-Z0-9\-\_]/",
        );
        $replace = array(
            'a',
            'e',
            'i',
            'o',
            'u',
            'y',
            'd',
            'A',
            'E',
            'I',
            'O',
            'U',
            'Y',
            'D',
            '-',
        );
        $string = preg_replace($search, $replace, $string);
        $string = preg_replace('/(-)+/', '-', $string);
        $string = strtolower($string);
        return $string;
    }
}

if (!function_exists("env")) {
    function env($env)
    {
        return $_ENV[$env];
    }
}
