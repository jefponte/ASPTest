# Desafio PHP - ASPTest

Using SQLite database and Symfony console commands to be used within Docker containers

## Requirements

- Docker version 18.09.2, build 6247962
- docker-machine version 0.16.1, build cce350d7
## Install

```
$ docker build -t asptest .
$ docker run --name asptest asptest
```
## Run commands
```
$ docker exec asptest php bin/console app:test
$ docker exec asptest php bin/console user:create <name> <lastName> <email> [<age>]
$ docker exec asptest php bin/console user:create-pwd  <id> <newPassword>
$ docker exec asptest php bin/console user:list
```

### Tests
```
$ docker exec asptest php bin/console user:create Jefferson Ponte jefponte@gmail.com 32
$ docker exec asptest php bin/console user:create Jackson Ponte jackponte@gmail.com 31
$ docker exec asptest php bin/console user:create Jessica Ponte jessicaponte@gmail.com 29
$ docker exec asptest php bin/console user:list
$ docker exec asptest php bin/console user:create-pwd  1 ttAA123+$p ttAA123+$p
```