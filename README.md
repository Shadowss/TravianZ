[![Code Triagers Badge](https://www.codetriage.com/shadowss/travianz/badges/users.svg)](https://www.codetriage.com/shadowss/travianz)
[![Join the chat at https://gitter.im/TravianZ-V8/Lobby](https://badges.gitter.im/TravianZ-V8/Lobby.svg)](https://gitter.im/TravianZ-V8/Lobby?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
[![Gratipay User](https://img.shields.io/gratipay/user/martinambrus.svg?style=plastic)](https://gratipay.com/~martinambrus/)
[![Maintenance](https://img.shields.io/maintenance/yes/2017.svg)]()

TravianZ Version **v.8.3.3 BETA b3**
======
**Note:** this game is still in a pre-release state, although at this point it is very playable, tested and found to be fairly stable

**Quick links:**
* [Download and Updates](https://github.com/Shadowss/TravianZ) &raquo;&raquo; https://github.com/Shadowss/TravianZ
* [Wiki](https://github.com/Shadowss/TravianZ/wiki)
* [Game Mechanics](http://travian.wikia.com/wiki/Travian_Wiki)

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