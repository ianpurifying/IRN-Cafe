<?php
class RouteController {
    public function checkouts() {
        include PAGE_PATH . 'Checkouts.php';
    }
    
    public function sales() {
        include PAGE_PATH . 'Sales.php';
    }

    public function menu() {
        include PAGE_PATH . 'Menu.php';
    }

    public function users() {
        include PAGE_PATH . 'Users.php';
    }
    
}
