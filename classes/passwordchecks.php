<?php

    Class PasswordChecks {

        public function __construct() {}

        public function password_verify($passwordSubmitted, $password) {
            if (password_verify($passwordSubmitted, $password)) {
                session_regenerate_id();
                return true;
            } else {
                echo false;
            }
        }

    }