<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function get_json_input() {
    $inputJSON = file_get_contents('php://input');
    return json_decode($inputJSON, true);
}