<?php 

    namespace Config;

    define("ROOT", dirname(__DIR__) . "/");
    define("FRONT_ROOT", "/LabIV/MoviePass/");
    define("VIEWS_PATH", "Views/");
    define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "css/");
    define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js/");

    define("TMDb_KEY", "api_key=a2c8cc87dc896f37eb6ca3258529f6d5");

    define("DB_HOST", "localhost");
    define("DB_NAME", "MoviePassDB");
    define("DB_USER", "root");
    define("DB_PASS", "");

?>