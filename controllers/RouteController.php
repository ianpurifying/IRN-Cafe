<?php
class RouteController {
    public function home() {
        include PAGE_PATH . 'home.php';
    }
    
    public function about() {
        include PAGE_PATH . 'about.php';
    }

    public function contact() {
        include PAGE_PATH . 'contact.php';
    }

    public function account() {
        include PAGE_PATH . 'account.php';
    }
    
    public function cart() {
        include PAGE_PATH . 'cart.php';
    }

    public function login() {
        include PAGE_PATH . 'login.php';
    }

    public function register() {
        include PAGE_PATH . 'registration.php';
    }

    public function confirm() {
        include PAGE_PATH . 'confirmation.php';
    }

    public function history() {
        include PAGE_PATH . 'history.php';
    }

    public function menu() {
        include PAGE_PATH . 'menu.php';
    }

}
