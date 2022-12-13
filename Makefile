DOCKER=docker
EXEC_COMPOSER=$(DOCKER) run --rm --volume ${PWD}:/app --volume ${HOME}/.composer:/tmp -it composer:2
DOCKER_COMPOSE=docker compose -f docker-compose.yml
DOCKER_COMPOSE_RUN=$(DOCKER_COMPOSE) run app
.DEFAULT_GOAL := help
.PHONY: help

help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

composer-install: ## Run composer install
	$(EXEC_COMPOSER) composer install --ignore-platform-reqs

install: composer-install ## Alias for composer install

build: ## Build the container
	$(DOCKER_COMPOSE) build app

bash: ## Get a bash console
	$(DOCKER_COMPOSE) run app bash

clean: ## Clear and remove dependencies
	rm -rf vendor

test: phpcs phpunit ## Run all tests (code style, unit test, ...)

phpcs:## Check code style through docker-compose
	$(DOCKER_COMPOSE_RUN) vendor/bin/phpcs

phpcbf: ## Fix all code style errors
	$(DOCKER_COMPOSE_RUN) vendor/bin/phpcbf

phpunit: ## Run unit test through docker-compose
	$(DOCKER_COMPOSE_RUN) vendor/bin/phpunit

phpstan: ## Run phpstan through docker-compose
	$(DOCKER_COMPOSE_RUN) vendor/bin/phpstan --xdebug
