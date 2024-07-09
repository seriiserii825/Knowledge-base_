<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
function registerFormRoute()
{
    register_rest_route('topcare/v1', 'form', [
        'methods' => 'POST',
        'callback' => 'formHandler',
    ]);
}

add_action('rest_api_init', 'registerFormRoute');
function formHandler($data)
{

    function fileUpload()
    {
        $partita_iva = sanitize_text_field($_REQUEST['partita_iva']);
        $validationToken = sanitize_text_field($_REQUEST['validationToken']);
        $social_region = sanitize_text_field($_REQUEST['social_region']);
        $referent_name = sanitize_text_field($_REQUEST['referent_name']);
        $referent_email = sanitize_text_field($_REQUEST['referent_email']);
        $referent_phone = sanitize_text_field($_REQUEST['referent_phone']);
        $mail_to = $referent_email;
        $sector = sanitize_text_field($_REQUEST['sector']);
        $assurance = sanitize_text_field($_REQUEST['assurance']);
        $answers_list = sanitize_text_field($_REQUEST['answers_list']);
        $testing_email = sanitize_text_field($_REQUEST['testing_email']);

        $answers_decode = json_decode(stripslashes($answers_list), true);
        $answers_list_html = '';
        foreach ($answers_decode as $item) {
            $answers_list_html .= "<p><strong>${item['label']}</strong>: ${item['answer']}</p>";
        }


        $answers_list_td = '';
        foreach ($answers_decode as $item) {
            $answers_list_td .= "<tr><td style='padding: 10px; border: 1px solid #ccc;'><strong>".$item['label']."</strong></td><td style='padding: 10px; border: 1px solid #ccc;'>".$item['answer']."</td></tr>";
        }

        $userMessage = "<p>Abbiamo ricevuto la sua segnalazione riportata qui sotto e provvederemo al più presto a prenderla in carico</p><br><br>";
        $userMessage .= "
        <table style='border-collapse: collapse;'>
            <tr>
                <td style='padding: 10px; border: 1px solid #ccc;'><strong>Ragione Sociale*: </strong></td>
                <td style='padding: 10px; border: 1px solid #ccc;'>${social_region}</td>
            </tr>
            <tr>
                <td style='padding: 10px; border: 1px solid #ccc;'><strong>Referente</strong></td>
                <td style='padding: 10px; border: 1px solid #ccc;'>${referent_name}</td>
            </tr>
            <tr>
                <td style='padding: 10px; border: 1px solid #ccc;'><strong>Telefono</strong></td>
                <td style='padding: 10px; border: 1px solid #ccc;'>${referent_phone}</td>
            </tr>
            <tr>
                <td style='padding: 10px; border: 1px solid #ccc;'><strong>Email</strong></td>
                <td style='padding: 10px; border: 1px solid #ccc;'>${referent_email}</td>
            </tr>
            <tr>
                <td style='padding: 10px; border: 1px solid #ccc;'><strong>Settore</strong></td>
                <td style='padding: 10px; border: 1px solid #ccc;'>${sector}</td>
            </tr>
            <tr>
                <td style='padding: 10px; border: 1px solid #ccc;'><strong>Argomento</strong></td>
                <td style='padding: 10px; border: 1px solid #ccc;'>${assurance}</td>
            </tr>
            <tr>
                ${answers_list_td}
            </tr>
        </table>";

        $apiMessage = "<p>Abbiamo ricevuto la sua segnalazione riportata qui sotto e provvederemo al più presto a prenderla in carico</p><br><br>";
        $apiMessage .= "
	<table style='border-collapse: collapse;'>
		<tr>
			<td style='padding: 10px; border: 1px solid #ccc;'><strong>Partita IVA: </strong></td>
			<td style='padding: 10px; border: 1px solid #ccc;'>${partita_iva}</td>
		</tr>
		<tr>
			<td style='padding: 10px; border: 1px solid #ccc;'><strong>Validation token</strong></td>
			<td style='padding: 10px; border: 1px solid #ccc;'>${validationToken}</td>
		</tr>
		<tr>
			<td style='padding: 10px; border: 1px solid #ccc;'><strong>Referent Name</strong></td>
			<td style='padding: 10px; border: 1px solid #ccc;'>${referent_name}</td>
		</tr>
		<tr>
			<td style='padding: 10px; border: 1px solid #ccc;'><strong>Referent Email</strong></td>
			<td style='padding: 10px; border: 1px solid #ccc;'>${referent_email}</td>
		</tr>
		<tr>
			<td style='padding: 10px; border: 1px solid #ccc;'><strong>Referent Phone</strong></td>
			<td style='padding: 10px; border: 1px solid #ccc;'>${referent_phone}</td>
		</tr>
		<tr>
			<td style='padding: 10px; border: 1px solid #ccc;'><strong>Sector</strong></td>
			<td style='padding: 10px; border: 1px solid #ccc;'>${sector}</td>
		</tr>
		<tr>
			<td style='padding: 10px; border: 1px solid #ccc;'><strong>Assurance</strong></td>
			<td style='padding: 10px; border: 1px solid #ccc;'>${assurance}</td>
		</tr>
		<tr>
			<td style='padding: 10px; border: 1px solid #ccc;'><strong>Answers_list</strong></td>
			<td style='padding: 10px; border: 1px solid #ccc;'>
                ${answers_list_html}
			</td>
		</tr>
		<tr>
			<td style='padding: 10px; border: 1px solid #ccc;'><strong>Testing email</strong></td>
			<td style='padding: 10px; border: 1px solid #ccc;'>${testing_email}</td>
		</tr>
	</table>";
        $thm = 'La tua richiesta di assistenza TopCare';
        if (!function_exists('wp_handle_upload')) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }
        $uploadedfile = $_FILES['atf_file'];


        $upload_overrides = array('test_form' => false);

        $movefile = wp_handle_upload($uploadedfile, $upload_overrides);

        $attachments = array($movefile['file']);

        $headers = [
            "MIME-Version: 1.0",
            "From: $referent_name <$referent_email>",
            "Content-Type: text/html; charset=UTF-8",
            "Bcc: webmaster@altuofianco.it"
        ];
        add_filter('wp_mail_content_type', 'my_custom_email_content_type');
        function my_custom_email_content_type()
        {
            return 'text/html';
        }

        if (wp_mail($mail_to, $thm, $userMessage, $headers, $attachments)) {
            foreach ((array)$attachments as $file) {
                if (file_exists($file)) {
                    unlink($file);
                }
            }
            return [
                'status' => 'success',
                'message' => 'Email was sent successfully',
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Could not send mail! Please check your PHP mail configuration.',
            ];
        }
    }

    fileUpload();
}
