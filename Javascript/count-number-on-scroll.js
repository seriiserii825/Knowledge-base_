  $(window).scroll(startCounter);
  function startCounter() {
    if ($(window).scrollTop() > 200) {
      $(window).off("scroll", startCounter);
      $('.donation-goes__number').each(function () {
        const $this = $(this);
        let text = $this.text();
        let data_number = $this.data('number');
        text = text.replace(/,/g, '');
        console.log(text, "text");
        jQuery({Counter: 0}).animate({Counter: text}, {
          duration: 1000,
          easing: 'swing',
          step: function () {
            $this.text(Math.ceil(this.Counter));
          },
          complete: function () {
            $this.text(data_number);
          }
        });
      });
    }
  }
