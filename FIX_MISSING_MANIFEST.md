# Fix: Build Runs But manifest.json is Missing

## The Problem
Your build runs successfully, but `manifest.json` is not created in `public/build/`. This prevents Laravel from finding the compiled assets.

## Quick Diagnosis

Run this script to see what was actually built:
```powershell
.\check-build-output.ps1 bnhsedocumentrequest-eff9d39b531f
```

Or manually check:
```bash
# See what's in the build directory
heroku run "ls -la public/build" -a bnhsedocumentrequest-eff9d39b531f

# Check if manifest exists
heroku run "test -f public/build/manifest.json && echo 'EXISTS' || echo 'MISSING'" -a bnhsedocumentrequest-eff9d39b531f

# Check build logs for errors
heroku logs --tail -n 500 -a bnhsedocumentrequest-eff9d39b531f | Select-String -Pattern "vite|build|manifest|error"
```

## Common Causes

### 1. Build Completes But Manifest Not Written
**Symptoms:** Assets are built but no manifest.json

**Fix:** The updated `vite.config.js` should fix this. Make sure to:
1. Commit the updated `vite.config.js`
2. Clear cache and redeploy:
```bash
heroku repo:purge_cache -a bnhsedocumentrequest-eff9d39b531f
git add vite.config.js
git commit -m "Fix Vite manifest generation"
git push heroku main
```

### 2. Build Fails Silently
**Symptoms:** Build appears to succeed but no output

**Check build logs:**
```bash
heroku logs --tail -a bnhsedocumentrequest-eff9d39b531f
```

Look for:
- Any error messages
- "Build completed" or "Build failed"
- Warnings about missing files

### 3. Permissions Issue
**Symptoms:** Build runs but can't write files

**Fix:** This is rare on Heroku, but you can check:
```bash
heroku run "ls -la public/build" -a bnhsedocumentrequest-eff9d39b531f
```

### 4. Wrong Output Directory
**Symptoms:** Manifest exists but in wrong location

**Check:**
```bash
# Check if manifest is in root
heroku run "find . -name manifest.json -type f" -a bnhsedocumentrequest-eff9d39b531f
```

## Solution Steps

### Step 1: Verify vite.config.js is Updated
The updated config includes:
- `manifest: true` - Explicitly enable manifest
- `emptyOutDir: true` - Clear old builds
- Explicit output configuration

### Step 2: Clear Cache and Rebuild
```bash
# Clear Heroku build cache
heroku repo:purge_cache -a bnhsedocumentrequest-eff9d39b531f

# Commit changes
git add vite.config.js
git commit -m "Fix Vite manifest generation - explicit config"

# Deploy
git push heroku main
```

### Step 3: Monitor Build
```bash
heroku logs --tail -a bnhsedocumentrequest-eff9d39b531f
```

**Watch for:**
- ✅ "vite v7.x.x building for production..."
- ✅ "building for production..."
- ✅ "Build completed"
- ✅ No errors about manifest

### Step 4: Verify Manifest Was Created
After deployment:
```bash
heroku run "cat public/build/manifest.json" -a bnhsedocumentrequest-eff9d39b531f
```

You should see JSON output with your assets listed.

## Alternative: Manual Manifest Check

If the build still doesn't create manifest.json, you can verify the build process manually:

```bash
# SSH into Heroku
heroku run bash -a bnhsedocumentrequest-eff9d39b531f

# Inside the dyno:
cd /app
npm run build
ls -la public/build
cat public/build/manifest.json
exit
```

This will show you exactly what happens during the build.

## What Changed in vite.config.js

The updated configuration:
1. **Explicit manifest generation** - `manifest: true`
2. **Clear output directory** - `emptyOutDir: true` ensures clean builds
3. **Explicit output paths** - Ensures files go to the right place
4. **Asset naming** - Consistent naming for easier debugging

## If Still Not Working

1. **Check Laravel Vite Plugin version:**
   ```bash
   heroku run "cat package.json | grep laravel-vite-plugin" -a bnhsedocumentrequest-eff9d39b531f
   ```

2. **Try building locally and comparing:**
   ```bash
   npm run build
   ls -la public/build
   cat public/build/manifest.json
   ```
   
   If it works locally but not on Heroku, there's an environment difference.

3. **Check for build errors in logs:**
   ```bash
   heroku logs --tail -n 1000 -a bnhsedocumentrequest-eff9d39b531f | Select-String -Pattern "error|fail|warn" -Context 2
   ```

4. **Verify Node version matches:**
   ```bash
   heroku run "node --version" -a bnhsedocumentrequest-eff9d39b531f
   # Should match your package.json engines.node
   ```

## Expected Build Output

After a successful build, `public/build/` should contain:
```
manifest.json          # The manifest file Laravel needs
assets/
  app-xxxxx.css        # Compiled CSS
  app-xxxxx.js         # Compiled JS
```

If you see the assets but no manifest.json, that's the specific issue we're fixing.
