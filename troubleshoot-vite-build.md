# Troubleshoot: Vite Manifest Not Found on Heroku

## Quick Diagnosis

Run these commands to check what's wrong:

```bash
# 1. Check if buildpacks are configured correctly
heroku buildpacks -a bnhsedocumentrequest-eff9d39b531f

# 2. Check if assets were built
heroku run "ls -la public/build" -a bnhsedocumentrequest-eff9d39b531f

# 3. Check recent build logs
heroku logs --tail -n 500 -a bnhsedocumentrequest-eff9d39b531f | grep -i "build\|vite\|npm"
```

## Common Issues & Fixes

### Issue 1: Buildpacks Not Configured or Wrong Order

**Check:**
```bash
heroku buildpacks -a bnhsedocumentrequest-eff9d39b531f
```

**Should show:**
```
1. heroku/nodejs
2. heroku/php
```

**If not, fix it:**
```bash
heroku buildpacks:clear -a bnhsedocumentrequest-eff9d39b531f
heroku buildpacks:add heroku/nodejs -a bnhsedocumentrequest-eff9d39b531f
heroku buildpacks:add heroku/php -a bnhsedocumentrequest-eff9d39b531f
```

### Issue 2: Build Folder Doesn't Exist

**Check:**
```bash
heroku run "ls -la public/build" -a bnhsedocumentrequest-eff9d39b531f
```

**If it says "No such file or directory", the build didn't run.**

**Fix:**
1. Check build logs for errors
2. Clear cache and rebuild:
```bash
heroku repo:purge_cache -a bnhsedocumentrequest-eff9d39b531f
git commit --allow-empty -m "Trigger rebuild"
git push heroku main
```

### Issue 3: Build Failed Silently

**Check build logs:**
```bash
heroku logs --tail -a bnhsedocumentrequest-eff9d39b531f
```

Look for:
- "Running heroku-postbuild"
- "npm run build"
- Any error messages

**Common build errors:**
- Missing dependencies
- Node version mismatch
- Build script errors

### Issue 4: package.json Missing heroku-postbuild

**Verify:**
```bash
heroku run cat package.json -a bnhsedocumentrequest-eff9d39b531f | grep heroku-postbuild
```

**Should show:**
```json
"heroku-postbuild": "npm run build"
```

If not, make sure your local `package.json` has it and commit it.

## Step-by-Step Fix

### Step 1: Verify Buildpacks
```bash
heroku buildpacks -a bnhsedocumentrequest-eff9d39b531f
```

If Node.js isn't first, run:
```bash
.\setup-heroku-buildpacks.ps1 bnhsedocumentrequest-eff9d39b531f
```

### Step 2: Clear Cache and Rebuild
```bash
# Clear Heroku build cache
heroku repo:purge_cache -a bnhsedocumentrequest-eff9d39b531f

# Create empty commit to trigger rebuild
git commit --allow-empty -m "Trigger rebuild with cleared cache"

# Deploy
git push heroku main
```

### Step 3: Monitor Build Process
```bash
heroku logs --tail -a bnhsedocumentrequest-eff9d39b531f
```

**Watch for:**
- ✅ "Installing node modules"
- ✅ "Running heroku-postbuild"
- ✅ "Building for production..."
- ✅ "Build completed"

### Step 4: Verify Assets Were Built
```bash
heroku run "ls -la public/build" -a bnhsedocumentrequest-eff9d39b531f
```

**Should show:**
```
manifest.json
assets/
  app-xxxxx.css
  app-xxxxx.js
```

### Step 5: If Still Not Working - Manual Build

As a last resort, you can manually build and verify:

```bash
# SSH into Heroku dyno
heroku run bash -a bnhsedocumentrequest-eff9d39b531f

# Then inside the dyno:
cd /app
npm install
npm run build
ls -la public/build
exit
```

## Verify Your package.json

Make sure your `package.json` has:

```json
{
  "scripts": {
    "build": "vite build",
    "dev": "vite",
    "heroku-postbuild": "npm run build"
  },
  "engines": {
    "node": "20.x",
    "npm": "10.x"
  }
}
```

## Check Deployment Logs

After deploying, check the logs for the build process:

```bash
heroku logs --tail -a bnhsedocumentrequest-eff9d39b531f
```

Look for these sections:
1. **Node.js buildpack** - Installing dependencies
2. **heroku-postbuild** - Running build script
3. **PHP buildpack** - Installing Composer dependencies

If you don't see "Running heroku-postbuild", the build didn't run.

## Alternative: Build Locally and Commit (Temporary Fix)

If you can't get the build to work on Heroku, you can temporarily commit the built assets:

```bash
# Remove /public/build from .gitignore temporarily
# Edit .gitignore and comment out: /public/build

# Build locally
npm run build

# Commit built assets
git add public/build
git commit -m "Add built assets (temporary)"
git push heroku main
```

**⚠️ Warning:** This is not recommended for production, but can work as a temporary fix.

## Still Having Issues?

1. **Check Node version compatibility:**
   ```bash
   heroku run node --version -a bnhsedocumentrequest-eff9d39b531f
   ```

2. **Check npm version:**
   ```bash
   heroku run npm --version -a bnhsedocumentrequest-eff9d39b531f
   ```

3. **Verify package.json is committed:**
   ```bash
   git log --oneline -5
   # Make sure package.json changes are in recent commits
   ```

4. **Check if there are any build errors in logs:**
   ```bash
   heroku logs --tail -a bnhsedocumentrequest-eff9d39b531f | grep -i error
   ```
