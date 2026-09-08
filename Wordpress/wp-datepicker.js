
	wp_enqueue_script( 'bs-prosecco-datepicker-it-js', get_template_directory_uri() . '/assets/libs/datepicker-it.js', [ 'jquery' ], null, true );

		let datePickerDegustazioni = function () {
			if ($('html').attr('lang') === 'it-IT') {
				$.datepicker.setDefaults(
					$.extend({
							'dateFormat': 'dd-mm-yy'
						},
						$.datepicker.regional['it']
					)
				);
			} else {
				$.datepicker.setDefaults(
					$.extend({
							'dateFormat': 'dd-mm-yy'
						},
						$.datepicker.regional['en']
					)
				);
			}
			$('.datepicker-class').datepicker({
				minDate: 0,
				altField: "#degustazioni-date",
				beforeShowDay: function (date) {
					let day = date.getDay();
					// console.log(day);
					return [(day !== 0)];
				}
			})
		}
<div class="form-group form-group--date">
    <label for="date">Data *</label>
    <div class="datepicker-class"></div>
    [hidden degustazioni-date id:degustazioni-date]
</div>
