init: docker-down docker-build docker-up

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down --remove-orphans

docker-build:
	docker-compose build

migrate:
	docker-compose exec php-fpm php vendor/bin/phinx migrate

composer-update:
	docker-compose exec php-fpm composer update --prefer-dist
