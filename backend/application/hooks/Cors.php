<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cors {
    public function enableCors() {
        // Set CORS headers
        header("Access-Control-Allow-Origin: *"); // Or replace * with your frontend URL, like http://localhost:3000
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

        // Handle preflight (OPTIONS) request
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            header("HTTP/1.1 200 OK");
            exit;  // Stop further execution for OPTIONS requests
        }
    }
}
