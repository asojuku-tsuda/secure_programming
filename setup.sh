#!/bin/bash
# setup.sh
set -e

# 環境変数のセットアップ
cp .env.example .env
CODESPACE_URL="https://$CODESPACE_NAME-80.app.github.dev"
sed -i "s|APP_URL=http://localhost|APP_URL=$CODESPACE_URL|" .env

# 各コマンドを個別に実行し、失敗時はメッセージを表示
echo "Installing Composer dependencies..."
composer install || echo "Composer install failed, but continuing..."

echo "Generating application key..."
php artisan key:generate || echo "Key generation failed, but continuing..."

echo "Installing Yarn dependencies..."
yarn install || echo "Yarn install failed, but continuing..."

# echo "Building assets..."
# yarn run dev || echo "Asset compilation failed, but continuing..."

echo "セットアップ完了"
