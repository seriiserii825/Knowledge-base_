setTimeout(() => {
  const billing_state = document.querySelector(
    "#select2-billing_state-container"
  );
  if (billing_state) {
    $("#billing_state").prepend(
      '<option selected disabled value="HK">Provincia</option>'
    );
  } else {
    setTimeout(() => {
      $("#billing_state").prepend(
        '<option selected disabled value="HK">Provincia</option>'
      );
    }, 500);
  }
}, 200);
