# Smart Home Backend App

## Local Environment

### Software
* **Docker**: 4.17.0

### Developing
### Start development server
``symfony server:start``

Starts a local server at http://127.0.0.1:8000
#### Importand endpoints
* **API:** http://127.0.0.1:8000/api -> API Documentation
* **GraphQL:** http://127.0.0.1:8000/ap/graphql -> Graphql playground
### Testing
#### Run Unit and Integration Tests:
``bin/phpunit``
#### Run linter:
``./vendor/bin/grumphp run``