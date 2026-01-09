# Check What Was Actually Built on Heroku
# This script helps diagnose why manifest.json might be missing

Write-Host "Checking build output on Heroku..." -ForegroundColor Cyan
Write-Host ""

# Ask for app name if not provided
if ($args.Count -eq 0) {
    $APP_NAME = Read-Host "Enter your Heroku app name (e.g., bnhsedocumentrequest-eff9d39b531f)"
} else {
    $APP_NAME = $args[0]
}

Write-Host ""
Write-Host "Checking build output for: $APP_NAME" -ForegroundColor Cyan
Write-Host ""

# Check if public/build exists
Write-Host "1. Checking if public/build directory exists..." -ForegroundColor Yellow
$dirCheck = heroku run "if [ -d public/build ]; then echo 'EXISTS'; else echo 'MISSING'; fi" -a $APP_NAME 2>&1
Write-Host $dirCheck

if ($dirCheck -match "EXISTS") {
    Write-Host ""
    Write-Host "2. Listing contents of public/build..." -ForegroundColor Yellow
    heroku run "ls -la public/build" -a $APP_NAME
    
    Write-Host ""
    Write-Host "3. Checking for manifest.json..." -ForegroundColor Yellow
    $manifestCheck = heroku run "if [ -f public/build/manifest.json ]; then echo 'EXISTS'; cat public/build/manifest.json | head -20; else echo 'MISSING'; fi" -a $APP_NAME 2>&1
    Write-Host $manifestCheck
    
    Write-Host ""
    Write-Host "4. Checking for .vite directory..." -ForegroundColor Yellow
    heroku run "ls -la public/build/.vite 2>/dev/null || echo 'No .vite directory'" -a $APP_NAME
    
    Write-Host ""
    Write-Host "5. Checking for assets directory..." -ForegroundColor Yellow
    heroku run "ls -la public/build/assets 2>/dev/null || echo 'No assets directory'" -a $APP_NAME
    
    Write-Host ""
    Write-Host "6. Checking file permissions..." -ForegroundColor Yellow
    heroku run "ls -la public/build | head -10" -a $APP_NAME
} else {
    Write-Host ""
    Write-Host "ERROR: public/build directory does not exist!" -ForegroundColor Red
    Write-Host "The build did not create the output directory." -ForegroundColor Yellow
}

Write-Host ""
Write-Host "7. Checking recent build logs for errors..." -ForegroundColor Yellow
Write-Host "Run this command to see full build logs:" -ForegroundColor Gray
Write-Host "   heroku logs --tail -n 500 -a $APP_NAME | Select-String -Pattern 'vite|build|manifest|error'" -ForegroundColor Gray
Write-Host ""
