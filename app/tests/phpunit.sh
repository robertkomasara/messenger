#!/bin/bash

set -euo pipefail;

[ $# -gt 0 ] && SingleTestFileName=$1 || SingleTestFileName="";

${APP_DIR_PATH}/vendor/phpunit/phpunit/phpunit --bootstrap ${APP_DIR_PATH}/app/tests/Bootstrap.php  ${APP_DIR_PATH}/app/tests/${SingleTestFileName};