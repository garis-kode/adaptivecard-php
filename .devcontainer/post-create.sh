#!/usr/bin/env bash
set -euo pipefail

echo "::step::installing composer dependencies"
composer install

echo "::step::configuring xdebug"
sudo cp .devcontainer/xdebug.ini /usr/local/etc/php/conf.d/zz-xdebug-devcontainer.ini

echo "::step::installing antigravity cli"
curl -fsSL https://antigravity.google/cli/install.sh | bash

echo "::step::done"
