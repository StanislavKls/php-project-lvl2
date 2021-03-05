install:
	composer install
validate:
	composer validate
lint:
	composer run-script phpcs -- --standard=PSR12 src bin
test:
	composer run-script test
test-coverage:
	composer run-script --verbose phpunit tests -- --coverage-clover build/logs/clover.xml
