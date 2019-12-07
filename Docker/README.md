# Info

#### Links
* Site - http://localhost
* MailHog - http://localhost:8025
* PhpMyAdmin - http://localhost:8888

#### Terminal aliases
* `test-server` start PhantomJS server  
* `test-run` run Codecept tests
* `test-run-stop` run Codecept tests and stop on first fail
* `test-run-debug` run Codecept tests in debug mode
* `test-run-php` run PHPUnit tests

#### Docker commands
* `docker system prune -a` - Delete ALL docker containers and images
* `docker-compose up` - start composer
* `docker-compose up -d` - start composer as demon
* `docker-compose down` - stop composer as demon
* - login into container
* `docker kill $(docker ps -q)` kill all running containers
* `docker rm $(docker ps -a -q)` delete all stopped containers
* `docker rmi $(docker images -q)` delete all images
* `docker system prune -a && docker-compose up` - remove all and start docker

### Add key to docker
Automatic start `entrypoint` php composer if no `vendor` folder and `id_rsa` file exists
```dockerfile
COPY ./keys/* /root/.ssh/
RUN chmod 600 /root/.ssh/*
```

#NB! The first time start can take a long time: `composer`, `yarn`, `migrations`, `mysql dump` etc
