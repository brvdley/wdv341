<?php
  class Emailer {
    private $emailMessage;
    private $senderAddress;
    private $recipiantAddress;
    private $emailSubject;
    private $headers;

    public function __construct($recipiantAddress, $senderAddress, $emailSubject, $emailMessage)
        {
            $this->recipiantAddress = $recipiantAddress;
            $this->senderAddress = $senderAddress;
            $this->subject = $emailSubject;
            $this->message = $emailMessage;
            //$this->headers = $this->setHeader();
        }

    public function setMessage($message) {
      $this->emailMessage = $message;
      return $this;
    }
    public function setSubject($subject) {
      return $this->emailSubject = $subject;
    }
    public function setRecipiant($email, $name) {
      return $this->recipiantAddress = $email;
    }
    public function setSender($email, $name) {
      return $this->senderAddress = $email;
    }

    public function getMessage() {
      return $this->emailMessage;
    }
    public function getSubject() {
      return $this->emailSubject;
    }
    public function getRecipiant() {
      return $this->recipiantAddress;
    }

    public function setHeader() {
        $headers = 'From: BrvdleyOwens@gmail.com' . "\r\n" .
            'Reply-To: BrvdleyOwens@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        $this->headers = $headers;
        return $this;
    }

    public function getSender() {
      return $this->senderAddress;
    }

    public function send() {
        $recipiantAddress = $this->recipiantAddress;
        $senderAddress = $this->senderAddress;
        $emailSubject = $this->subject;
        $emailMessage = $this->message;
        $headers = 'From: BrvdleyOwens@gmail.com' . "\r\n" .
            'Reply-To: BrvdleyOwens@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        return mail($recipiantAddress, $emailSubject, $emailMessage, $headers);
    }
  }
?>
