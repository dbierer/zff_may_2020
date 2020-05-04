# Class notes for Zend Framework Fundamentals class help May 2020

## Homework
* For Wed 6 May
  * Install the Laminas Skeleton Project
  * See: https://docs.laminas.dev/tutorials/getting-started/skeleton-application/
  * Start under `/home/vagrant/Zend/workspaces/DefaultWorkspace`
  * When you're done, make sure you change the directory name to `onlinemarket.work`
## Resources
* Migrating from ZF to Laminas:
  * https://www.zend.com/webinars/migrating-zend-framework-laminas
* New main website:
  * https://getlaminas.org/
* Laminas skeleton app:
  * https://docs.laminas.dev/tutorials/getting-started/skeleton-application/
* Laminas MVC tool:
  * https://github.com/dbierer/laminas_tools

## Class Discussion
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

