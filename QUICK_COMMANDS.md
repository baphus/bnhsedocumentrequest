# Quick Heroku Commands Reference

## Correct Syntax for `heroku run`

**❌ WRONG:**
```bash
heroku run ls -la public/build -a app-name
```
This fails because `-la` is interpreted as a flag for `heroku`, not for `ls`.

**✅ CORRECT:**
```bash
heroku run "ls -la public/build" -a app-name
```
The command must be in quotes!

## Common Commands

### Check if Build Folder Exists
```bash
heroku run "ls -la public/build" -a bnhsedocumentrequest-eff9d39b531f
```

### Check if manifest.json Exists
```bash
heroku run "test -f public/build/manifest.json && echo 'EXISTS' || echo 'MISSING'" -a bnhsedocumentrequest-eff9d39b531f
```

### List Files in Build Directory
```bash
heroku run "ls public/build" -a bnhsedocumentrequest-eff9d39b531f
```

### Check package.json
```bash
heroku run "cat package.json" -a bnhsedocumentrequest-eff9d39b531f
```

### Check Node Version
```bash
heroku run "node --version" -a bnhsedocumentrequest-eff9d39b531f
```

### Check npm Version
```bash
heroku run "npm --version" -a bnhsedocumentrequest-eff9d39b531f
```

### Run Bash Shell (Interactive)
```bash
heroku run bash -a bnhsedocumentrequest-eff9d39b531f
```

Then inside the shell:
```bash
cd /app
ls -la public/build
cat package.json
npm run build
```

## Buildpacks

### Check Buildpacks
```bash
heroku buildpacks -a bnhsedocumentrequest-eff9d39b531f
```

### Set Buildpacks
```bash
heroku buildpacks:clear -a bnhsedocumentrequest-eff9d39b531f
heroku buildpacks:add heroku/nodejs -a bnhsedocumentrequest-eff9d39b531f
heroku buildpacks:add heroku/php -a bnhsedocumentrequest-eff9d39b531f
```

## Environment Variables

### Set APP_URL
```bash
heroku config:set APP_URL=https://bnhsedocumentrequest-eff9d39b531f.herokuapp.com -a bnhsedocumentrequest-eff9d39b531f
```

### Get APP_URL
```bash
heroku config:get APP_URL -a bnhsedocumentrequest-eff9d39b531f
```

### List All Config Vars
```bash
heroku config -a bnhsedocumentrequest-eff9d39b531f
```

## Logs

### View Recent Logs
```bash
heroku logs --tail -a bnhsedocumentrequest-eff9d39b531f
```

### View Last 500 Lines
```bash
heroku logs -n 500 -a bnhsedocumentrequest-eff9d39b531f
```

### Filter Logs (PowerShell)
```powershell
heroku logs --tail -a bnhsedocumentrequest-eff9d39b531f | Select-String -Pattern "build|vite|npm"
```

## Cache & Rebuild

### Clear Build Cache
```bash
heroku repo:purge_cache -a bnhsedocumentrequest-eff9d39b531f
```

### Restart App
```bash
heroku restart -a bnhsedocumentrequest-eff9d39b531f
```

### Clear Laravel Cache
```bash
heroku run "php artisan config:clear" -a bnhsedocumentrequest-eff9d39b531f
heroku run "php artisan cache:clear" -a bnhsedocumentrequest-eff9d39b531f
heroku run "php artisan view:clear" -a bnhsedocumentrequest-eff9d39b531f
```

## Quick Diagnostic Commands

### Full Diagnostic (Run All)
```bash
# 1. Check buildpacks
heroku buildpacks -a bnhsedocumentrequest-eff9d39b531f

# 2. Check if build folder exists
heroku run "test -d public/build && echo 'EXISTS' || echo 'MISSING'" -a bnhsedocumentrequest-eff9d39b531f

# 3. Check if manifest.json exists
heroku run "test -f public/build/manifest.json && echo 'EXISTS' || echo 'MISSING'" -a bnhsedocumentrequest-eff9d39b531f

# 4. Check package.json
heroku run "cat package.json | grep heroku-postbuild" -a bnhsedocumentrequest-eff9d39b531f

# 5. Check recent build logs
heroku logs --tail -n 200 -a bnhsedocumentrequest-eff9d39b531f
```

## PowerShell-Specific Notes

In PowerShell, you can use the same commands, but for filtering logs:

**Bash (Linux/Mac):**
```bash
heroku logs --tail | grep -i "build"
```

**PowerShell (Windows):**
```powershell
heroku logs --tail | Select-String -Pattern "build"
```

## Using the Diagnostic Script

Instead of running commands manually, use the diagnostic script:

```powershell
.\diagnose-vite-build.ps1 bnhsedocumentrequest-eff9d39b531f
```

This will check everything automatically and provide recommendations.
