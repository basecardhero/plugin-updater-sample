PLUGIN_DIR_NAME=plugin-updater-sample
TEST_DB_NAME=plugin_updater_sample_tests
TEST_DB_USER=root
TEST_DB_PASSWORD=password
TEST_DB_HOST=127.0.0.1:3306
RELEASE_PATH=./release
WORDPRESS_VERSION?=5.8

help: ## Display help
	@awk -F ':|##' \
		'/^[^\t].+?:.*?##/ {\
			printf "\033[36m%-30s\033[0m %s\n", $$1, $$NF \
}' $(MAKEFILE_LIST) | sort

setup-tests: ## Setup unit test framework.
	/bin/bash tests/bin/install-wp-tests.sh $(TEST_DB_NAME) $(TEST_DB_USER) $(TEST_DB_PASSWORD) $(TEST_DB_HOST) $(WORDPRESS_VERSION)

build-release: ## Build the plugin zip file for release.
	/bin/bash build-release.sh $(PLUGIN_DIR_NAME) ./ $(RELEASE_PATH) $(VERSION)
