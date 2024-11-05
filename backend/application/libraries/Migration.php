<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyMigrate {
    protected $CI;
    protected $migrations_path;

    public function __construct() {
        // Get the CodeIgniter instance
        $this->CI =& get_instance();
        $this->migrations_path = APPPATH . 'migrations/';
    }

    public function latest() {
        $migrations = $this->get_migrations();
        if (empty($migrations)) {
            echo "No migrations found.";
            return;
        }

        foreach ($migrations as $migration) {
            include $this->migrations_path . $migration;
            $class_name = str_replace('.php', '', $migration);
            if (class_exists($class_name)) {
                $instance = new $class_name();
                if (method_exists($instance, 'up')) {
                    // Use the CI database object from the instance
                    $instance->up($this->CI->db); 
                }
            }
        }
    }

    protected function get_migrations() {
        return array_filter(scandir($this->migrations_path), function ($file) {
            return preg_match('/\.php$/', $file);
        });
    }
}
