<?php

class HtmlMail {
    
    private $to;
    private $fromEmail;
    private $fromText;
    private $subject;
    private $message;
    private $headers;
    private $replyTo;
    
    public function SendMail() {
        self::configureHeaders();
        mail($this->to, $this->subject, $this->message, $this->headers);
    }
    
    // Setters
    public function SetTo($to) {
        $this->to = $to;
    }
    
    public function SetFromEmail($fromEmail) {
        // Since the from address is put inside the headers we just add the,
        // from directly in headers here.
        $this->fromEmail = $fromEmail;
    }
    
    public function SetFromText($fromText) {
        // Since the from address is put inside the headers we just add the,
        // from directly in headers here.
        $this->fromText = $fromText;
    }
    
    public function SetSubject($subject) {
        $this->subject = $subject;
    }
    
    public function SetMessage($message) {
        $this->message = $message;
    }
    
    public function SetReplyTo($replyTo) {
        $this->replyTo = $replyTo;
    }
    
    private function configureHeaders() {
        $this->headers = "MIME-Version: 1.0" . "\r\n" . "From: " . $this->fromText . " <" . $this->fromEmail . ">" . "\r\n" . "Reply-To: " . $this->replyTo . "\r\n" . "Content-type: text/html; charset=UTF-8";
    }
}

