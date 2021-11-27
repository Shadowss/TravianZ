======
TravianZ Version **v.8.3.4**
======
**Note:** this game is still in a pre-release state, although at this point it is very playable, tested and found to be fairly stable

**WARNING:** please note that ***this is in no way an upgrade*** from the old 8.3.2 version, so please ***do not try to just copy your files over***, 
since the installer logic has changed and you would just crash your old version

**Quick links:**
* [Download and Updates](https://github.com/greldinard/TravianZ) &raquo;&raquo; https://github.com/greldinard/TravianZ
* [Wiki](https://github.com/Shadowss/TravianZ/wiki)
* [Game Mechanics](http://travian.wikia.com/wiki/Travian_Wiki)

**Minimum requirements:**
* [PHP](http://php.net/) 7.0.0+
* [MySQL Community Server](https://dev.mysql.com/downloads/mysql/) 5.5+
  * or alternatively, [MariaDB](https://downloads.mariadb.org/) 5.5+
 * Runs fine on Ubuntu 20, Apache2 2.4, MySQL Server 8.0 and PHP 7.4

**Dedicated or shared hosting?**

We *strongly* recommend using a ***dedicated hosting*** for this game. Big Travian servers used to host 
thousands of players and the original servers still had about 300ms page display time. The legacy code 
in this clone (which was created in 2013) is right now doing about **400 MySQL queries** (questions 
to the database) per single page refresh - which is usually well beyond what most shared hostings can support 
with a big enough player base.
