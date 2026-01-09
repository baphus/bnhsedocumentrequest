#!/bin/bash

# Heroku Buildpack Setup Script
# This script configures your Heroku app with the necessary buildpacks

echo "🚀 Setting up Heroku buildpacks for Laravel with Vite..."
echo ""

# Check if Heroku CLI is installed
if ! command -v heroku &> /dev/null
then
    echo "❌ Heroku CLI is not installed. Please install it first:"
    echo "   Visit: https://devcenter.heroku.com/articles/heroku-cli"
    exit 1
fi

# Ask for app name if not provided
if [ -z "$1" ]; then
    echo "📝 Enter your Heroku app name (e.g., bnhsedocumentrequest-eff9d39b531f):"
    read -r APP_NAME
else
    APP_NAME=$1
fi

echo ""
echo "🔧 Configuring buildpacks for: $APP_NAME"
echo ""

# Clear existing buildpacks
echo "Clearing existing buildpacks..."
heroku buildpacks:clear -a "$APP_NAME"

# Add Node.js buildpack first (important for building Vite assets)
echo "Adding Node.js buildpack..."
heroku buildpacks:add heroku/nodejs -a "$APP_NAME"

# Add PHP buildpack
echo "Adding PHP buildpack..."
heroku buildpacks:add heroku/php -a "$APP_NAME"

echo ""
echo "✅ Buildpacks configured successfully!"
echo ""
echo "Current buildpacks:"
heroku buildpacks -a "$APP_NAME"

echo ""
echo "📋 Next steps:"
echo "1. Commit your changes: git add . && git commit -m 'Fix Vite build for Heroku'"
echo "2. Deploy to Heroku: git push heroku main"
echo "3. Monitor deployment: heroku logs --tail -a $APP_NAME"
echo ""
echo "💡 Tip: If deployment fails, try clearing the build cache:"
echo "   heroku repo:purge_cache -a $APP_NAME"
