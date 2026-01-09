# Fix HTTPS Assets Issue on Heroku
# This script sets the APP_URL to HTTPS to fix mixed content errors

Write-Host "Fixing HTTPS assets issue on Heroku..." -ForegroundColor Cyan
Write-Host ""

# Ask for app name if not provided
if ($args.Count -eq 0) {
    $APP_NAME = Read-Host "Enter your Heroku app name (e.g., bnhsedocumentrequest-eff9d39b531f)"
} else {
    $APP_NAME = $args[0]
}

Write-Host ""
Write-Host "Setting APP_URL to HTTPS for: $APP_NAME" -ForegroundColor Cyan
Write-Host ""

# Set APP_URL to HTTPS
$HTTPS_URL = "https://$APP_NAME.herokuapp.com"
Write-Host "Setting APP_URL=$HTTPS_URL" -ForegroundColor Yellow
heroku config:set APP_URL=$HTTPS_URL -a $APP_NAME

Write-Host ""
Write-Host "SUCCESS: APP_URL configured!" -ForegroundColor Green
Write-Host ""
Write-Host "Current APP_URL:" -ForegroundColor Cyan
heroku config:get APP_URL -a $APP_NAME

Write-Host ""
Write-Host "Next steps:" -ForegroundColor Cyan
Write-Host "1. Clear Laravel config cache:" -ForegroundColor White
Write-Host "   heroku run php artisan config:clear -a $APP_NAME" -ForegroundColor Gray
Write-Host "2. Restart your app:" -ForegroundColor White
Write-Host "   heroku restart -a $APP_NAME" -ForegroundColor Gray
Write-Host "3. Visit your app and check if CSS loads correctly" -ForegroundColor White
Write-Host ""
