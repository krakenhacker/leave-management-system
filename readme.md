**Database Name: leaveportaldb**

**Developed by George Garoufalis**

**Recommended PHP Version 7.4**

**Admin Login Details**

email: george.sot@windowslive.com

password: admin

# Getting Started

## What you will need
1. Installed xampp. Be sure that it runs on your pc.
    * More info: https://www.apachefriends.org/index.html
   > make sure you install xampp for your OS with php 7.4
2. Configure some files in order to sand mail from localhost(windows users with gmail smtp)
    1. Open the XAMPP installation directory.
    2. Navigate php.ini file from C:\xampp\php
    3. Press ctrl + f to find the mail function
    4. Search & pass the below-mentioned values.
       >SMTP=smtp.gmail.com

       >smtp_port=587

       >sendmail_from = milopleInc@gmail.com  /*Your gmail id*/

       >sendmail_path = "\"C:\xampp\sendmail\sendmail.exe\" -t"

    5. Open sendmail.ini file from C:\xampp\sendmail.
    6. Press ctrl + f & find sendmail.
    7. Search & pass the below-mentioned values.
       >smtp_server=smtp.gmail.com

       >smtp_port=587

       >error_logfile=error.log

       >debug_logfile=debug.log

       >auth_username=example@gmail.com  /*Your Gmail id*/

       >auth_password=**********  /*Your Gmail password*/

       >force_sender=example@gmail.com  /*Optional*/
    8. Last configuration : make sure you have enabled Less Secure Apps on your gmail account
       > Open Google Account

       > Click on  ‘Security’ from the left navigation panel

       > Turn ON from the Less secure app access panel on the bottom of the page.

       > Click “Save”.
3. Create database on your [phpmyadmin]http://localhost/phpmyadmin/ with name "leaveportaldb".
4. Run the sql script from leaveportaldb.sql file in "database/leaveportaldb.sql" on your [phpmyadmin]http://localhost/phpmyadmin/
   5.Copy the all the project files to **xampp/htdocs** and then run **Apache** and **MySQL** on XAMPP control panel.

## NOTES
* You **MUST** complete all the above steps in order to run the project

# APPLICATION RUN
After completing **all** steps, just type "localhost" on your browser or click on this link [localhost]http://localhost/

You must see a login form. if you don't, make sure you did all the steps as described.

## ABOUT THE APPLICATION
Application developed and designed to manage the employee's leaving request for a company.

### APPLICATION PREVIEW
**As an employee**

The employee signs into the portal.
A list of past applications is displayed, sorted by submission date.
A button “submit request” appears above the list. The employee clicks on the button in order to fill his leaving request form.
After the employee fills-in the fields and clicks on “submit”, he/she is taken back to the list of applications, where a new application appears with "pending" status.
Additionally upon submitting the application, an email is sent to the portal administrator.
The administrator clicks on one of the “approve” or “reject” links in order to accept or reject employee's submission for leaving.
As soon as the administrator makes a selection, another email goes out to the user notifying him/her of the application outcome.
After administrator's selection been made, whenever the employee signs into the portal, he/she can see on the application status "Approved" or "Rejected".

**As an administrator**

The administrator signs in with his/her credentials.
Then he/she views a list of existing users.
Above the list of existing users, there is a button to create a new user. By click on it he/she can create a new user(employee or administrator)
In the list of existing users, administrator can click on button "details", so he/she can see user's properties but can change only the password field.

