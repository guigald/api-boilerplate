#!/bin/bash

docker exec -it app bash cp contrib/pre-commit .git/hooks/pre-commit
docker exec -it app bash chmod +x .git/hooks/pre-commit
