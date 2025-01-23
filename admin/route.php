<?php
const ROUTES = [
    'checkouts' => 'RouteController@checkouts',
    'sales' => 'RouteController@sales',
    'menu' => 'RouteController@menu',
    'users' => 'RouteController@users',
];

// Route handler
function route($page) {
    if (isset(ROUTES[$page])) {
        [$controller, $method] = explode('@', ROUTES[$page]);
        $controllerFile = __DIR__ . "/controllers/{$controller}.php";

        if (file_exists($controllerFile)) {
            include_once $controllerFile;

            if (class_exists($controller) && method_exists($controller, $method)) {
                (new $controller())->$method();
            } else {
                render404();
            }
        } else {
            render404();
        }
    } else {
        render404();
    }
}

// 404 handler
function render404() {
    include PAGE_PATH . '404.php';
    exit;
}
?>