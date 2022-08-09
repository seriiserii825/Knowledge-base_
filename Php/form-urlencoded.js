let details = {
  t,
  latitudine,
  longitudine,
  tipologia_immobile,
  stato_conservativo,
  superficie,
};

var formBody = [];
for (var property in details) {
  var encodedKey = encodeURIComponent(property);
  var encodedValue = encodeURIComponent(
    details[property]
  );
  formBody.push(encodedKey + '=' + encodedValue);
}
formBody = formBody.join('&');

fetch(
  `https://petra.sis-ter.it/restat_restyling/api/report/prezzi.php`,
  {
    headers: {
      'Content-Type':
        'application/x-www-form-urlencoded;charset=UTF-8',
    },
    method: 'POST',
    body: formBody,
  }
)
  .then((res) => res.json())
  .then((res) => {
    if (res.code === 200) {
      let avg = res.data.avg;
      let max = res.data.max;
      let min = res.data.min;

      $('#min').text(min);
      $('#max').text(max);
      $('#avg').text(avg);

      $('.popup-overlay__succes').addClass(
        'active'
      );
    }
  })
  .catch((err) => console.log(err, 'err'));
})
.catch((err) => console.log(err, 'err'));
