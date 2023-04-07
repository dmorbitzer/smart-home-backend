# Smart Home Backend App

## Local Environment

### Software
* **Docker**: 4.17.0
* **Symfony CLI:** 4.25.5
* **Composer:** 2.5.4

### Developing
##Docker
### Start Docker cluster
```
cd docker
docker-compose -p smart-home up -d --build
```
Starts the Server at localhost port 8080

##### Importand endpoints
* **API:** http://127.0.0.1:8080/api -> API Documentation
* **GraphQL:** http://127.0.0.1:8080/api/graphql -> Graphql playground

Use the command without the -d flag to the process in the foreground
### Restart Docker cluster
```
docker restart php nginx db rabbitmq
```
#### Shut down Docker cluster
```
docker stop php nginx db rabbitmq
```
### Run commands on the Docker container
Start a new Terminal inside the container:
```
docker exec -ti php /bin/bash
```

### Database
Connect to the database container using the following credentials:
* **host:** localhost
* **port:** 3307
* **username:** user
* **password:** password

### RabbitMQ
Backend URL: http://localhost:15673/

Credentials:
* **username:** guest
* **password:** guest

## Start development server without Docker
``symfony server:start``

Starts a local server at http://127.0.0.1:8000
### Testing
#### Run Unit and Integration Tests:
``bin/phpunit``
#### Run linter:
``./vendor/bin/grumphp run``