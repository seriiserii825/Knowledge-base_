<?php

add_filter('wpcf7_mail_components', function ($components, $contact_form) {
  $submission = WPCF7_Submission::get_instance();
  if (!$submission) return $components;

  $posted_data = $submission->get_posted_data();
  // error_log(print_r($posted_data, true));
  $cities = [
    [
      'city' => 'Afghanistan',
      'email' => 'seriiburduja@gmail.com'
    ],
    [
      'city' => 'land Islands',
      'email' => 'sergiu@bludelego.it'
    ]
  ];

  foreach ($cities as $city) {
    if (!empty($posted_data['select-562'][0]) && $posted_data['select-562'][0] === $city['city']) {
      // Add Bcc when country is USA
      $components['additional_headers'] .= "\r\nBcc:" . $city['email'];
    }
  }

  // if (!empty($posted_data['select-562'][0]) && $posted_data['select-562'][0] === 'Afghanistan') {
  //   // Add Bcc when country is USA
  //   $components['additional_headers'] .= "\r\nBcc:lilian@bludelego.it";
  // }

  return $components;
}, 10, 2);
