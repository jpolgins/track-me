DC ?= docker-compose
RUN_PHP ?= $(DC) run --rm --no-deps app

all: build up composer-install ps
.PHONY: all

.PHONY: up
up:
		$(DC) up -d

.PHONY: build
build:
		$(DC) build

.PHONY: stop
stop:
		$(DC) stop

.PHONY: rm
rm:
		$(DC) down -v --remove-orphans
		$(DC) rm -s -v -f

.PHONY: composer-install
composer-install:
		$(DC) exec app composer install

.PHONY: composer-update
composer-update:
		$(DC) exec app composer update

.PHONY: ps
ps:
		$(DC) ps

.PHONY: ssh
ssh:
		$(DC) exec app bash

.PHONY: test
test:
		$(RUN_PHP) vendor/bin/phpunit
