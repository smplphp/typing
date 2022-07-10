# Run commands even if files exist
.PHONY: *
PACKAGE = typing

# Perform a composer install
install: composer.json
	composer install

# Perform a composer update
update: composer.json composer.lock
	composer update

# Run the PHPUnit test suite
phpunit: phpunit.xml.dist
	./vendor/bin/phpunit

# Run the PHPUnit test suite with coverage
phpunit-report: phpunit.xml.dist
	./vendor/bin/phpunit --coverage-html build/coverage

# Run the Psalm static analysis
psalm: vendor/bin/psalm psalm.xml
	./vendor/bin/psalm --no-cache --shepherd

# Run the PHPStan static analysis
phpstan: vendor/bin/phpstan phpstan.neon
	./vendor/bin/phpstan analyse -c phpstan.neon

# Run the infection mutation testing
infection: vendor/bin/infection infection.json
	./vendor/bin/infection --only-covered --threads=8

# Run the infection mutation testing
infection-report: vendor/bin/infection infection.json
	./vendor/bin/infection --only-covered --threads=8 --logger-html='build/mutation/infection.html'

# Run the full test suite
test:
	make phpunit-report infection-report psalm phpstan
