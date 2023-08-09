# ABookLK Configuration Steps

Follow these steps to configure ABookLK on your system:

1. Create a New Folder:
   - Navigate to the directory "C:\xampp\htdocs" on your system.
   - Create a new folder within this directory to house the ABookLK files.

2. Update php.ini Settings:
   - Locate the "php.ini" file at "C:\xampp\php\php.ini".
   - Open the "php.ini" file using a text editor.
   - Modify the following settings:
     - Set "sendmail_from" to your email address: `sendmail_from = youremail@gmail.com`
     - Set "sendmail_path" to point to the sendmail executable: `sendmail_path = "\"C:\xampp\sendmail\sendmail.exe\" -t"`
     - Set "smtp_port" to 587: `smtp_port = 587`

3. Configure sendmail.ini Settings:
   - Locate the sendmail.ini file at"C:\xampp\sendmail\sendmail.ini"
   - Update the following settings within this section:
     - Set "smtp_server" to "smtp.gmail.com".
     - Set "smtp_port" to 587.
     - Set "force_sender" to your email address: `force_sender = youremail@gmail.com`
     - Set "auth_username" to your Gmail email address: `auth_username = youremail@gmail.com`
     - Set "auth_password" to the generated app password: `{generate app password and enter here}`

By following these steps, you'll successfully configure ABookLK with the necessary settings for email communication.
