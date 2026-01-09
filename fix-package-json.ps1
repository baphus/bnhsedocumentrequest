# Fix Corrupted package.json on Heroku
# This script verifies local package.json and helps redeploy it

Write-Host "Fixing corrupted package.json on Heroku..." -ForegroundColor Cyan
Write-Host ""

# Ask for app name if not provided
if ($args.Count -eq 0) {
    $APP_NAME = Read-Host "Enter your Heroku app name (e.g., bnhsedocumentrequest-eff9d39b531f)"
} else {
    $APP_NAME = $args[0]
}

Write-Host ""
Write-Host "Checking local package.json..." -ForegroundColor Yellow

# Verify local package.json is valid
try {
    $packageJson = Get-Content "package.json" -Raw
    $json = $packageJson | ConvertFrom-Json
    Write-Host "Local package.json is valid JSON" -ForegroundColor Green
    
    # Check for required fields
    if ($json.scripts.'heroku-postbuild') {
        Write-Host "heroku-postbuild script found" -ForegroundColor Green
    } else {
        Write-Host "WARNING: heroku-postbuild script missing!" -ForegroundColor Red
    }
    
    if ($json.engines.node) {
        Write-Host "Node engine specified: $($json.engines.node)" -ForegroundColor Green
    } else {
        Write-Host "WARNING: Node engine not specified!" -ForegroundColor Yellow
    }
    
} catch {
    Write-Host "ERROR: Local package.json is invalid JSON!" -ForegroundColor Red
    Write-Host $_.Exception.Message -ForegroundColor Red
    exit 1
}

Write-Host ""
Write-Host "Checking if package.json is in git..." -ForegroundColor Yellow

# Check if package.json is tracked by git
$gitStatus = git status package.json 2>&1
if ($gitStatus -match "not staged" -or $gitStatus -match "modified") {
    Write-Host "WARNING: package.json has uncommitted changes!" -ForegroundColor Yellow
    Write-Host "You should commit it before deploying." -ForegroundColor Yellow
} else {
    Write-Host "package.json is tracked by git" -ForegroundColor Green
}

Write-Host ""
Write-Host "=== FIX STEPS ===" -ForegroundColor Cyan
Write-Host ""
Write-Host "1. Make sure package.json is committed:" -ForegroundColor White
Write-Host "   git add package.json" -ForegroundColor Gray
Write-Host "   git commit -m 'Fix package.json - ensure valid JSON'" -ForegroundColor Gray
Write-Host ""
Write-Host "2. Clear Heroku build cache:" -ForegroundColor White
Write-Host "   heroku repo:purge_cache -a $APP_NAME" -ForegroundColor Gray
Write-Host ""
Write-Host "3. Deploy to Heroku:" -ForegroundColor White
Write-Host "   git push heroku main" -ForegroundColor Gray
Write-Host ""
Write-Host "4. Verify package.json on Heroku after deployment:" -ForegroundColor White
Write-Host "   heroku run `"cat package.json`" -a $APP_NAME" -ForegroundColor Gray
Write-Host ""
Write-Host "5. Monitor the build:" -ForegroundColor White
Write-Host "   heroku logs --tail -a $APP_NAME" -ForegroundColor Gray
Write-Host ""
Write-Host "Look for 'Installing node modules' and 'Running heroku-postbuild'" -ForegroundColor Yellow
Write-Host ""
