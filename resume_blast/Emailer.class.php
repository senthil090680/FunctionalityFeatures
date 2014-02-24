<?php
class Emailer{
	
	/*protected Methods*/
	protected $to,$from,$sender,$subject,$text,$html,$cc,$bcc;
		
	/*Attachments Holder*/
	protected $attachments = array();
	
	/*Public Variables*/
	public $charset = 'utf-8';
	public $eol = "\r\n";
	
	/*Constructor*/
	public function __construct(){
		/*null*/
	}
	
	//Setters
	public function set_to($to){$this->to = $to;}
	public function set_from($from){$this->from = $from;}
	public function set_useremail($set_useremail){$this->set_useremail = $set_useremail;}
	public function set_sender($sender){$this->sender = $sender;}
  	public function set_subject($subject){$this->subject = $subject;}
	public function set_text($text){$this->text = $text;}
  	public function set_html($html){$this->html = $html;}
	public function set_cc($cc){$this->cc = $cc;}	
	public function set_bcc($bcc){$this->bcc = $bcc;}	
	
	
	
	//Adders
	public function add_attachments($attachment){
		//Check if input is an array or string
		if(!is_array($attachment)){
			$attachment = array($attachment);
		}
		$this->attachments = array_merge($this->attachments, $attachment);
	}
	
	//Send mail
	public function send(){
		//Check Variables are set
		if(!$this->to){
			trigger_error('To required (Use set_to() to set this)!',E_USER_ERROR);
		}
		/*if(!empty($cc))
		{
			if(!$this->cc){
				trigger_error('To required (Use set_cc() to set this)!',E_USER_ERROR);
			}
		}*/
		if(!$this->from) {
			trigger_error('From required! (Use set_from() to set this)',E_USER_ERROR);
		}
		if(!$this->sender){
			trigger_error('Sender required! (Use set_sender() to set this)',E_USER_ERROR);
		}
		if(!$this->subject){
			trigger_error('Subject required! (Use set_subject() to set this)',E_USER_ERROR);
		}
		if((!$this->text) && (!$this->html)){
			trigger_error('Message required! (Use set_text() OR set_html() to fix this)',E_USER_ERROR);
		}
		
		//Check for multiple emails within the the send to var.
		$this->to = (is_array($this->to) ? implode(',', $this->to) : $this->to);
		$this->bcc = (is_array($this->bcc) ? implode(',', $this->bcc) : $this->bcc);		
		$this->cc = (is_array($this->cc) ? implode(',', $this->cc) : $this->cc);		
		
		
		//Start compiling the email
		$this->boundary = '----=_NextPart_' . md5(rand());
		$this->headers = '';
		$this->message = '';
		
		//Do top headers
		$this->headers .= 'From: ' . $this->sender . '' . $this->from . '' . $this->eol;		
		$this->headers .= 'Cc: ' . $this->cc . $this->eol;
		$this->headers .= 'Bcc: ' . $this->bcc . $this->eol;		
		$this->headers .= 'Reply-To: ' . $this->sender . '' . $this->from . '' . $this->eol;
		$this->headers .= 'Return-Path: ' . $this->useremail . $this->eol;
		$this->headers .= 'X-Mailer: PHP/' . phpversion() . $this->eol;
		$this->headers .= 'MIME-Version: 1.0' . $this->eol;
		$this->headers .= 'Content-Type: multipart/mixed; boundary="' . $this->boundary . '"' . $this->eol;
		
		if(!$this->html){
			//Text Only
			$this->message  = '--' . $this->boundary . $this->eol;  
			$this->message .= 'Content-Type: text/plain; charset="' . $this->charset . '"' . $this->eol; 
			$this->message .= 'Content-Transfer-Encoding: base64' . $this->eol . $this->eol;
			$this->message .= chunk_split(base64_encode($this->text));
		}
		else{
	  		$this->message  = '--' . $this->boundary . $this->eol;
	  		$this->message .= 'Content-Type: multipart/alternative; boundary="' . $this->boundary . '_alt"' . $this->eol . $this->eol;
	  		$this->message .= '--' . $this->boundary . '_alt' . $this->eol;
	  		$this->message .= 'Content-Type: text/plain; charset="' . $this->charset . '"' . $this->eol; 
	  		$this->message .= 'Content-Transfer-Encoding: base64' . $this->eol;	  
			if($this->text){
				$this->message .= chunk_split(base64_encode($this->text));
			}else{
				$this->message .= chunk_split(base64_encode('This E-Mail contains HTML but your email client does not support HTML'));
      		}	  
	  		$this->message .= '--' . $this->boundary . '_alt' . $this->eol;
      		$this->message .= 'Content-Type: text/html; charset="' . $this->charset . '"' . $this->eol; 
      		$this->message .= 'Content-Transfer-Encoding: base64' . $this->eol . $this->eol;
	  		$this->message .= chunk_split(base64_encode($this->html)); 
			$this->message .= '--' . $this->boundary . '_alt--' . $this->eol; 
		}
		
		//Lets do some attachments
		foreach ($this->attachments as $attachment){
			$filename = basename($attachment);
			echo "<br>Root ".$_SERVER['DOCUMENT_ROOT'];
			//echo "<br>dir ".$dir = dirname(__FILE__,"../");

			//echo "<br>Attach ".$attachment;
			echo "<br>Path ".$path = realpath('/home/email3se/public_html/'.$attachment);
			echo "<br>Attachment ".$attach = str_replace("..","",$attachment);
			//echo "<br>Link ".'www.jobtardis.in'.$attach;
			//echo "<br>dir ".$dir = $_SERVER['DOCUMENT_ROOT'].'/blastres/'.$filename;
			echo "<br>dir ".$dir = 'blastres/'.$filename;
			//echo "<br>Filepath ".$pa = $dir.$attach;
			$attachment = $dir;
			if(!file_exists($dir)){
				trigger_error("Attachment <{$filename}> does not exists!",E_USER_ERROR);
			}
			
			//Continue to Fopen->Fread->Fclose
			$handle = fopen($dir, 'r');
			$content = fread($handle, filesize($attachment));			
			//echo "<pre>";print_r($content);exit;
			fclose($handle);
			
			$this->message .= '--' . $this->boundary . $this->eol;
			$this->message .= 'Content-Type: application/octetstream' . $this->eol;
			$this->message .= 'Content-Transfer-Encoding: base64' . $this->eol;
			$this->message .= 'Content-Disposition: attachment; filename="' . $filename . '"' . $this->eol;
			$this->message .= 'Content-ID: <' . $filename . '>' . $this->eol . $this->eol;
			$this->message .= chunk_split(base64_encode($content));
		}

		//Now lets send the mail via PHPMAIL
		ini_set('sendmail_from', $this->from);
		$sent = mail($this->to, $this->subject, $this->message, $this->headers);
		return ($sent ? true : false);
		
		/*
		*** SMTP sender instead of mail() may be created here depending on how many users wish for it.
		*/
	}
}
?>