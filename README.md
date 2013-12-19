LoL-Stats
=========

Base on Free API https://www.mashape.com/timtastic/league-of-legends-3

Data for champ and item from : http://ddragon.leagueoflegends.com/tool/euw/en_US

This is a Symfony2 project allow you to collect your own stats about League of Legend games and summoners.

Status : pre-alpha

### Principe: 

 - Its collect last 10 games for summoners insert into BDD, and can work on this data for create many stats.


### Installation:
- Use composer.phar install

```
./app/console doctrine:schema:create
./app/console pouzor:importChampions src/Pouzor/Bundle/LolStatBundle/Resourse/data/champion.json
./app/console pouzor:importItems src/Pouzor/Bundle/LolStatBundle/Resourse/data/item.json
```


### Configure:
- Get Mashape Api key on https://www.mashape.com and configure it on parameters.yml

### Use
- Import recent game with this command 
``` 
./app/console pouzor:getMatch
```


[![SensioLabsInsight](https://insight.sensiolabs.com/projects/7527040b-2b75-4697-8987-5b5a94cb2dbe/big.png)](https://insight.sensiolabs.com/projects/7527040b-2b75-4697-8987-5b5a94cb2dbe)
