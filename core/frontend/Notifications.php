<?php
namespace WPFF\Frontend;

class Notifications {

	/**
	 * Sends an email to notify the author of a new submission.
	 * @param string $to
	 */
	public static function sendEmail($to, $data = null)
	{
		require_once WPFF_DIR . 'core/helpers/EmailTemplateMaker.php';
		require_once WPFF_DIR .'../../../wp-includes/class-phpmailer.php';
		
		$admin_email = get_bloginfo('admin_email');
		$sitename = get_bloginfo('name');

		$mail = new \PHPMailer;
		$mail->From = $admin_email;
		$mail->FromName = $sitename;
		$mail->addAddress($to);
		$mail->Subject = 'New Submission at ' . $sitename;
		$mail->isHTML(true);

		$template = new \EmailTemplateMaker;
		$template = $template->make( WPFF_DIR . 'core/helpers/email/template.php', WPFF_DIR . 'core/helpers/email/template.css', $data );

		$mail->Body = $template;
		$mail->Send();
		return;
	}

}