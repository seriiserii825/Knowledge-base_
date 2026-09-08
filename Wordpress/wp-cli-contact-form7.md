
```bash
wp db query "SELECT meta_value FROM $(wp db prefix --allow-root)postmeta WHERE post_id = 300 AND meta_key = '_mail'" --allow-root
```

### Listing all Post IDs of Custom Post Type with WP-CLI

Now we can get a list of the Contact Form 7 posts

```bash
wp post list --post_type=wpcf7_contact_form --allow-root
```


### Listing Post Meta with WP-CLI

We can get the postmeta details for the contact form with this command for `post_id 300`

```bash
wp post meta list 300 --allow-root
```

```
+---------+----------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| post_id | meta_key             | meta_value                                                                                                                                                                                               |
+---------+----------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| 300     | _form                |  Your Name (required)     [text* your-name]    Your Email (required)     [email* your-email]    Subject     [select* your-subject "Say Hi" "I want to hire you for  |
|         |                      | performance" "I want to hire you to write" "I have a guide/article suggestion"]    Your Message     [textarea your-message]   [submit "Send"]  [recaptcha size:compact]           |
| 300     | _mail                | {"active":true,"subject":"WP Bullet Guides \"[your-subject]\"","sender":"[your-name] <wordpress@guides.wp-bullet.com>","recipient":"admin@wp-bullet.com","body":"From: [your-name] <[your-email]>\nSubje |
|         |                      | ct: [your-subject]\n\nMessage Body:\n[your-message]\n\n--\nThis e-mail was sent from a contact form on WP Bullet (https:\/\/guides.wp-bullet.com)","additional_headers":"Reply-To: [your-email]","attach |
|         |                      | ments":"","use_html":true,"exclude_blank":false}                                                                                                                                                         |
| 300     | _messages            | {"mail_sent_ok":"Thank you for your message. It has been sent.","mail_sent_ng":"There was an error trying to send your message. Please try again later.","validation_error":"One or more fields have an  |
|         |                      | error. Please check and try again.","spam":"There was an error trying to send your message. Please try again later.","accept_terms":"You must accept the terms and conditions before sending your messag |
|         |                      | e.","invalid_required":"The field is required.","invalid_too_long":"The field is too long.","invalid_too_short":"The field is too short.","invalid_date":"The date format is incorrect.","date_too_early |
|         |                      | ":"The date is before the earliest one allowed.","date_too_late":"The date is after the latest one allowed.","upload_failed":"There was an unknown error uploading the file.","upload_file_type_invalid" |
|         |                      | :"You are not allowed to upload files of this type.","upload_file_too_large":"The file is too big.","upload_failed_php_error":"There was an error uploading the file.","invalid_number":"The number form |
|         |                      | at is invalid.","number_too_small":"The number is smaller than the minimum allowed.","number_too_large":"The number is larger than the maximum allowed.","quiz_answer_not_correct":"The answer to the qu |
|         |                      | iz is incorrect.","captcha_not_match":"Your entered code is incorrect.","invalid_email":"The e-mail address entered is invalid.","invalid_url":"The URL is invalid.","invalid_tel":"The telephone number |
|         |                      |  is invalid."}                                                                                                                                                                                           |
| 300     | _additional_settings |                                                                                                                                                                                                          |
| 300     | _locale              | en_US                                                                                                                                                                                                    |
+---------+----------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
```

Using the `post meta get` command we can look at this serialized options array for the `_mail meta_key`

```bash
wp post meta get 300 _mail --allow-root
```


### Accessing Serialized postmeta with WP-CLI

As of WP-CLI 1.4.0 it is now possible to access and modify WordPress options and meta stored in a serialized array with the `pluck` and `patch` commands!

wp post meta pluck syntax takes this form

```bash
wp post meta pluck <ID> <key> <key-name>
```

Using post\_id `300` as the `<ID>`, `_mail` as the `<key>` and the `<key-name>` as `use_html`, the command looks like this

```bash
wp post meta pluck 300 _mail use_html --allow-root
```


Now we can update these values with the patch command whose syntax looks like this.

```
wp post meta patch update <ID> <key> <key-name> <value>
```

Using post\_id `300` as the `<ID>`, `_mail` as the `<key>` and the `<key-name>` as `use_html` with the `1` as `value`, the command looks like this

```bash
wp post meta patch update 300 _mail use_html 1 --allow-root
```

### Scripting with WP-CLI

In this simple bash script we create an array of all the Contact Form 7 `post_ids`.

Then we use the `post meta patch` command to update each programatically via a for loop through the array.

```bash
POSTIDLIST=($(wp post list --post_type=wpcf7_contact_form --field=ID --allow-root))

for POSTID in ${POSTIDLIST[@]}; do
    wp post meta patch update ${POSTID} _mail use_html 1 --allow-root
done
```
