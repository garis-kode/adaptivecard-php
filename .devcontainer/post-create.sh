#!/usr/bin/env bash
set -euo pipefail

echo "::step::installing composer dependencies"
composer install

echo "::step::installing antigravity cli"
curl -fsSL https://antigravity.google/cli/install.sh | bash

echo "::step::done"
