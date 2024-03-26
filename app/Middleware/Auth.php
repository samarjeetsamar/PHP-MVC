<?php
namespace App\Middleware;

class Auth {

    public function handle($request, $next) {
        // Check if user is authenticated
        if (!$this->isAuthenticated()) {
            // Redirect to login page or show unauthorized error
            // Example: redirect('/login');
            // Example: showUnauthorizedError();
            //return 'Not authenticated!';
            redirect(route('showLoginForm'));
        }

        // User is authenticated, continue with the request
        return $next($request);
    }

    private function isAuthenticated() {
        // Check if user is logged in (you may implement your own logic here)
        return isset($_SESSION['user_id']);
    }

}