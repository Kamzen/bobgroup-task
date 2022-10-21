#####How to run the projects

###Docker build
```
docker-compose build 
```

###Docker up

```
docker-compose up -d
```

###Unistall dep and install them again make sure your app container is running on your docker desktop

```
docker-compose exec app rm -rf vendor composer.lock

docker-compose exec app composer install

docker-compose exec app npm install
```

```
open the application on http://localhost:8000 on your browser
```
