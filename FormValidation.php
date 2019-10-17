<?php
/*
  This class will hold a variety of general purpose methods for validating forms.
  The methods will accept inputs as needed and will return true if the values pass the
  validation and false otherwise.
*/
# Author: brvdleyowens;
# Copyright: 2019;

class FormValidation {
  # Properties - Properties to be used within the object

  # Constructor - Initiallizes contents of new object

  public function __construct() {
    // Empty constructor with no defined process - added for completeness.
  }

  # Methods - Functions for validating

    //STRING ONLY - Required Field Validation
  public function validateRequiredStringField($inputValue) {
  if(trim($inputValue) == '' || !strcasecmp($inputValue, "null") || !strcasecmp($inputValue, "undefined") || preg_match('/[^a-zA-Z\d]/', $inputValue)) {
      return false;
    }
    else {
      return true;
    }
  }
  //Required Field - Best for Radios, Checkboxes, etc..
  public function validateRequiredField($inputValue) {
  if($inputValue == '') {
      return false;
    }
    else {
      return true;
    }
  }
  //Required Numeric Validation
  public function validateRequiredNumeric($inputValue) {
    return is_numeric($inputValue);
  }
  //Email Validation
  public function validateEmail($inputValue) {
    if (filter_var($inputValue, FILTER_VALIDATE_EMAIL) != false) {
      return true;
    }
    else {
      return false;
    }
  }

  public function validatePhone($inputValue) {
    if (filter_var($inputValue, FILTER_SANITIZE_NUMBER_INT) != false && preg_match('/^[0-9]{10}+$/', $inputValue)) {
      return true;
    }
    else {
      return false;
    }
  }

  public function characterLimiter($inputValue, $amount) {
    if (strlen($inputValue) < $amount) {
      return true;
    }
    else {
      return false;
    }
  }


}
?>
