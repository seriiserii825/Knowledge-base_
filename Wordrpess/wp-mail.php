<?php
function true_localize_example()
{
	wp_enqueue_script('truescript', get_template_directory_uri() . '/vue/topcare/ajax.js', [], null, false);
	wp_localize_script('truescript', 'true_object', array(
		'ajax_url' => admin_url('admin-ajax.php'),
		'nonce'    => wp_create_nonce('feedback-nonce'),
	));
}
add_action('wp_enqueue_scripts', 'true_localize_example');
add_action('wp_ajax_topcare', 'ajax_form');
add_action('wp_ajax_nopriv_topcare', 'ajax_form');
function ajax_form()
{
	if (!wp_verify_nonce($_POST['nonce'], 'feedback-nonce')) {
		wp_die('Data was recieved from another address');
	}
	if (!empty($_POST['checkField'])) {
		wp_die('This is a spam');
	}

	// die(json_encode(array('type' => 'files', 'text' => $_FILES)));
	//f.cioni@altuofianco.it
	// assurance@altuofianco.it
	// $mail_to                        = "sergiu@bludelego.it";
	// $mail_to                        = "seriiburduja@gmail.com";
	//	$mail_to                        = "f.cioni@altuofianco.it";
	$mail_to                        = "assurance@altuofianco.it";
	$request                        = $_REQUEST;
	$verificationInput              = sanitize_text_field($_REQUEST['partita_iva']);
	$validationToken                = sanitize_text_field($_REQUEST['validationToken']);
	$socialRegion                   = sanitize_text_field($_REQUEST['socialRegion']);
	$contactPerson                  = sanitize_text_field($_REQUEST['contactPerson']);
	$personPhone                    = sanitize_text_field($_REQUEST['personPhone']);
	$personEmail                    = sanitize_email($_REQUEST['personEmail']);
	$company_name                   = sanitize_text_field($_REQUEST['company_name']);
	$result                         = sanitize_text_field($_REQUEST['result']);
	$response_text                  = sanitize_text_field($_REQUEST['response_text']);
	$topcareYearNumber              = !empty($_REQUEST['topcareYearNumber']) ? sanitize_text_field($_REQUEST['topcareYearNumber']) : '';
	$phoneTextareaNumbers           = !empty($_REQUEST['phoneTextareaNumbers']) ? sanitize_textarea_field($_REQUEST['phoneTextareaNumbers']) : '';
	$selectPhone                    = !empty($_REQUEST['selectPhone']) ? sanitize_text_field($_REQUEST['selectPhone']) : '';
	$selectPhoneAnotherNumberInput  = !empty($_REQUEST['selectPhoneAnotherNumberInput']) ? sanitize_text_field($_REQUEST['selectPhoneAnotherNumberInput']) : '';
	$phoneNote                      = !empty($_REQUEST['phoneNote']) ? sanitize_textarea_field($_REQUEST['phoneNote']) : '';
	$selectNet                      = !empty($_REQUEST['selectNet']) ? sanitize_text_field($_REQUEST['selectNet']) : '';
	$netNote                        = !empty($_REQUEST['netNote']) ? sanitize_textarea_field($_REQUEST['netNote']) : '';
	$selectMobile                   = !empty($_REQUEST['selectMobile']) ? sanitize_text_field($_REQUEST['selectMobile']) : '';
	$mobileTextareaNumbers          = !empty($_REQUEST['mobileTextareaNumbers']) ? sanitize_textarea_field($_REQUEST['mobileTextareaNumbers']) : '';
	$selectMobileAnotherNumberInput = !empty($_REQUEST['selectMobileAnotherNumberInput']) ? sanitize_text_field($_REQUEST['selectMobileAnotherNumberInput']) : '';
	$mobileNote                     = !empty($_REQUEST['mobileNote']) ? sanitize_text_field($_REQUEST['mobileNote']) : '';
	$administration_desc                     = !empty($_REQUEST['administration_desc']) ? sanitize_text_field($_REQUEST['administration_desc']) : '';
	$administrator_file                     = !empty($_FILES['administrator_file']) ? sanitize_text_field($_FILES['administrator_file']) : '';

	// $administrator_file = json_encode($administrator_file);
	$userMessage                    = "";
	$userMessage                    = "<p>Abbiamo ricevuto la sua segnalazione riportata qui sotto e provvederemo al più presto a prenderla in carico</p><br><br>";
	$userMessage                    .= "
	<table style='border-collapse: collapse;'>
		<tr>
			<td style='padding: 10px; border: 1px solid #ccc;'><strong>Partita IVA: </strong></td>
			<td style='padding: 10px; border: 1px solid #ccc;'>${verificationInput}</td>
		</tr>
		<tr>
			<td style='padding: 10px; border: 1px solid #ccc;'><strong>Ragione Sociale:</strong></td>
			<td style='padding: 10px; border: 1px solid #ccc;'>${socialRegion}</td>
		</tr>
		<tr>
			<td style='padding: 10px; border: 1px solid #ccc;'><strong>Nominativo del Referente:</strong></td>
			<td style='padding: 10px; border: 1px solid #ccc;'>${contactPerson}</td>
		</tr>
		<tr>
			<td style='padding: 10px; border: 1px solid #ccc;'><strong>Telefono del Referente:</strong></td>
			<td style='padding: 10px; border: 1px solid #ccc;'>${personPhone}</td>
		</tr>
		<tr>
			<td style='padding: 10px; border: 1px solid #ccc;'><strong>Email del referente:</strong></td>
			<td style='padding: 10px; border: 1px solid #ccc;'>${personEmail}</td>
		</tr>
	</table>
	<br>
	";
	if (!empty($topcareYearNumber)) {
		$userMessage .= "
		<table style='border-collapse: collapse;'>
			<tr>
				<td  style='padding: 10px; border: 1px solid #ccc;'>Hai aperto una segnalazione con il 1928?:</td>
				<td  style='padding: 10px; border: 1px solid #ccc;'><strong>${topcareYearNumber}</strong></td>
			</tr>
		</table>
		<br>
		";
	}
	//
	if (!empty($phoneTextareaNumbers)) {
		$userMessage .= "<h2>Segnalazione disservizio fonia (rete fissa)</h2>
		<table style='border-collapse: collapse;'> ";
		if (!empty($selectPhone)) {
			$userMessage .= "<tr> <td style='padding: 10px; border: 1px solid #ccc;'>Problematica riscontrata:</td> <td style='padding: 10px; border: 1px solid #ccc;'> <strong>${selectPhone}</strong></td></tr>";
		}
		if (!empty($phoneTextareaNumbers)) {
			$userMessage .= "<tr><td style='padding: 10px; border: 1px solid #ccc;'>Numerazioni per cui si riscontra il disservizio:</td><td style='padding: 10px; border: 1px solid #ccc;'><strong>${phoneTextareaNumbers}</strong></td></tr>";
		}
		if (!empty($selectPhoneAnotherNumberInput)) {
			$userMessage .= "<tr><td style='padding: 10px; border: 1px solid #ccc;'>Indica il numero (fisso o cellulare) che riceverà le chiamate durante questo periodo:</td><td style='padding: 10px; border: 1px solid #ccc;'> <strong>${selectPhoneAnotherNumberInput}</strong></td></tr>";
		}
		if (!empty($phoneNote)) {
			$userMessage .= "<tr><td style='padding: 10px; border: 1px solid #ccc;'>Note:</td><td style='padding: 10px; border: 1px solid #ccc;'> <strong>${phoneNote}</strong></td></tr>";
		}
	}
	$userMessage .= "</table>";
	if (!empty($netNote)) {
		$userMessage .= "<h2>Segnalazione disservizio rete internet</h2><table  style='border-collapse: collapse;'>";
		$userMessage .= "<tr><td style='padding: 10px; border: 1px solid #ccc;'>Problematica riscontrata: </td><td style='padding: 10px; border: 1px solid #ccc;'><strong>${selectNet}</strong></td></tr>";
		$userMessage .= "<tr><td style='padding: 10px; border: 1px solid #ccc;'>Note:</td><td style='padding: 10px; border: 1px solid #ccc;'><strong>${netNote}</strong></td></tr></table>";
	}
	if (!empty($mobileTextareaNumbers)) {
		$userMessage .= "<h2>Segnalazione disservizio rete mobile</h2> <table  style='border-collapse: collapse;'>";
		if (!empty($selectMobile)) {
			$userMessage .= "<tr><td style='padding: 10px; border: 1px solid #ccc;'>Problematica riscontrata:</td><td style='padding: 10px; border: 1px solid #ccc;'> <strong>${selectMobile}</strong></td></tr>";
		}
		if (!empty($mobileTextareaNumbers)) {
			$userMessage .= "<tr><td style='padding: 10px; border: 1px solid #ccc;'>Numerazioni per cui si riscontra il disservizio:</td><td style='padding: 10px; border: 1px solid #ccc;'><strong>${mobileTextareaNumbers}</strong></td></tr>";
		}
		if (!empty($selectMobileAnotherNumberInput)) {
			$userMessage .= "<tr><td style='padding: 10px; border: 1px solid #ccc;'>Indica il numero (mobile) che riceverà le chiamate durante questo periodo:</td><td style='padding: 10px; border: 1px solid #ccc;'><strong>${selectMobileAnotherNumberInput}</strong></td></tr>";
		}
		if (!empty($mobileNote)) {
			$userMessage .= "<tr><td style='padding: 10px; border: 1px solid #ccc;'>Note:</td><td style='padding: 10px; border: 1px solid #ccc;'><strong>${mobileNote}</strong></td></tr>";
		}
		$userMessage .= "</table><br><br>";
	}
	$userMessage .= "<p><em>Servizio assistenza TopCare Altuofianco</em></p>";
	//======================================================
	$clientMessage = "";
	$clientMessage .= "<p>Ecco una copia della richiesta pervenuta</p><br>";
	$clientMessage .= "
	<table style='border-collapse: collapse;'>
		<tr>
			<td style='padding: 10px; border: 1px solid #ccc;'><strong>Partita IVA: </strong></td>
			<td style='padding: 10px; border: 1px solid #ccc;'>${verificationInput}</td>
		</tr>
		<tr>
			<td style='padding: 10px; border: 1px solid #ccc;'><strong>Ragione Sociale:</strong></td>
			<td style='padding: 10px; border: 1px solid #ccc;'>${socialRegion}</td>
		</tr>
		<tr>
			<td style='padding: 10px; border: 1px solid #ccc;'><strong>Nominativo del Referente:</strong></td>
			<td style='padding: 10px; border: 1px solid #ccc;'>${contactPerson}</td>
		</tr>
		<tr>
			<td style='padding: 10px; border: 1px solid #ccc;'><strong>Telefono del Referente:</strong></td>
			<td style='padding: 10px; border: 1px solid #ccc;'>${personPhone}</td>
		</tr>
		<tr>
			<td style='padding: 10px; border: 1px solid #ccc;'><strong>Email del referente:</strong></td>
			<td style='padding: 10px; border: 1px solid #ccc;'>${personEmail}</td>
		</tr>
	</table>
	<br>
	";
	if (!empty($topcareYearNumber)) {
		$clientMessage .= "
		<table style='border-collapse: collapse;'>
			<tr>
				<td  style='padding: 10px; border: 1px solid #ccc;'>Hai aperto una segnalazione con il 1928?:</td>
				<td  style='padding: 10px; border: 1px solid #ccc;'><strong>${topcareYearNumber}</strong></td>
			</tr>
		</table>
		<br>
		";
	}
	//
	if (!empty($phoneTextareaNumbers)) {
		$clientMessage .= "<h2>Segnalazione disservizio fonia (rete fissa)</h2>
		<table style='border-collapse: collapse;'> ";
		if (!empty($selectPhone)) {
			$clientMessage .= "<tr> <td style='padding: 10px; border: 1px solid #ccc;'>Problematica riscontrata:</td> <td style='padding: 10px; border: 1px solid #ccc;'> <strong>${selectPhone}</strong></td></tr>";
		}
		if (!empty($phoneTextareaNumbers)) {
			$clientMessage .= "<tr><td style='padding: 10px; border: 1px solid #ccc;'>Numerazioni per cui si riscontra il disservizio:</td><td style='padding: 10px; border: 1px solid #ccc;'><strong>${phoneTextareaNumbers}</strong></td></tr>";
		}
		if (!empty($selectPhoneAnotherNumberInput)) {
			$clientMessage .= "<tr><td style='padding: 10px; border: 1px solid #ccc;'>Indica il numero (fisso o cellulare) che riceverà le chiamate durante questo periodo:</td><td style='padding: 10px; border: 1px solid #ccc;'> <strong>${selectPhoneAnotherNumberInput}</strong></td></tr>";
		}
		if (!empty($phoneNote)) {
			$clientMessage .= "<tr><td style='padding: 10px; border: 1px solid #ccc;'>Note:</td><td style='padding: 10px; border: 1px solid #ccc;'> <strong>${phoneNote}</strong></td></tr>";
		}
	}
	$clientMessage .= "</table>";
	if (!empty($netNote)) {
		$clientMessage .= "<h2>Segnalazione disservizio rete internet</h2><table  style='border-collapse: collapse;'>";
		$clientMessage .= "<tr><td style='padding: 10px; border: 1px solid #ccc;'>Problematica riscontrata: </td><td style='padding: 10px; border: 1px solid #ccc;'><strong>${selectNet}</strong></td></tr>";
		$clientMessage .= "<tr><td style='padding: 10px; border: 1px solid #ccc;'>Note:</td><td style='padding: 10px; border: 1px solid #ccc;'><strong>${netNote}</strong></td></tr></table>";
	}
	if (!empty($mobileTextareaNumbers)) {
		$clientMessage .= "<h2>Segnalazione disservizio rete mobile</h2> <table  style='border-collapse: collapse;'>";
		if (!empty($selectMobile)) {
			$clientMessage .= "<tr><td style='padding: 10px; border: 1px solid #ccc;'>Problematica riscontrata:</td><td style='padding: 10px; border: 1px solid #ccc;'> <strong>${selectMobile}</strong></td></tr>";
		}
		if (!empty($mobileTextareaNumbers)) {
			$clientMessage .= "<tr><td style='padding: 10px; border: 1px solid #ccc;'>Numerazioni per cui si riscontra il disservizio:</td><td style='padding: 10px; border: 1px solid #ccc;'><strong>${mobileTextareaNumbers}</strong></td></tr>";
		}
		if (!empty($selectMobileAnotherNumberInput)) {
			$clientMessage .= "<tr><td style='padding: 10px; border: 1px solid #ccc;'>Indica il numero (mobile) che riceverà le chiamate durante questo periodo:</td><td style='padding: 10px; border: 1px solid #ccc;'><strong>${selectMobileAnotherNumberInput}</strong></td></tr>";
		}
		if (!empty($mobileNote)) {
			$clientMessage .= "<tr><td style='padding: 10px; border: 1px solid #ccc;'>Note:</td><td style='padding: 10px; border: 1px solid #ccc;'><strong>${mobileNote}</strong></td></tr>";
		}
		$clientMessage .= "</table><br><br>";
	}

	if (!empty($administration_desc)) {
		$clientMessage .= "<h2>Segnalazione problematica amministrativa</h2> <table  style='border-collapse: collapse;'>";
		$clientMessage .= "<tr>
				<td style='padding: 10px; border: 1px solid #ccc;'><strong>Descrizione della problematica:</strong></td>
				<td style='padding: 10px; border: 1px solid #ccc;'>${administration_desc}</td></tr>";
		if (isset($administrator_file) && !empty($administrator_file)) {
			$clientMessage .= "<tr>
			<td style='padding: 10px; border: 1px solid #ccc;'><strong>Problematica riscontrata:</strong></td>
			<td style='padding: 10px; border: 1px solid #ccc;'>${administrator_file}</td></tr>";
		}
		$clientMessage .= "</table><br><br>";
	}
	$clientMessage .= "
		<div style='font-size: 12px;'>
			<p>Company name: <strong>${company_name}</strong></p>
			<p>Result: <strong>${result}</strong></p>
			<p>Text: <strong>${response_text}</strong></p>
			<p>ValidationToken: <strong>${validationToken}</strong></p>
		</div>
	";
	//	$mail_to_third  = "topcare.altuofianco@gmail.com";
	$thm       = 'La tua richiesta di assistenza TopCare';
	$thmClient = 'Richiesta TopCare pervenuta da modulo web';

	if (!function_exists('wp_handle_upload')) {
		require_once(ABSPATH . 'wp-admin/includes/file.php');
	}
	$file = $_FILES['administrator_file'];

	if ($file) {
		$upload_overrides = array(
			'test_form' => false
		);

		$file_project = wp_handle_upload($file, $upload_overrides);

		$attachments = array(
			$file_project['file'] // 3 файл
		);

		// wp_die(
		// 	json_encode(array('type' => 'success', 'text' => $attachments))
		// );
		// die(json_encode(array('type' => 'file', 'result' => $file_project)));

		$headers = [
			"MIME-Version: 1.0",
			"From: $contactPerson <$personEmail>",
			"Content-Type: text/html; charset=UTF-8",
			"Bcc: altuofianco.topcare@gmail.com"
		];
		add_filter('wp_mail_content_type', 'my_custom_email_content_type');
		function my_custom_email_content_type()
		{
			return 'text/html';
		}

		// wp_mail($personEmail, $thm, $userMessage, $headers)

		if (wp_mail($mail_to, $thmClient, $clientMessage, $headers, $attachments)) {
			$output = json_encode(array('type' => 'success', 'text' => 'Email was sent successfully'));
			foreach ((array)$attachments as $file) {
				if (file_exists($file)) {
					unlink($file);
				}
			}
			wp_die($output);
		} else {
			$output = json_encode(array('type' => 'error', 'text' => 'Could not send mail! Please check your PHP mail configuration.'));
			wp_die($output);
		}
	} else {
		$headers = [
			"MIME-Version: 1.0",
			"From: $contactPerson <$personEmail>",
			"Content-Type: text/html",
			'Bcc: altuofianco.topcare@gmail.com'
		];
		// wp_mail($personEmail, $thm, $userMessage, $headers)
		if (wp_mail($personEmail, $thm, $userMessage, $headers) && wp_mail($mail_to, $thmClient, $clientMessage, $headers)) {
			$output = json_encode(array('type' => 'success', 'text' => 'Email was sent successfully'));
			wp_die($output);
		} else {
			$output = json_encode(array('type' => 'error', 'text' => 'Could not send mail! Please check your PHP mail configuration.'));
			wp_die($output);
		}
	}
}
