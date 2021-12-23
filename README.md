# Desafio PHP - ASPTest

Using SQLite database and Symfony console commands to be used within Docker containers
## Requirements
- Docker version 18.09.2, build 6247962
- docker-compose version 1.23.2, build 1110ad01
- docker-machine version 0.16.1, build cce350d7

## Install
```
$ docker-compose up -d --build
```
### Run commands
```
$ docker-compose exec console bin/console app:test
$ docker-compose exec console bin/console user:create <name> <lastName> <email> [<age>]
$ docker-compose exec console bin/console user:create-pwd  <id> <newPassword>  
$ docker-compose exec console bin/console user:list
```