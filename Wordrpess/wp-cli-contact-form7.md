I recently set up [Mailgun](https://www.mailgun.com/) for a [Codeable](https://guides.wp-bullet.com/codeable/) client who was using [Contact Form 7](https://wordpress.org/plugins/contact-form-7/). Unfortunately after integrating Mailgun to improve the reliability of email delivery, the formatting of the emails was not quite right. I managed to isolate the issue to a setting called **Use HTML Content Type** in Contact Form 7 which had to be checked. There were about 200 contact forms on this site and I didn’t want to have to update them all manually so I looked into WP-CLI.

[WP-CLI](http://wp-cli.org/) [1.4.0](https://make.wordpress.org/cli/2017/10/17/version-1-4-0-released/) introduced some very useful command options for managing serialized array settings in `wp_options` and `wp_postmeta`. This post shows you how to use these commands and then use them to batch update through hundreds of posts :).

## Using WP-CLI for Batch Updating Contact Form 7 Postmeta Options

I did some digging in the database and found the values I needed to change in the `wp_postmeta` table.

You can see the options by first getting the `post_id` for the contact form which is under the contact form interface.

You can see the `post_id` in the contact form shortcode here `300`.

[![](https://guides.wp-bullet.com/wp-content/uploads/2017/11/contact-form-7-shortcode-1024x164.png)](https://guides.wp-bullet.com/wp-content/uploads/2017/11/contact-form-7-shortcode.png)

This query will show you the postmeta information for the contact form ID `300` and the `meta_key` called `_mail`

```bash
wp db query "SELECT meta_value FROM $(wp db prefix --allow-root)postmeta WHERE post_id = 300 AND meta_key = '_mail'" --allow-root
```

![](data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdGVkIGJ5IEljb01vb24uaW8gLS0+DQo8IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgdmlld0JveD0iMCAwIDIwIDIwIiBzdHlsZT0iZmlsbDogI2ZmZmZmZjsiPg0KPHBhdGggZD0iTTYgMTV2LTEzaDEwdjEzaC0xMHpNNSAxNmg4djJoLTEwdi0xM2gydjExeiI+PC9wYXRoPg0KPC9zdmc+DQo=)

In the output here, notice the `use_html;b:1` meaning a boolean value which can be true (1) or false (0)

```json
a:9:{s:6:"active";b:1;s:7:"subject";s:33:"WP Bullet Guides "[your-subject]"";s:6:"sender";s:44:"[your-name] <wordpress@guides.wp-bullet.com>";s:9:"recipient";s:19:"admin@wp-bullet.com";s:4:"body";s:175:"From: [your-name] <[your-email]>
Subject: [your-subject]

Message Body:
[your-message]

--
This e-mail was sent from a contact form on WP Bullet (https://guides.wp-bullet.com)";s:18:"additional_headers";s:22:"Reply-To: [your-email]";s:11:"attachments";s:0:"";s:8:"use_html";b:1;s:13:"exclude_blank";b:0;}
```

![](data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdGVkIGJ5IEljb01vb24uaW8gLS0+DQo8IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgdmlld0JveD0iMCAwIDIwIDIwIiBzdHlsZT0iZmlsbDogI2ZmZmZmZjsiPg0KPHBhdGggZD0iTTYgMTV2LTEzaDEwdjEzaC0xMHpNNSAxNmg4djJoLTEwdi0xM2gydjExeiI+PC9wYXRoPg0KPC9zdmc+DQo=)

### Finding Registered Custom Post Types with WP-CLI

Let’s find the post-type name, the post\_id and grab and change this value with WP-CLI.

This will show all registered post-types with WP-CLI.

```bash
wp post-type list --allow-root
```

![](data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdGVkIGJ5IEljb01vb24uaW8gLS0+DQo8IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgdmlld0JveD0iMCAwIDIwIDIwIiBzdHlsZT0iZmlsbDogI2ZmZmZmZjsiPg0KPHBhdGggZD0iTTYgMTV2LTEzaDEwdjEzaC0xMHpNNSAxNmg4djJoLTEwdi0xM2gydjExeiI+PC9wYXRoPg0KPC9zdmc+DQo=)

We can see the `wpcf7_contact_form` post type

```
+----------------------+------------------------------+-------------+--------------+--------+---------------------+
| name                 | label                        | description | hierarchical | public | capability_type     |
+----------------------+------------------------------+-------------+--------------+--------+---------------------+
| post                 | Posts                        |             |              | 1      | post                |
| page                 | Pages                        |             | 1            | 1      | page                |
| attachment           | Media                        |             |              | 1      | post                |
| revision             | Revisions                    |             |              |        | post                |
| nav_menu_item        | Navigation Menu Items        |             |              |        | post                |
| custom_css           | Custom CSS                   |             |              |        | post                |
| customize_changeset  | Changesets                   |             |              |        | customize_changeset |
| wpcf7_contact_form   | Contact Forms                |             |              |        | post                |
| tablepress_table     | TablePress Tables            |             |              |        | tablepress_table    |
| vecb_editor_buttons  | Visual Editor Custom Buttons |             |              |        | post                |
| generate_page_header | Page Headers                 |             |              |        | page                |
+----------------------+------------------------------+-------------+--------------+--------+---------------------+
```

### Listing all Post IDs of Custom Post Type with WP-CLI

Now we can get a list of the Contact Form 7 posts

```bash
wp post list --post_type=wpcf7_contact_form --allow-root
```

![](data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdGVkIGJ5IEljb01vb24uaW8gLS0+DQo8IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgdmlld0JveD0iMCAwIDIwIDIwIiBzdHlsZT0iZmlsbDogI2ZmZmZmZjsiPg0KPHBhdGggZD0iTTYgMTV2LTEzaDEwdjEzaC0xMHpNNSAxNmg4djJoLTEwdi0xM2gydjExeiI+PC9wYXRoPg0KPC9zdmc+DQo=)

Perfect, that’s the one: `ID 300`!

```
+-----+------------+-----------+---------------------+-------------+
| ID  | post_title | post_name | post_date           | post_status |
+-----+------------+-----------+---------------------+-------------+
| 300 | Contact    | untitled  | 2016-08-12 11:35:48 | publish     |
+-----+------------+-----------+---------------------+-------------+
```

### Listing Post Meta with WP-CLI

We can get the postmeta details for the contact form with this command for `post_id 300`

```bash
wp post meta list 300 --allow-root
```

![](data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdGVkIGJ5IEljb01vb24uaW8gLS0+DQo8IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgdmlld0JveD0iMCAwIDIwIDIwIiBzdHlsZT0iZmlsbDogI2ZmZmZmZjsiPg0KPHBhdGggZD0iTTYgMTV2LTEzaDEwdjEzaC0xMHpNNSAxNmg4djJoLTEwdi0xM2gydjExeiI+PC9wYXRoPg0KPC9zdmc+DQo=)

There are multiple `meta_keys`, the `_mail` one has the serialized array of options

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

![](data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdGVkIGJ5IEljb01vb24uaW8gLS0+DQo8IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgdmlld0JveD0iMCAwIDIwIDIwIiBzdHlsZT0iZmlsbDogI2ZmZmZmZjsiPg0KPHBhdGggZD0iTTYgMTV2LTEzaDEwdjEzaC0xMHpNNSAxNmg4djJoLTEwdi0xM2gydjExeiI+PC9wYXRoPg0KPC9zdmc+DQo=)

Now you will see the array, it looks a bit messy but we can now access these with the `meta pluck` and `meta patch` commands.

```php
array (
  'active' => true,
  'subject' => 'WP Bullet Guides "[your-subject]"',
  'sender' => '[your-name] <wordpress@guides.wp-bullet.com>',
  'recipient' => 'admin@wp-bullet.com',
  'body' => 'From: [your-name] <[your-email]>
Subject: [your-subject]

Message Body:
[your-message]

--
This e-mail was sent from a contact form on WP Bullet (https://guides.wp-bullet.com)',
  'additional_headers' => 'Reply-To: [your-email]',
  'attachments' => '',
  'use_html' => true,
  'exclude_blank' => false,
)
```

![](data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdGVkIGJ5IEljb01vb24uaW8gLS0+DQo8IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgdmlld0JveD0iMCAwIDIwIDIwIiBzdHlsZT0iZmlsbDogI2ZmZmZmZjsiPg0KPHBhdGggZD0iTTYgMTV2LTEzaDEwdjEzaC0xMHpNNSAxNmg4djJoLTEwdi0xM2gydjExeiI+PC9wYXRoPg0KPC9zdmc+DQo=)

### Accessing Serialized postmeta with WP-CLI

As of WP-CLI 1.4.0 it is now possible to access and modify WordPress options and meta stored in a serialized array with the `pluck` and `patch` commands!

wp post meta pluck syntax takes this form

```bash
wp post meta pluck <ID> <key> <key-name>
```

![](data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdGVkIGJ5IEljb01vb24uaW8gLS0+DQo8IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgdmlld0JveD0iMCAwIDIwIDIwIiBzdHlsZT0iZmlsbDogI2ZmZmZmZjsiPg0KPHBhdGggZD0iTTYgMTV2LTEzaDEwdjEzaC0xMHpNNSAxNmg4djJoLTEwdi0xM2gydjExeiI+PC9wYXRoPg0KPC9zdmc+DQo=)

Using post\_id `300` as the `<ID>`, `_mail` as the `<key>` and the `<key-name>` as `use_html`, the command looks like this

```bash
wp post meta pluck 300 _mail use_html --allow-root
```

![](data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdGVkIGJ5IEljb01vb24uaW8gLS0+DQo8IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgdmlld0JveD0iMCAwIDIwIDIwIiBzdHlsZT0iZmlsbDogI2ZmZmZmZjsiPg0KPHBhdGggZD0iTTYgMTV2LTEzaDEwdjEzaC0xMHpNNSAxNmg4djJoLTEwdi0xM2gydjExeiI+PC9wYXRoPg0KPC9zdmc+DQo=)

In boolean logic `1` means true

```
1
```

Now we can update these values with the patch command whose syntax looks like this.

```
wp post meta patch update <ID> <key> <key-name> <value>
```

Using post\_id `300` as the `<ID>`, `_mail` as the `<key>` and the `<key-name>` as `use_html` with the `1` as `value`, the command looks like this

```bash
wp post meta patch update 300 _mail use_html 1 --allow-root
```

![](data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdGVkIGJ5IEljb01vb24uaW8gLS0+DQo8IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgdmlld0JveD0iMCAwIDIwIDIwIiBzdHlsZT0iZmlsbDogI2ZmZmZmZjsiPg0KPHBhdGggZD0iTTYgMTV2LTEzaDEwdjEzaC0xMHpNNSAxNmg4djJoLTEwdi0xM2gydjExeiI+PC9wYXRoPg0KPC9zdmc+DQo=)

### Scripting with WP-CLI

In this simple bash script we create an array of all the Contact Form 7 `post_ids`.

Then we use the `post meta patch` command to update each programatically via a for loop through the array.

```bash
POSTIDLIST=($(wp post list --post_type=wpcf7_contact_form --field=ID --allow-root))

for POSTID in ${POSTIDLIST[@]}; do
    wp post meta patch update ${POSTID} _mail use_html 1 --allow-root
done
```
