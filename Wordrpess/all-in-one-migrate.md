### backups
https://gist.github.com/Niq1982/7b02c735d55d20395c655637d0491e74

localwp
config/php version/ ini/ maxfilesize

# Import
For import go to config file and set maxfilesize
wp-content/plugins/all-in-one-wp-migration/

### For site
Sites/local/lc-sicedautomazioni/conf/php/php.ini.hbs
upload_max_filesize = 9900M
After restart site

# Restore
# If you don't want to pay for the PRO version of this plugin, and you want to use the "Restore from Server" functionally that was present in the version 6.77, follow the instructions below:
Open the js file: wp-content/plugins/all-in-one-wp-migration/lib/view/assets/javascript/backups.min.js

## On line 1208, replace the code below:

$('.ai1wm-backup-restore').click(function (e) {
	e.preventDefault();

	if (!!Ai1wm.MultisiteExtensionRestore) {
		var restore = new Ai1wm.MultisiteExtensionRestore($(this).data('archive'));
	} else if (!!Ai1wm.UnlimitedExtensionRestore) {
		var restore = new Ai1wm.UnlimitedExtensionRestore($(this).data('archive'));
	} else if (!!Ai1wm.FreeExtensionRestore) {
		var restore = new Ai1wm.FreeExtensionRestore($(this).data('archive'));
	} else {
		var restore = new Ai1wm.Restore($(this).data('archive'));
	}
});

## with the following code:

$('#ai1wm-backups-list').on('click', '.ai1wm-backup-restore', function (e) {
	e.preventDefault();
	var modelimport = new Import();
	
	var storage = Ai1wm.Util.random(12);
	var options = Ai1wm.Util.form('#ai1wm-backups-form').concat({ name: 'storage', value: storage }).concat({ name: 'archive', value: $(this).data('archive') });

	// Set global params
	modelimport.setParams(options);

	// Start import
	modelimport.start();
});

## Or with this code:
$('#ai1wm-backups-list').on('click', '.ai1wm-backup-restore', function (e) {
	e.preventDefault();

	var modelimport = new Import();

	var storage = Ai1wm.Util.random(12);
	var options = Ai1wm.Util.form('#ai1wm-backups-form').concat({ name: 'storage', value: storage }).concat({ name: 'archive', value: $(this).data('archive') });

	// Set global params
	modelimport.setParams(options);

	// Start import
	modelimport.start();
`});
