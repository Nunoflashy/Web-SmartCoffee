<?php
if(!class_exists("MessageBox")) {
    class MessageBox {
        private $msgTitle   = null;
        private $msgBody    = null;
        private $okAction   = null;
        private $yesAction  = null;
        private $noAction   = null;
        private $msgBoxType = null;

        private function __construct() {}

        static function InfoMessage($title, $body, $okAction) {
            $msg = new self();
            $msg->msgTitle      = $title;
            $msg->msgBody       = $body;
            $msg->okAction      = $okAction;
            $msg->msgBoxType    = __FUNCTION__;
            return $msg;
        }

        static function PromptMessage($title, $body, $yesAction, $noAction) {
            $msg = new self();
            $msg->msgTitle      = $title;
            $msg->msgBody       = $body;
            $msg->yesAction     = $yesAction;
            $msg->noAction      = $noAction;
            $msg->msgBoxType    = __FUNCTION__;
            return $msg;
        }

        private function isValid() {
            $title      = $this->msgTitle;
            $body       = $this->msgBody;
            $okAction   = $this->okAction;
            $yesAction  = $this->yesAction;
            $noAction   = $this->noAction;
            $msgBoxType = $this->msgBoxType;

            switch($this->msgBoxType) {
                case "InfoMessage": {
                    if(!$title || !$body || !$okAction || !$msgBoxType) return false;
                } break;
                
                case "PromptMessage": {
                    if(!$title || !$body || !$yesAction || !$noAction || !$msgBoxType) return false;
                } break;
            }
            return true;
        }

        function show() {
            if(!$this->isValid()) {
                die("Invalid MessageBox call, check that you assigned every property!");
            }
            switch($this->msgBoxType) {
                case "InfoMessage": 
                    header("location: messageInfo.php?msg_title=$this->msgTitle&msg_body=$this->msgBody&ok_callback=$this->okAction#modal");
                break;
                case "PromptMessage":
                    header("location: messageBoxYesNo.php?msg_title=$this->msgTitle&msg_body=$this->msgBody&yes_callback=$this->yesAction&no_callback=$this->noAction#modal");
                break;
            }
            
        }
    }
}
?>