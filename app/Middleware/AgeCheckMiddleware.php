<?php
namespace App\Middleware;

// AgeCheckMiddleware.php
class AgeCheckMiddleware {
    public function handle($requestUri) {
        // Simulate user's age (you should replace this with your actual logic)
        $age = 25;

        // Check the age and redirect accordingly
        if ($age < 18) {
            // If user is under 18, redirect to a 'minor' route
            header("Location: /minor");
            exit();
        } else {
            // If user is 18 or older, redirect to an 'adult' route
            header("Location: /adult");
            exit();
        }
    }
}
