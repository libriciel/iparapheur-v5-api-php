DOCKER=docker
EXEC_COMPOSER=$(DOCKER) run --rm -u $(shell id -u):$(shell id -g) --volume ${PWD}:/app --volume ${HOME}/.composer:/tmp -w /app composer:2
DOCKER_COMPOSE=docker compose -f docker-compose.yml
DOCKER_COMPOSE_RUN=$(DOCKER_COMPOSE) run --rm app

OPENAPI_FILE ?= openapi/iparapheur-5.1.22.json
OUTPUT_DIR ?= .
GENERATOR_IMAGE = openapitools/openapi-generator-cli

.DEFAULT_GOAL := help
.PHONY: help generate patch build build-patch

define run_php
	$(DOCKER_COMPOSE_RUN) php $(1)
endef

help: ## Afficher cette aide
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-35s\033[0m %s\n", $$1, $$2}'

# --- Environnement ---
composer-install: ## Installer les dépendances PHP
	$(EXEC_COMPOSER) composer install --ignore-platform-reqs

install: composer-install ## Alias pour composer install

build: ## Construire le conteneur
	$(DOCKER_COMPOSE) build app

bash: ## Accéder à un bash dans le conteneur
	$(DOCKER_COMPOSE) run app bash

clean: ## Supprimer les dépendances
	rm -rf vendor

phpcs: ## Vérifier le style de code
	$(DOCKER_COMPOSE_RUN) vendor/bin/phpcs

phpcbf: ## Corriger automatiquement les erreurs de style
	$(DOCKER_COMPOSE_RUN) vendor/bin/phpcbf || true

phpstan: ## Lancer l’analyse statique
	$(DOCKER_COMPOSE_RUN) vendor/bin/phpstan --xdebug

# --- OpenAPI Generator ---

generate:
	rm -rf ./lib ./docs ./test ./composer.json
	docker run --rm \
		-v "$(PWD):/local" \
		-u "$(shell id -u):$(shell id -g)" \
		$(GENERATOR_IMAGE) generate \
		-i "/local/$(OPENAPI_FILE)" \
		-g php \
		-o "/local/." \
		-p library=psr-18


patch:
	$(DOCKER_COMPOSE_RUN) ./patch/patch-generated-lib.sh


generate-and-patch: generate patch phpcbf ## Générer la librairie, construire le conteneur de patchs et appliquer les patchs

# --- Appels API via conteneur ---
list-tenants: ## Lister les tenants liés à l'utilisateur
	$(call run_php,exemples/tenant/list_tenants.php --page=$(page) --size=$(size) --sort=$(sort))

list-user-desks: ## Lister les desks de l’utilisateur pour un tenant
	$(call run_php,exemples/desk/list_user_desks.php --tenant=$(tenant) --page=$(page) --size=$(size) --sort=$(sort))

list-types: ## Lister les types (typology)
	$(call run_php,exemples/typology/list_types.php --tenant=$(tenant) --page=$(page) --size=$(size) --sort=$(sort))

list-subtypes: ## Lister les sous-types (typology)
	$(call run_php,exemples/typology/list_subtypes.php --tenant=$(tenant) --type=$(type) --page=$(page) --size=$(size) --sort=$(sort))

create-folder: ## Créer un dossier
	$(call run_php,exemples/folder/create_folder.php --tenant=$(tenant) --desk=$(desk) --folder=$(folder) --documents=$(documents))

download-folder-zip: ## Télécharger un dossier ZIP (avec PREMIS)
	$(call run_php,exemples/folder/download_folder_zip.php --tenant=$(tenant) --desk=$(desk) --folder=$(folder))

download-folder-premis: ## Télécharger uniquement le fichier PREMIS
	$(call run_php,exemples/folder/download_folder_premis.php --tenant=$(tenant) --desk=$(desk) --folder=$(folder))

list-folders: ## Lister les dossiers
	$(call run_php,exemples/folder/list_folders.php --tenant=$(tenant) --desk=$(desk) --state=$(state) --page=$(page) --size=$(size) --sort=$(sort))

delete-folder: ## Supprimer un dossier
	$(call run_php,exemples/folder/delete_folder.php --tenant=$(tenant) --desk=$(desk) --folder=$(folder))

trash-folder: ## Envoyer un dossier à la corbeille
	$(call run_php,exemples/workflow/send_to_trash_bin.php --tenant=$(tenant) --desk=$(desk) --folder=$(folder) --task=$(task))

undo-task: ## Exercer un droit de remords sur un dossier
	$(call run_php,exemples/workflow/undo_task.php --tenant=$(tenant) --desk=$(desk) --folder=$(folder) --task=$(task))

download-trashbin-folder-zip: ## Télécharger un ZIP depuis la corbeille
	$(call run_php,exemples/adminTrashBin/download_trash_bin_folder_zip.php --tenant=$(tenant) --folder=$(folder))

list-trashbin-folders: ## Lister les dossiers de la corbeille
	$(call run_php,exemples/adminTrashBin/list_trash_bin_folders.php --tenant=$(tenant) --page=$(page) --size=$(size))

delete-trashbin-folder: ## Supprimer définitivement un dossier de la corbeille
	$(call run_php,exemples/adminTrashBin/delete_trash_bin_folder.php --tenant=$(tenant) --folder=$(folder))
