# Diagnose and Fix Vite Build Issues on Heroku
# This script checks buildpacks, verifies assets, and helps fix issues

Write-Host "Diagnosing Vite build issues on Heroku..." -ForegroundColor Cyan
Write-Host ""

# Ask for app name if not provided
if ($args.Count -eq 0) {
    $APP_NAME = Read-Host "Enter your Heroku app name (e.g., bnhsedocumentrequest-eff9d39b531f)"
} else {
    $APP_NAME = $args[0]
}

Write-Host ""
Write-Host "Checking configuration for: $APP_NAME" -ForegroundColor Cyan
Write-Host ""

# Check 1: Buildpacks
Write-Host "1. Checking buildpacks..." -ForegroundColor Yellow
$buildpacks = heroku buildpacks -a $APP_NAME
Write-Host $buildpacks

$hasNode = $buildpacks -match "nodejs"
$hasPhp = $buildpacks -match "php"
$nodeFirst = $buildpacks -match "1.*nodejs"

if (-not $hasNode -or -not $hasPhp -or -not $nodeFirst) {
    Write-Host ""
    Write-Host "WARNING: Buildpacks not configured correctly!" -ForegroundColor Red
    Write-Host "Fixing buildpacks..." -ForegroundColor Yellow
    heroku buildpacks:clear -a $APP_NAME
    heroku buildpacks:add heroku/nodejs -a $APP_NAME
    heroku buildpacks:add heroku/php -a $APP_NAME
    Write-Host "Buildpacks fixed!" -ForegroundColor Green
} else {
    Write-Host "Buildpacks OK" -ForegroundColor Green
}

Write-Host ""

# Check 2: Check if build folder exists
Write-Host "2. Checking if assets were built..." -ForegroundColor Yellow
$buildCheck = heroku run "test -d public/build && echo 'EXISTS' || echo 'MISSING'" -a $APP_NAME 2>&1

if ($buildCheck -match "MISSING") {
    Write-Host "ERROR: public/build folder does not exist!" -ForegroundColor Red
    Write-Host "The build did not run or failed." -ForegroundColor Yellow
    $needsRebuild = $true
} else {
    Write-Host "Build folder exists" -ForegroundColor Green

    # Check for manifest.json
    Write-Host "Checking for manifest.json..." -ForegroundColor Yellow
    $manifestCheck = heroku run "test -f public/build/manifest.json && echo 'EXISTS' || echo 'MISSING'" -a $APP_NAME 2>&1

    if ($manifestCheck -match "MISSING") {
        Write-Host "ERROR: manifest.json is missing!" -ForegroundColor Red
        $needsRebuild = $true
    } else {
        Write-Host "manifest.json exists" -ForegroundColor Green
    }
}

Write-Host ""

# Check 3: Verify package.json has heroku-postbuild
Write-Host "3. Checking package.json configuration..." -ForegroundColor Yellow
$packageJson = heroku run "cat package.json" -a $APP_NAME 2>&1

if ($packageJson -match "heroku-postbuild") {
    Write-Host "package.json has heroku-postbuild script" -ForegroundColor Green
} else {
    Write-Host "WARNING: package.json missing heroku-postbuild!" -ForegroundColor Red
    Write-Host "Make sure your local package.json has:" -ForegroundColor Yellow
    Write-Host '  "heroku-postbuild": "npm run build"' -ForegroundColor Gray
    $needsRebuild = $true
}

Write-Host ""

# Summary and recommendations
Write-Host "=== DIAGNOSIS SUMMARY ===" -ForegroundColor Cyan
Write-Host ""

if ($needsRebuild) {
    Write-Host "ACTION REQUIRED: Assets need to be rebuilt" -ForegroundColor Red
    Write-Host ""
    Write-Host "Recommended fix:" -ForegroundColor Yellow
    Write-Host "1. Clear build cache:" -ForegroundColor White
    Write-Host "   heroku repo:purge_cache -a $APP_NAME" -ForegroundColor Gray
    Write-Host ""
    Write-Host "2. Trigger rebuild:" -ForegroundColor White
    Write-Host "   git commit --allow-empty -m 'Trigger rebuild'" -ForegroundColor Gray
    Write-Host "   git push heroku main" -ForegroundColor Gray
    Write-Host ""
    Write-Host "3. Monitor build:" -ForegroundColor White
    Write-Host "   heroku logs --tail -a $APP_NAME" -ForegroundColor Gray
    Write-Host ""
    Write-Host "Look for 'Running heroku-postbuild' in the logs" -ForegroundColor Yellow
} else {
    Write-Host "Configuration looks good!" -ForegroundColor Green
    Write-Host ""
    Write-Host "If you're still seeing errors, try:" -ForegroundColor Yellow
    Write-Host "1. heroku restart -a $APP_NAME" -ForegroundColor Gray
    Write-Host "2. Check recent logs: heroku logs --tail -a $APP_NAME" -ForegroundColor Gray
}

Write-Host ""
