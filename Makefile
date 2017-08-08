install: 
	composer install && \
	cd public && npm install 

test: 
	phpunit tests/mytestsuite.php

gulp:
	cd public && \
	npm run gulp
