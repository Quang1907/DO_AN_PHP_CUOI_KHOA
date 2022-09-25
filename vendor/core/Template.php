<?php

namespace Core;

class Template
{
    private $__content;
    public function __construct($content = "", $data = [])
    {
        extract($data);
        $this->__content = $content;
        $this->extends();
        $this->include();
        $this->session();
        $this->php();
        $this->printEntities();
        $this->printRaw();
        $this->ifCondition();
        $this->whileLoop();
        $this->foreachLoop();
        $this->forLoop();
        Session::delete("callback");
        $this->csrf();
        eval("?>$this->__content<?php");
    }


    public function extends()
    {
        $pattern = "~@extends\s*\(\"*'*(.+?)\"*'*\)~is";
        preg_match_all($pattern, $this->__content, $matches);
        if (!empty($matches[1])) {
            foreach ($matches[1] as $key => $view) {
                $contentView = "";
                $pathView = _DIR_ROOT . "resources/views/$view.php";
                if (file_exists($pathView)) {
                    $contentView = file_get_contents($pathView);
                } else {
                    Error::render(["error" => "@extends($view) => Khong tim thay view $pathView"]);
                    die();
                }
                $this->__content = str_replace($matches[0][$key], $contentView, $this->__content);
            }
        }
    }

    public function include()
    {
        $pattern = "~@include\s*\(\"*'*(.+?)\"*'*\)~is";
        preg_match_all($pattern, $this->__content, $matches);
        if (!empty($matches[1])) {
            foreach ($matches[1] as $key => $view) {
                $contentView = "";
                $pathView = _DIR_ROOT . "resources/views/$view.php";
                if (file_exists($pathView)) {
                    $contentView = file_get_contents($pathView);
                } else {
                    Error::render(["error" => "@include($view) => Khong tim thay view $pathView"]);
                    die();
                }
                $this->__content = str_replace($matches[0][$key], $contentView, $this->__content);
            }
        }
        if (strpos($this->__content, "@include")) {
            $this->include();
        }
    }

    public function session()
    {
        $pattern = "~@session\(\"*'*(.+?)\"*'*,\s*\"*'*(.+?)\"*'*\)~";
        preg_match_all($pattern, $this->__content, $matches);
        if (!empty($matches[1])) {
            foreach ($matches[1] as $key => $value) {
                if (!empty($matches[1]) && !empty($matches[2])) {
                    $this->__content = preg_replace("~@yield\(\"*'*($value)\"*'*\)~", $matches[2][$key], $this->__content);
                }
                $this->__content = str_replace($matches[0][$key], "", $this->__content);
            }
        }

        $pattern = "~@session\s*\(\"*'*(.+?)\"*'*\)(.+?)@endsession~is";
        preg_match_all($pattern, $this->__content, $matches);
        if (!empty($matches[1])) {
            foreach ($matches[1] as $key => $session) {
                if (!empty($matches[2][$key])) {
                    $this->__content = preg_replace("~@yield\(\"*'*($session)\"*'*\)~", $matches[2][$key], $this->__content);
                }
                $this->__content = str_replace($matches[0][$key], "", $this->__content);
            }
        }

        $pattern = "~@yield\(\s*\"*'*(.+?)\s*\"*'*\)~is";
        preg_match_all($pattern, $this->__content, $matches);

        if (!empty($matches[1])) {
            foreach ($matches[1] as $key => $yield) {
                $this->__content = preg_replace("~@yield\(\"*'*($yield)\"*'*\)~", "", $this->__content);
            }
        }

        if (strpos($this->__content, "@session")) {
            $this->session();
        }
    }

    public function php()
    {
        $pattern = "~@php\(\"*'*(.+?)\"*'*,(.+?)\)~is";
        preg_match_all($pattern, $this->__content, $matches);
        if (!empty($matches[1])) {
            foreach ($matches[1] as $key => $value) {
                if (!empty($matches[1]) && !empty($matches[2])) {
                    $value = "$" . trim($value, "$");
                    $this->__content = str_replace($matches[0][$key], "<?php " . $value . " = " . $matches[2][$key] . " ?>", $this->__content);
                }
            }
        }

        $pattern = "~@php~is";
        preg_match_all($pattern, $this->__content, $matches);
        if (!empty($matches[0])) {
            $this->__content = str_replace($matches[0], "<?php", $this->__content);
        }

        $pattern = "~@endphp~is";
        preg_match_all($pattern, $this->__content, $matches);
        if (!empty($matches[0])) {
            $this->__content = str_replace($matches[0], "?>", $this->__content);
        }
    }

    public function  printEntities()
    {
        $pattern = "~{!\s*(.+?)\s*!}~is";
        preg_match_all($pattern, $this->__content, $matches);
        if (!empty($matches[1])) {
            foreach ($matches[1] as $key => $value) {
                $this->__content = str_replace($matches[0][$key], "<?= htmlentities($value); ?>", $this->__content);
            }
        }
    }

    public function  printRaw()
    {
        $pattern = "~{{\s*(.+?)\s*}}~is";
        preg_match_all($pattern, $this->__content, $matches);
        if (!empty($matches[1])) {
            foreach ($matches[1] as $key => $value) {
                $this->__content = str_replace($matches[0][$key], "<?=  $value ?>", $this->__content);
            }
        }
    }

    public function ifCondition()
    {
        $pattern = "~@if\s*\((.+?)\s*\)\s*$~im";
        preg_match_all($pattern, $this->__content, $matches);
        if (!empty($matches[1])) {
            foreach ($matches[1] as $key => $value) {
                $this->__content = str_replace($matches[0][$key], "<?php if($value): ?>", $this->__content);
            }
        }

        $pattern = "~@elseif\s*\((.+?)\)~is";
        preg_match_all($pattern, $this->__content, $matches);
        if (!empty($matches[1])) {
            foreach ($matches[1] as $key => $value) {
                $this->__content = str_replace($matches[0][$key], "<?php elseif($value): ?>", $this->__content);
            }
        }

        $pattern = "~@else~is";
        preg_match_all($pattern, $this->__content, $matches);
        if (!empty($matches[0])) {
            foreach ($matches[0] as $key => $value) {
                $this->__content = str_replace($matches[0][$key], "<?php else: ?>", $this->__content);
            }
        }

        $pattern = "~@endif~is";
        preg_match_all($pattern, $this->__content, $matches);
        if (!empty($matches[0])) {
            foreach ($matches[0] as $key => $value) {
                $this->__content = str_replace($matches[0][$key], "<?php endif; ?>", $this->__content);
            }
        }
    }

    public function whileLoop()
    {
        $pattern = "~@while\s*\((.+?)\)~is";
        preg_match_all($pattern, $this->__content, $matches);
        if (!empty($matches[1])) {
            foreach ($matches[1] as $key => $value) {
                $this->__content = str_replace($matches[0][$key], "<?php while($value): ?>", $this->__content);
            }
        }

        $pattern = "~@endwhile~is";
        preg_match_all($pattern, $this->__content, $matches);
        if (!empty($matches[0])) {
            foreach ($matches[0] as $key => $value) {
                $this->__content = str_replace($matches[0][$key], "<?php endwhile; ?>", $this->__content);
            }
        }
    }

    public function forLoop()
    {
        $pattern = "~@for\s*\((.+?)\)~is";
        preg_match_all($pattern, $this->__content, $matches);
        if (!empty($matches[1])) {
            foreach ($matches[1] as $key => $value) {
                $this->__content = str_replace($matches[0][$key], "<?php for($value): ?>", $this->__content);
            }
        }

        $pattern = "~@endfor~is";
        preg_match_all($pattern, $this->__content, $matches);
        if (!empty($matches[0])) {
            foreach ($matches[0] as $key => $value) {
                $this->__content = str_replace($matches[0][$key], "<?php endfor; ?>", $this->__content);
            }
        }
    }

    public function foreachLoop()
    {
        $pattern = "~@foreach\s*\((.+?)\)~is";
        preg_match_all($pattern, $this->__content, $matches);
        if (!empty($matches[1])) {
            foreach ($matches[1] as $key => $value) {
                $this->__content = str_replace($matches[0][$key], "<?php foreach($value): ?>", $this->__content);
            }
        }

        $pattern = "~@endforeach~is";
        preg_match_all($pattern, $this->__content, $matches);
        if (!empty($matches[0])) {
            foreach ($matches[0] as $key => $value) {
                $this->__content = str_replace($matches[0][$key], "<?php endforeach; ?>", $this->__content);
            }
        }
    }

    public function csrf()
    {
        $pattern = "~@csrf~is";
        preg_match_all($pattern, $this->__content, $matches);
        if (!empty($matches[0])) {
            csrf();
            $this->__content = str_replace($matches[0], "", $this->__content);
        }
    }
}
