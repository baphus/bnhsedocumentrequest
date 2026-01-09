# Heroku Buildpack Setup Script (PowerShell)
# This script configures your Heroku app with the necessary buildpacks

Write-Host "Setting up Heroku buildpacks for Laravel with Vite..." -ForegroundColor Cyan
Write-Host ""

# Check if Heroku CLI is installed
$herokuExists = Get-Command heroku -ErrorAction SilentlyContinue
if (-not $herokuExists) {
    Write-Host "ERROR: Heroku CLI is not installed. Please install it first:" -ForegroundColor Red
    Write-Host "   Visit: https://devcenter.heroku.com/articles/heroku-cli" -ForegroundColor Yellow
    exit 1
}

# Ask for app name if not provided
if ($args.Count -eq 0) {
    $APP_NAME = Read-Host "Enter your Heroku app name (e.g., bnhsedocumentrequest-eff9d39b531f)"
} else {
    $APP_NAME = $args[0]
}

Write-Host ""
Write-Host "Configuring buildpacks for: $APP_NAME" -ForegroundColor Cyan
Write-Host ""

# Clear existing buildpacks
Write-Host "Clearing existing buildpacks..." -ForegroundColor Yellow
heroku buildpacks:clear -a $APP_NAME

# Add Node.js buildpack first (important for building Vite assets)
Write-Host "Adding Node.js buildpack..." -ForegroundColor Yellow
heroku buildpacks:add heroku/nodejs -a $APP_NAME

# Add PHP buildpack
Write-Host "Adding PHP buildpack..." -ForegroundColor Yellow
heroku buildpacks:add heroku/php -a $APP_NAME

Write-Host ""
Write-Host "SUCCESS: Buildpacks configured successfully!" -ForegroundColor Green
Write-Host ""
Write-Host "Current buildpacks:" -ForegroundColor Cyan
heroku buildpacks -a $APP_NAME

Write-Host ""
Write-Host "Next steps:" -ForegroundColor Cyan
Write-Host "1. Commit your changes:" -ForegroundColor White
Write-Host "   git add ." -ForegroundColor Gray
Write-Host "   git commit -m 'Fix Vite build for Heroku'" -ForegroundColor Gray
Write-Host "2. Deploy to Heroku:" -ForegroundColor White
Write-Host "   git push heroku main" -ForegroundColor Gray
Write-Host "3. Monitor deployment:" -ForegroundColor White
Write-Host "   heroku logs --tail -a $APP_NAME" -ForegroundColor Gray
Write-Host ""
Write-Host "TIP: If deployment fails, try clearing the build cache:" -ForegroundColor Yellow
Write-Host "   heroku repo:purge_cache -a $APP_NAME" -ForegroundColor Gray
