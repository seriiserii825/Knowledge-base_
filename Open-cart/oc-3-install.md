#download oc 3 theme from cloud
#Unzip and Rename Files
admin -> controller -> extension -> theme -> antropy
        language -> en-gb -> extension -> theme -> antropy
        view -> themplate -> extension -> theme -> antropy
catalog -> view ->  theme -> antropy

#Find and Replace "antropy" in All Files with Your Theme Name
grep -rl antropy . | xargs sed -i 's/antropy/my_theme/g'

#Replace the Admin Controller Class Name with Correct Capitalisation
In the file /upload/admin/controller/extension/theme/my_theme.php find the line at the very top:
class ControllerExtensionThemeAntropy extends Controller {
And make sure it has proper capitals after underscores if you used them:
class ControllerExtensionThemeMyTheme extends Controller {

#Upload the theme (don't worry, no files will be over-written)!
#In the OpenCart Admin, Install and Enable your Theme in Extensions
#Switch to the Theme in Settings

#switch storage in config, admin/config to ../../storage/
