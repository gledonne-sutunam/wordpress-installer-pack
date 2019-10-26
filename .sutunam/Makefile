# Variables
SSH_DEV:=crouzet.dev7.sutunam.info@crouzet.dev7.sutunam.info
DEV_DB:=crouzet_dev7_sutunam_info

#SSH_PROD:=
#PROD_DB :=

THEME_FOLDER := wp-content/themes/crouzet/

# Common jobs
ssh_dev:
	ssh $(SSH_DEV)

ssh_prod:
	ssh $(SSH_PROD)


# Environment update:
import_dev:
	bash ./.sutunam/import.sh --ssh $(SSH_DEV) --ssh-database $(DEV_DB)

import_prod:
	bash ./.sutunam/import.sh --ssh $(SSH_PROD) --ssh-database $(PROD_DB)

media_sync_prod:
	rsync -av $(SSH_PROD):public_html/wp-content/uploads/ ./wp-content/uploads/

media_sync_dev:
	rsync -av $(SSH_DEV):public_html/wp-content/uploads/ ./wp-content/uploads/

# Frontend
front_npm_install:
	cd $(THEME_FOLDER) && \
	npm install

front_watch:
	cd $(THEME_FOLDER) && \
	gulp watch

front_build:
	cd $(THEME_FOLDER) && \
	gulp

front_optimize_img:
	cd $(THEME_FOLDER) && \
	gulp optimizeImages

front_sass_lint:
	cd $(THEME_FOLDER) && \
	gulp sassLint

front_sass_lint_fix:
	cd $(THEME_FOLDER) && \
	npm run lint:fix

# Code quality
phpcs:
	phpcs --standard=WordPress --colors $(THEME_FOLDER) --ignore=js/,node_modules/,*.css,*.scss,*.js

phpcbf:
	phpcbf --standard=WordPress $(THEME_FOLDER) --ignore=js/,node_modules/,*.css,*.scss,*.js
