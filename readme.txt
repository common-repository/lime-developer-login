=== Lime Developer Login ===
Contributors: limesquare
Donate link: 
Tags: login,developers,local,automatic,password
Requires at least: 3.5
Tested up to: 3.8.1
Stable tag: 1.4.0
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Speed up your local development with one-click, automatic login. 

== Description ==

When developing locally, it can be a pain to remember your temporary account details. We solve that with a one-click, automatic login.

If installed in a local environment, the login dialog will display a list of usernames (and roles) for that website. By simply clicking on a username, you will automatically be logged in as that user.

Great if you’re regularly switching users, often logging in and out, or have forgotten the local password.

This plugin is primarily aimed at developers and testers, and is *not for use on production websites*.

= Features =

* One-click login for as any registered user. 
* No need to have the original password.
* Security check disables all functionality unless running on a local system.
* Limited to displaying the first 10 users (for sites with a large subscriber base).
* Single file plugin - place this in the mu-plugins to automatically activate the plugin (so you can activate without logging in).
* No configurable options. The plugin just works!

For plugin support email support@limeplugins.com or visit [Lime Plugins](http://www.limeplugins.com/).


== Installation ==

1. Unzip and copy the `lime-developer-login.php` file to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Visit the /wp-login.php to view the available login accounts.

= Password-less Installation =
1. Create a `mu-plugins` folder under `/wp-content/` (if it doesn’t exist).
1. Unzip and copy the `lime-developer-login.php` into the `mu-plugins` folder.
1. The plugin will automatically activate.
1. Visit the /wp-login.php to view the available login accounts.

Please note that you will not receive automatic plugin updates if you choose this method.


== Frequently asked questions ==

= Isn’t this a giant security risk? =

Yes, that’s why this plugin is designed only to be used in a secure local environment. Typical cases would include developers working locally. It helps in cases where you need to regularly switch user accounts, log out and in often, or have forgotten your local passwords.

= Are there any safeguards? =

Yes, all functionality is disabled unless the server is running locally. The current ‘safe’ list of IPs includes:

* 127.0.0.1
* ::1

= Can I add other local/internal IP addresses? =

Yes, you can add to the ‘safe’ array on line 20 of the plugin file.


== Screenshots ==

1. The login screen with the automatic login links activated.


== Changelog ==

= 1.4.0 =

* Initial release to the WordPress public repository.


== Upgrade notice ==

= 1.4.0 =

* This is the first publicly available version of the plugin.

