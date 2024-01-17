<?php
    class Persons {
        protected $name;
        protected $phone;
        protected $email;
    
        public function setName($name) {
            $this->name = $name;
        }
    
        public function getName() {
            return $this->name;
        }
    
        public function setPhone($phone) {
            $this->phone = $phone;
        }
    
        public function getPhone() {
            return $this->phone;
        }
    
        public function setEmail($email) {
            $this->email = $email;
        }
    
        public function getEmail() {
            return $this->email;
        }
    }
?>