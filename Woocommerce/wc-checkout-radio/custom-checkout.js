jQuery(document).ready(function ($) {
  setTimeout(() => {
    checkoutHandle();
  }, 600);

  function checkoutHandle() {
    const billing_custom_extra_field = $('input[name="billing_codice_extra"]');
    const billing_fattura = $('input[name="billing_fattura"]');
    const billing_azienda = $('input[name="billing_azienda"]');

    removeOptional(billing_azienda);

    showFields(false);
    billing_custom_extra_field.val("some");

    billing_fattura.change(function () {
      const select_value = $(this).val();
      if ($(this).val() === "Si") {
        billing_custom_extra_field.val("");
      } else {
        billing_custom_extra_field.val("some text");
      }

      if (select_value === "No") {
        showFields(false);
      } else {
        showFields(true);
      }

      // Send an AJAX request to update the field requirement status
      $.ajax({
        url: ajax_object.ajax_url,
        type: "POST",
        data: {
          action: "update_checkout_fields",
          nonce: ajax_object.nonce,
          select_value: select_value,
        },
        success: function (response) {
          if (response.success) {
            // console.log(response, "response");
          }
        },
      });
    });
    function showFields(toggle) {
      billing_azienda.prop("required", toggle);
      if (toggle) {
        billing_azienda.closest("p.form-row").show();
      } else {
        billing_azienda.closest("p.form-row").hide();
      }
    }
    $(document.body).on("checkout_error", function () {
      const errors = document.querySelectorAll(".woocommerce-error li");
      errors.forEach((error, index) => {
        error.innerText.toLowerCase().includes("extra");
        if (error.innerText.toLowerCase().includes("extra")) {
          error.remove();
        }
      });
    });

    function removeOptional(elem) {
      elem.closest("p.form-row").find("label .optional").remove();
    }
  }
});
