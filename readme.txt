=== SSH2 Users Sync ===

Contributors: vmassuchetto
Donate link: http://vmassuchetto.wordpress.com
Tags: users, ssh, authentication
Requires at least: 2.7
Tested up to: 2.9.2
Stable tag: 0.02

This plugin syncronizes the users of Wordpress with a SSH2 server like:
If the user exists in the SSH2 server, then it can be created in Wordpress.

== Description ==

This plugin syncronizes the users of a Wordpress installation with a SSH2 server users in a simple manner like:
If the user exists in the SSH2 server, then it can be created in the installation.
You can also choose the group the user must be in the SSH2 server to be able to register.

That's useful to automatically allow registrations of users in a lab, company, departament, etc, without adding them manually.

You must have PHP-SSH2 modules installed in your server for this plugin to work properly. Reffer to the installation tab for instructions.

== Installation ==

In an Ubuntu/Debian server:

`aptitude update
aptitude install php5-dev php5-cli php-pear build-essential openssl-dev zlib1g-dev
aptitude install libssh2-1-dev libssh2-php`

In other distros that does not support these packages, you can download and compile them yourself:

`wget http://surfnet.dl.sourceforge.net/sourceforge/libssh2/libssh2-0.14.tar.gz
tar -zxvf libssh2-0.14.tar.gz
cd libssh2-0.14/
./configure
make all install
pecl install -f ssh2
echo 'extension=ssh2.so' >> /etc/php5/conf.d/ssh2.ini`

For the plugin:

* Download and activate the plugin;
* Enter the information of your SSH2 server in "Settings > SSH2 Sync" admin page.
* Enable the registration form via widget or pasting the code `<?php if (function_exists(sus_register_form)) sus_register_form(); ?>` wherever you like in your theme.

Note:
* There's no sense in using this plugin with the "Allow user to register" option enabled. You can change it in the "Settings > Gereral" admin page.

== Frequently Asked Questions ==

Go to http://vinicius.soylocoporti.org.br/ssh2-users-sync-wordpress-plugin for help.

== Screenshots ==


== Changelog ==

= 0.01 =
* Plugin released. That's it.
