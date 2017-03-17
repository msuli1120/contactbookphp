<?php
  class Contact {

    private $name;
    private $company;
    private $relation;
    private $mobile;
    private $email;
    private $address;
    private $group;

    function __construct ($name, $company, $relation, $mobile, $email, $address, $group) {
      $this->name = $name;
      $this->company = $company;
      $this->relation = $relation;
      $this->mobile = $mobile;
      $this->email = $email;
      $this->address = $address;
      $this->group = $group;
    }

    function setName ($new_name) {
      $this->name = (string) $new_name;
    }

    function getName () {
      return $this->name;
    }

    function setCompany($new_company) {
      $this->company = (string) $new_company;
    }

    function getCompany () {
      return $this->company;
    }

    function setRelation ($new_relation) {
      $this->relation = (string) $new_relation;
    }

    function getRelation () {
      return $this->relation;
    }

    function setMobile ($new_mobile) {
      $this->mobile = (string) $new_mobile;
    }

    function getMobile () {
      return $this->mobile;
    }

    function setEmail ($new_email) {
      $this->email = (string) $new_email;
    }

    function getEmail () {
      return $this->email;
    }

    function setAddress ($new_address) {
      $this->address = (string) $new_address;
    }

    function getAddress () {
      return $this->address;
    }

    function setGroup ($new_group) {
      $this->group = (string) $new_group;
    }

    function getGroup () {
      return $this->group;
    }

    function saveContact (){
      array_push($_SESSION['list_of_contacts'], $this);
    }


    static function getContactList () {
      return $_SESSION['list_of_contacts'];
    }


    static function delete () {
      session_destroy();
    }

  }
?>
