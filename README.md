LoL-Stats
=========

Base on Free API https://www.mashape.com/timtastic/league-of-legends-3

Data for champ and item from : http://ddragon.leagueoflegends.com/tool/euw/en_US

This is a Symfony2 project allow you to collect your own stats about League of Legend games and summoners.

Status : pre-alpha

Principe: 

 - Its collect last 10 games for summoners insert into BDD, and can work on this data for create many stats.


Installation:
- Use composer install
- Use db on data/sql for try on real data or fill with your own data

Use:
- Get Mashape Api key on https://www.mashape.com and configure it on parameters.yml
- Import recent game with the command ./app/console pouzor:getMatch


Evolution : 
 - Migrate Mysql Database into MongoDB for more scalling and evolution
 - Use our own Node.js server API
 - Fetch and save more infos (player infos...)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/7527040b-2b75-4697-8987-5b5a94cb2dbe/big.png)](https://insight.sensiolabs.com/projects/7527040b-2b75-4697-8987-5b5a94cb2dbe)
