Harokopio University Cris v0.1 beta

Requirements for Cris Portal

apache
mariadb (mysql)
various apache modules (mail,ldap,etc)


Requirements for Dspace repository //needed for storing Publications  

tomcat
DSpace 
axis2

SOAP web service from http://sourceforge.net/p/e-thesis/code/HEAD/tree/E-ThesisWS/
Requires Netbeans with axis2 plugin to compile and deploy on axis2 

Installation Instructions

Mariadb

create user (crisuser)

create database  (crisdb) , 

give all rights to crisuser for crisdb

Create db from create  sql script (cris_create.sql)

copy cris files to web server  folder

chmod 755 files

chmod 755 userpic


cd application/config

gedit config.php
 
search for $config['base_url'] = 'http://yourbaseurl/cris';
save exit

gedit database.php
change connection settings
save and exit

gedit email.php
change email settings
save and exit

gedit ldap.php //if you have ldap server else you need to create new login method
change ldap settings
save and exit


mv cas /opt/cas  //copy cas folder to /opt  
gedit cas.php //if you have a cas server for login else you need to create new login method
change cas settings
save and exit


gedit repository.php
translate and change if needed the metadata and admeta
edit connection settings
change/translate pubtypes
change/translate PositionTypes



Done

Enjoy customizing....



