run: down 
	docker-compose up -d --build
	docker-compose exec app composer install
	make status

down:
	docker-compose down
	make status

status:
	docker-compose ps -a

install:
	cp .env.example .env
	docker-compose up -d --build

uninstall:
	cd .. && rm -rf teste-evolke 

