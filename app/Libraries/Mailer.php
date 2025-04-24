<?php
namespace App\Libraries;  

class Mailer{
	protected $mailer;
	
	public function __construct()
	{
		
		$this->mailer = new PHPMailer(true);
		
	}
	
	public function sendMail($email, $subject, $body )
	{
		
		$AppConfig = new \Config\AppConfig();
		
		try {

			$this->mailer->SMTPDebug = SMTP::DEBUG_OFF;
			
			$this->mailer->isSMTP();
			
			$this->mailer->Host = 'smtp.gmail.com';
			
			$this->mailer->SMTPAuth = true;
			
			$this->mailer->Username = 'votacuong2608@gmail.com';
			
			$this->mailer->Password = $AppConfig->google_app_password;
			
			$this->mailer->SMTPSecure = 'ssl';
			
			$this->mailer->Port = 465;

			$this->mailer->setFrom($AppConfig->mailfrom, 'VI-CMS System');
			
			$this->mailer->addAddress($email, 'VI-CMS System');			

			$this->mailer->isHTML(true);
			
			$this->mailer->Subject = $subject;
			
			$this->mailer->Body = $body;

			$this->mailer->send();
			
		} catch (Exception $e) {
			
			echo 'Message could not be sent. Mailer Error: ', $this->mailer->ErrorInfo;
			
		}

	}
}