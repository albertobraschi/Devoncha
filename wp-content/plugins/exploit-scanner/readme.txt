=== Exploit Scanner ===
Contributors: donncha, duck_, ryan, azaozz, tott
Tags: security, scanner, hacking, spam, hack, crack, exploit, vulnerability
Tested up to: 3.0.4
Stable tag: 0.97.5
Requires at least: 2.9
Donate link: http://ocaoimh.ie/wordpress-plugins/gifts-and-donations/

Search the files and database of your WordPress install for signs that may indicate that it has fallen victim to malicious hackers.

== Description ==
This plugin searches the files on your website, and the posts and comments tables of your database for anything suspicious. It also examines your list of active plugins for unusual filenames.

It does not remove anything. That is left to the user to do.

Latest MD5 hash values for Exploit Scanner:

* exploit-scanner.php (0.97.5): 72317029c966bb102d1513128a5f030c
* exploit-scanner.php (0.97.4): 435e7add9bde22bb4c135c2268160abe
* hashes-3.0.4.php: edf1a796ffb688662bd7dd44c9ef24da
* hashes-3.0.3.php: c4519bf79ae387a3679c62c4b272ecad
* hashes-3.0.2.php: 91e1aabc5b2a8a5d4d2c98e1f1f70fc0
* hashes-3.0.1.php: dd08b0b46f831764ea686c5b26b990df
* hashes-3.0.php: 85d718b35ea7d63418fedbe4d96c6b54
* hashes-2.9.2.php: f70d483d0d615e0e665d8b8c477ed170

See the [Exploit Scanner homepage](http://ocaoimh.ie/exploit-scanner/) for further information.

Thanks to [Thorsten Ott](http://blog.webzappr.com/) for everything he's added to the plugin!

== Upgrade Notice ==

= 0.97.5 =
3.0.4 compatibility

== Changelog ==

= 0.97.5 =
* WordPress 3.0.4 hashes
* Dropped wp-content from hashes

= 0.97.4 =
* WordPress 3.0.3 compatibility

= 0.97.3 =
* 3.0.2 compatibility

= 0.97.2 =
* 3.0.1 compatibility

= 0.97.1 =
* PHP 4 compatibility

= 0.97 =
* AJAX paging
* simplified results system (now only 3 levels)
* contextual help
* moved to Tools menu section
* a number of backend changes

= 0.96 =
* Compatibility for WordPress 3.0

= 0.95 =
* Added "exploits" scan level for obvious hacker exploit code.
* Stored results for later review.
* Rearranged layout of results.
* Paged scanning so plugin scans 50 files at a time to avoid timeout errors.
* Only show "General Info" to non MU sites (it's too expensive for large MU sites)

== Installation ==
1. Download and unzip the plugin.
2. Copy the exploit-scanner directory into your plugins folder.
3. Visit your Plugins page and activate the plugin.
4. A new menu item called "Exploit Scanner" will be available under the Tools menu.

== Frequently Asked Questions ==

= How do I fix the out of memory error? =

Scanning your website can take quite a bit of memory. The plugin tries to allocate 128MB but sometimes that's not enough. You can modify the amount of memory PHP has access to from within the plugin admin page. You can also limit the max size of scanned files. Reduce this number to skip more files but be aware that it may miss hacked files. Any skipped files are listed after scanning. Memory is also used if you have deep directories because of the way the scanner works. It will help if you clean out any cache directories (wp-content/cache/ for example) before scanning.

== Interpreting the Results ==
It is likely that this scanner will find false positives (i.e. files which do not contain malicious code). However, it is best to err
on the side of caution; if you are unsure then ask in the [Support Forums](http://wordpress.org/support/),
download a fresh copy of a plugin, search the Internet for similar situations, et cetera. You should be most concerned if the scanner is: 
making matches around unknown external links; finding base64 encoded text in modified core files or the `wp-config.php` file; 
listing extra admin accounts; or finding content in posts which you did not put there.

Understanding the three different result levels:

* **Severe:** results that are often strong indicators of a hack (though they are not definitive proof)
* **Warning:** these results are more commonly found in innocent circumstances than Severe matches, but they should still be treated with caution
* **Note:** lowest priority, showing results that are very commonly used in legitimate code or notifications about events such as skipped files
	
== Help! I think I have been hacked! ==
Follow the guides from the Codex:

* [Codex: FAQ - My site was hacked](http://codex.wordpress.org/FAQ_My_site_was_hacked)
* [Codex: Hardening WordPress](http://codex.wordpress.org/Hardening_WordPress)

Ensure that you change **all** of your WordPress related passwords (site, FTP, MySQL, etc.). A regular backup routine 
(either manual or plugin powered) is extremely useful; if you ever find that your site has been hacked you can easily restore your site from 
a clean backup and fresh set of files and, of course, use a new set of passwords.

== Updates ==
Updates to the plugin will be posted here, to [Holy Shmoly!](http://ocaoimh.ie/) and the [WordPress Exploit Scanner](http://ocaoimh.ie/exploit-scanner/) page will always link to the newest version.

If you use The Japanese version of WordPress, you can use [these hash files](http://wpbiz.jp/files/exploit-scanner-hashes/ja/) instead. Thanks Naoko for telling me about that!
