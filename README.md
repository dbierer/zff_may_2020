# Class notes for Zend Framework Fundamentals class help May 2020

## TODO
* Research settings needed to enable Whoops error handling

## Homework
* For Mon 11 May
  * Lab: Using a Built-in Controller Plugin
  * Lab: Using a Custom Controller Plugin
  * Lab: New Controllers and Factories
* For Fri 8 May
  * Lab: Create a New Module
  * Lab: Create a New Controller, Layout Template, and Route
* For Wed 6 May
  * Install the Laminas Skeleton Project
  * See: https://docs.laminas.dev/tutorials/getting-started/skeleton-application/
  * Start under `/home/vagrant/Zend/workspaces/DefaultWorkspace`
  * When you're done, make sure you change the directory name to `onlinemarket.work`
* For error information:
```
sudo tail /var/log/apache2/error.log
```    
* Enable error display: add `display_errors=On` to the following `php.ini` file and restart Apache:
```
sudo gedit /etc/php/7.3/apache2/php.ini
sudo service apache2 restart
```
* If you get this error: ` Module (Market) could not be initialized`
  * Check to see if module is in `composer.json::autoload::psr-4`
  * Have you refreshed Composer?  (ie. `composer update` or `composer dump-autoload`)
  * Is module listed in `config/modules.config.php`?
  * Is the module in the correct directory structure under `module/MODULE_NAME`?
  * Does the `Module.php` have the correct namespace?
  * Is the `Module.php` under the `module/MODULE_NAME/src` directory?
## Resources
* Migrating from ZF to Laminas:
  * https://www.zend.com/webinars/migrating-zend-framework-laminas
* New main website:
  * https://getlaminas.org/
* Laminas skeleton app:
  * https://docs.laminas.dev/tutorials/getting-started/skeleton-application/
* Laminas MVC tool:
  * https://github.com/dbierer/laminas_tools
```
composer require --dev phpcl/laminas-tools
```

## Class Discussion
* Inversion of Control / Services Containers
  * https://martinfowler.com/bliki/InversionOfControl.html
* Docker
  * Example of mounting a volume using Docker:
```
docker volume create db_data_server_1
docker run -d -it --name learn-mongo-server-1 -v db_data_server_1:/data/db -v $PWD:/repo -v $PWD/docker/hosts:/etc/hosts -v $PWD/docker/mongod.conf:/etc/mongod.conf unlikelysource/mongodb_python:latest
```
  * Or use `docker-compose`
```
version: "3"
services:
  learn-mongodb-server-1:
    container_name: learn-mongo-server-1
    hostname: server1
    image: learn-mongodb/member-server-1
    volumes:
     - db_data_server_1:/data/db
     - .:/repo
     - ./docker/hosts:/etc/hosts
     - ./docker/mongod.conf:/etc/mongod.conf
    ports:
     - 8888:80
     - 27111:27017
    build: ./docker
    restart: always
    command: -f /etc/mongod.conf
    networks:
      app_net:
        ipv4_address: 172.16.0.11

networks:
  app_net:
    ipam:
      driver: default
      config:
        - subnet: "172.16.0.0/24"

volumes:
db_data_server_1: {}
```

## ERRATA
* file:///D:/Repos/ZF-Level-1/Course_Materials/index.html#/3/19: in the view template, s/be as follows:
```
<div>
    <h1><?= $this->firstName . $this->lastName . ': ' . $this->responsibility?></h1>
</div>
```
* file:///D:/Repos/ZF-Level-1/Course_Materials/index.html#/3/38: to create a view template for Market Module, Index Controller:
```
cd /home/vagrant/Zend/workspaces/DefaultWorspace/onlinemarket.work/module/Market
mkdir view
mkdir view/market
mkdir view/market/index
touch view/market/index/index.phtml
```


