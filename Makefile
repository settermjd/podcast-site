all: cs test

.PHONY: setup composer coverage cs test unit integration database .env
composer:
	composer validate
	composer update

cs: composer
	vendor/bin/php-cs-fixer fix --config=.php_cs --verbose --diff

test:
	bin/codecept run

