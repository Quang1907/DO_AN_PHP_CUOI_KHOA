<?php

namespace Core;

use ReflectionFunction;

class Route
{
    static private $route = null;
    static private $path = null;
    static private $routeConfig = [];
    static private $routeWhere = [];
    static private $middleware = [];
    static private $middle = [];
    static private $controller = null;
    static private $getPath = null;
    static private $db = null;
    static private $function =  null;
    static private $getMethod =  null;
    static private $group = null;

    public function __construct()
    {
        if (self::$db == null) {
            self::$db = new Database();
        }

        self::$route = $this;

        self::$function = [
            "get" => "index|create|edit|show|delete",
            "post" => "update|store",
        ];
        self::$getMethod = ["edit", "show", "delete", "update"];
    }

    static public function middleware($middleware)
    {
        self::$middleware = $middleware;
        return new static;
    }

    public function loadRoute($name = "web")
    {
        $pathRoute = _DIR_ROOT . "routes/$name.php";
        if (file_exists($pathRoute)) {
            return require_once $pathRoute;
        }
        Error::render(["error" => "Error: khong tim thay cau hinh web route"]);
        die();
    }
    /**
     * phuong thuc get, post
     * ts1 cau hinh duong dan
     * ts2 class handle
     * 
     * cau hinh
     * array[method][path] = callback
     */

    static public function get($path = "", $callback = [])
    {
        self::$path = $path;
        if (!empty(self::$group)) {
            self::$path = self::$group . "/" . $path;
            self::$middle[self::$path] = self::$middleware;
        }
        self::$routeConfig["get"][self::$path] = $callback;
        return self::$route;
    }

    static public function resource($path = "", $callback)
    {
        self::$path = $path;
        if (!empty(self::$group)) {
            self::$path = self::$group . "/" . $path;
            self::$middle[self::$path] = self::$middleware;
        }

        if (empty($path)) {
            self::$path = self::$group;
        }

        $function = self::$function;
        $getMethod = self::$getMethod;

        foreach ($function as $method => $valueItem) {
            $valueArr = explode("|", $valueItem);
            foreach ($valueArr as $value) {
                if ($value == "index") {
                    self::$routeConfig[$method][self::$path] = [$callback, $value];
                }
                if (in_array($value, $getMethod)) {
                    self::$routeConfig[$method][self::$path . "/$value/{id}"] = [$callback, $value];
                } else {
                    self::$routeConfig[$method][self::$path . "/$value"] = [$callback, $value];
                }
            }
        }
        return new static;
    }

    static public function group($group = "", $callback)
    {
        self::$group = $group;
        call_user_func($callback, []);
        return new static;
    }

    static public function post($path = "", $callback = [])
    {
        self::$path = $path;
        if (!empty(self::$group)) {
            self::$path = self::$group . "/" . $path;
            self::$middle[self::$path] = self::$middleware;
        }

        self::$routeConfig["post"][self::$path] = $callback;
        return self::$route;
    }

    public function where($where = [])
    {
        self::$routeWhere[self::$path]  = $where;
    }

    /**
     * quy trinh xu ly route
     * - lay path hien tai
     * - So sanh vs path dc cau hinh
     */

    public function execute()
    {
        $callback = null;
        $checkPath = $this->getParams($params, $callback);

        self::handleRouteMiddleware();
        self::handleGlobalMiddleware();

        if (is_object($callback)) {
            if ($this->isClosures($callback)) {
                self::handleAppService();
            }
        }

        if (is_array($callback)) {
            if (!$this->checkAPI($callback[0]))
                self::handleAppService();
        }

        if ($checkPath) {
            //neu la object => thuc thi
            if (is_object($callback)) {
                return call_user_func_array($callback, []);
            } elseif (is_array($callback)) {
                // neu la array => goi den controller va action tuong ung
                // khoi tao controller
                $controller = new $callback[0]();
                // sua lai cau hinh
                self::$controller = $controller;
                $callback = [$controller, $callback[1]];
                return call_user_func_array($callback, $params);
            }
        }
        // neu khong ton tai thi load loi
        Error::render(["error" => "khong tim thay route tuong ung"]);
    }

    // check API 
    public function checkAPI($routeAPI = "")
    {
        $apiArr = explode("\\", $routeAPI);
        if (count($apiArr) > 1 && in_array("Api", $apiArr) && in_array("Controllers", $apiArr)) {
            return true;
        }
        return false;
    }

    public function isClosures($object)
    {
        return (new ReflectionFunction($object))->isClosure();
    }

    /**
     * ham tra ve 3 gia tri
     * - kiem tra
     * - callback
     * - path
     */

    public function getParams(&$params, &$callback)
    {
        $check = false;
        $method = $this->getMethod();
        $currentPath = $this->getPath();
        if (!empty(self::$routeConfig[$method])) {
            foreach (self::$routeConfig[$method] as $path => $callback) {
                $pattern = "~^$path$~";
                if (!empty(self::$routeWhere[$path])) {
                    foreach (self::$routeWhere[$path] as $paramsName => $pathPattern) {
                        $pattern = str_replace('{' . $paramsName . '}', '(' . $pathPattern . ')', $pattern);
                    }
                } else {
                    $pattern = preg_replace("~{.+?}~", "(.+?)", $pattern);
                }
                preg_match($pattern, $currentPath, $matches);
                if (!empty($matches)) {
                    $check = true;
                    unset($matches[0]);
                    $params = array_values($matches);
                    self::$getPath = $path;
                    break;
                }
            }
        }

        if (!empty(self::$middle)) {
            foreach (self::$middle as $key => $value) {
                if (self::$getPath == trim($key, "/")) {
                    $path = _DIR_ROOT . "app/middlewares/$value.php";
                    if (file_exists($path)) {
                        require_once $path;
                        (new $value)->handle();
                    }
                }
            }
        }

        return $check;
    }

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function getPath()
    {
        return !empty($_SERVER['PATH_INFO']) ? trim($_SERVER['PATH_INFO'], "/") : "/";
    }

    static public function getCurrentController()
    {
        return self::$controller;
    }

    static public function handleRouteMiddleware()
    {
        // autoload app routeMiddleware 
        global $config;
        $url = self::$getPath;
        if (!empty($config['app']['routeMiddleware'])) {
            foreach ($config['app']['routeMiddleware'] as $key => $middlewareItem) {
                $path = _DIR_ROOT . "app/middlewares/$middlewareItem.php";
                if ($url == $key && file_exists($path)) {
                    // if (stristr($url, $key) && file_exists($path)) {
                    require_once $path;
                    $routeObject = new $middlewareItem();
                    if (!empty(self::$db)) {
                        $routeObject->db = self::$db;
                    }
                    $routeObject->handle();
                }
            }
        }
    }

    static public function handleGlobalMiddleware()
    {
        // autoload app globalMiddleware 
        global $config;
        if (!empty($config['app']['globalMiddleware'])) {
            foreach ($config['app']['globalMiddleware'] as $key => $globalItem) {
                $path = _DIR_ROOT . "app/middlewares/$globalItem.php";
                if (file_exists($path)) {
                    require_once $path;
                    $globalObject = new $globalItem();
                    if (!empty(self::$db)) {
                        $globalObject->db = self::$db;
                    }
                    $globalObject->handle();
                }
            }
        }
    }

    static public function handleAppService()
    {
        // autoload app service provider 
        global $config;
        if (!empty($config['app']['boot'])) {
            foreach ($config['app']['boot'] as $key => $bootItem) {
                $path = _DIR_ROOT . "app/core/$bootItem.php";
                if (file_exists($path)) {
                    require_once $path;
                    $bootObject = new $bootItem();
                    if (!empty(self::$db)) {
                        $bootObject->db = self::$db;
                    }
                    $bootObject->boot();
                }
            }
        }
    }
}
