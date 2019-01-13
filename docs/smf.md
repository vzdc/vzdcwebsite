Instructions on how to use smf2.0.15 with php 7.2 mostly with the importance of logining a user.

In `/var/www/forums/SmfApi/Server/smf_2_api.php` make these changes.

Line 524:

```php
*/

+ error_reporting(E_ALL ^ E_DEPRECATED);

// don't do anything if SMF is already loaded
if (defined('SMF'))
    return true;

define('SMF', 'API');
```

line 1898:

```php
    if (0 == $id_member) { //&& isset($_COOKIE[$cookiename])) {
+       $cookieData = "SMFCookie11";//stripslashes($_COOKIE[$cookiename]);
        // fix a security hole in PHP 4.3.9 and below...
        if (preg_match('~^a:[34]:\{i:0;(i:\d{1,6}|s:[1-8]:"\d{1,8}");i:1;s:(0|40):"([a-fA-F0-9]{40})?";i:2;[id]:\d{1,14};(i:3;i:\d;)?\}$~i', $cookieData) == 1) {
```
