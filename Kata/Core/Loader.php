<?php

namespace Kata\Core;

class Loader {

    public static function autoload($name) {
        require_once(APPLICATION_PATH . '\\' . $name . '.php');
    }

}

spl_autoload_register(__NAMESPACE__ . '\Loader::autoload');