[![Code Triagers Badge](https://www.codetriage.com/shadowss/travianz/badges/users.svg)](https://www.codetriage.com/shadowss/travianz)
[![Maintenance](https://img.shields.io/maintenance/yes/2017.svg)]()
[![GitHub Release](https://img.shields.io/github/release/Shadowss/TravianZ/all.svg)]()
[![Github All Downloads](https://img.shields.io/github/downloads/Shadowss/TravianZ/total.svg)]()
[![GitHub contributors](https://img.shields.io/github/contributors/Shadowss/TravianZ.svg)]()
[![license](https://img.shields.io/github/license/Shadowss/TravianZ.svg)]()
[![GitHub last commit](https://img.shields.io/github/last-commit/Shadowss/TravianZ.svg)]()
[![Proudly Coded in PHPStorm](https://img.shields.io/badge/coded%20in-PHPStorm-BD5CF3.svg)](https://www.jetbrains.com/buy/opensource/?product=phpstorm)
[![Donate to this project on LiberaPay](https://img.shields.io/badge/LiberaPay-donate-F6C915.svg)](https://liberapay.com/martinambrus/donate)
[![Join the chat at https://gitter.im/TravianZ-V8/Lobby](https://badges.gitter.im/TravianZ-V8/Lobby.svg)](https://gitter.im/TravianZ-V8/Lobby?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
[![Watch how this was made on YouTube](https://img.shields.io/badge/The%20making%20of...-YouTube-FF0000.svg)](https://www.youtube.com/watch?v=1XiHhpGUmQg&list=PLzV5avt1FFHorlIeoL9YX0pdb9bj-FO84)

TravianZ Version **v.8.3.3 BETA b4**
======
**Note:** this game is still in a pre-release state, although at this point it is very playable, tested and found to be fairly stable

**WARNING:** please note that ***this is in no way an upgrade*** from the old 8.3.2 version, so please ***do not try to just copy your files over***, 
since the installer logic has changed and you would just crash your old version

**Quick links:**
* [Download and Updates](https://github.com/Shadowss/TravianZ) &raquo;&raquo; https://github.com/Shadowss/TravianZ
* [Wiki](https://github.com/Shadowss/TravianZ/wiki)
* [Game Mechanics](http://travian.wikia.com/wiki/Travian_Wiki)
* [The Making Of](https://www.youtube.com/watch?v=1XiHhpGUmQg&list=PLzV5avt1FFHorlIeoL9YX0pdb9bj-FO84) - YouTube Videos about this project
* [Donate to TravianZ](https://liberapay.com/martinambrus/donate)

**Minimum requirements:**
* [PHP](http://php.net/) 5.6.32+
* [MySQL Community Server](https://dev.mysql.com/downloads/mysql/) 5.5+
  * or alternatively, [MariaDB](https://downloads.mariadb.org/) 5.5+
  * please see also the compatibility notes on [this Wiki page](https://github.com/Shadowss/TravianZ/wiki/Known-Bugs)

**Dedicated or shared hosting?**

We *strongly* recommend using a ***dedicated hosting*** for this game. Big Travian servers used to host 
thousands of players and the original servers still had about 300ms page display time. The legacy code 
in this clone (which was created in 2013) is right now doing about **400 MySQL queries** (questions 
to the database) per single page refresh - which is usually well beyond what most shared hostings can support 
with a big enough player base.

**Support & Bug reports**

We are usually available to chat at our [Gitter channel](https://gitter.im/TravianZ-V8/Lobby), if you like to ask 
any questions or just talk to the developers about how great their day is today :) As for bug reports, please use 
the [Issues tab](https://github.com/Shadowss/TravianZ/issues) and create new issue, whether it's an error in game 
or you have a feature request to be included in the play.

**The team**
* [Shadowss](https://github.com/Shadowss) - project owner and an occasional developer / tester
* [martinambrus](https://github.com/martinambrus) - lead developer
* [Vladyslav](https://github.com/velhbxtyrj) - rigorous game tester

**Thanks**

Many thanks to all those who recently played around with the project and tested it both, locally and on their 
own servers. This includes [ZZJHONS](https://github.com/ZZJHONS), [DracoMilesX](https://github.com/DracoMilesX), 
[phaze1G](https://github.com/phaze1G) and many others who were too shy to let us know that they use and enjoy 
runnign this game :)

Also, our thanks go to all both, the original and occasional developers, especially [yi12345](https://github.com/yi12345/), 
[advocaite](https://github.com/advocaite/), [brainiacX](https://github.com/brainiacX/), [ronix](https://github.com/ronix/), 
[MisterX](https://github.com/MisterX/), [Elio](https://github.com/Elio/) and many others who were part of this 
project's history.

Last but not least, our thanks go to [JetBrains](https://www.jetbrains.com/) for lending us a one-year full-featured 
[open-source PHPStorm](https://www.jetbrains.com/buy/opensource/?product=phpstorm) (and other products) license! 
Thanks guys, you're awesome :)