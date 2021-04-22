	$("form").validate({
		rules: {
			name: {
				required: true,
			},
			email: {
				required: true,
				email: true
			},
			phone: {
				required: true,
				digits: true
			},
			message: {
				required: true
			},
		},
		messages: {
			name: {
				required: "Questo campo è obbligatorio",
			},
			email: {
				required: "Questo campo è obbligatorio",
				email: "Email"
			},
			phone: {
				required: "Questo campo è obbligatorio",
				digits: "Numeri"
			},
			message: {
				required: "Questo campo è obbligatorio",
			},
		},
		submitHandler: function (form) {
			$.ajax({
				type: "POST",
				url: "mail.php",
				data: $(form).serialize(),
				success: function () {
					$(form).html("<div id='message' class='form-success-block'>I dati dal modulo sono stati inviati</div>");
				}
			});
			return false; // required to block normal submit since you used ajax
		}
	});
