# Quick Fix for Vite Manifest Error on Heroku

## What Was the Problem?
Your Laravel app was deployed to Heroku without building the Vite assets (CSS and JavaScript). The error occurred because Laravel couldn't find the `public/build/manifest.json` file.

## What We Fixed

### 1. Updated `package.json`
- Added `heroku-postbuild` script to automatically build assets during deployment
- Added Node.js engine specifications for consistency

### 2. Updated `composer.json`
- Added `post-install-cmd` script for Laravel asset publishing

### 3. Created Helper Scripts
- `setup-heroku-buildpacks.ps1` (for Windows PowerShell)
- `setup-heroku-buildpacks.sh` (for bash/Linux/Mac)
- `HEROKU_DEPLOYMENT.md` (detailed documentation)

## Steps to Deploy

### Step 1: Configure Heroku Buildpacks

**Option A: Use the PowerShell script (Recommended for Windows)**

```powershell
.\setup-heroku-buildpacks.ps1 bnhsedocumentrequest-eff9d39b531f
```

**Option B: Manual configuration**

```bash
# Clear existing buildpacks
heroku buildpacks:clear -a bnhsedocumentrequest-eff9d39b531f

# Add Node.js buildpack (MUST be first)
heroku buildpacks:add heroku/nodejs -a bnhsedocumentrequest-eff9d39b531f

# Add PHP buildpack
heroku buildpacks:add heroku/php -a bnhsedocumentrequest-eff9d39b531f

# Verify
heroku buildpacks -a bnhsedocumentrequest-eff9d39b531f
```

### Step 2: Commit and Deploy

```bash
# Stage all changes
git add .

# Commit
git commit -m "Fix Vite manifest issue for Heroku deployment"

# Deploy to Heroku
git push heroku main
```

If you're deploying from a different branch:
```bash
git push heroku your-branch-name:main
```

### Step 3: Monitor Deployment

```bash
heroku logs --tail -a bnhsedocumentrequest-eff9d39b531f
```

Watch for:
- ✅ "Building dependencies" (Node.js installing packages)
- ✅ "Running heroku-postbuild" (Vite building assets)
- ✅ "Build succeeded" (Assets compiled successfully)

### Step 4: Verify Fix

Visit your app: https://bnhsedocumentrequest-eff9d39b531f.herokuapp.com

The Vite manifest error should be gone! 🎉

## If It Still Doesn't Work

### 1. Check Build Logs
```bash
heroku logs --tail -a bnhsedocumentrequest-eff9d39b531f
```

### 2. Clear Build Cache
```bash
heroku repo:purge_cache -a bnhsedocumentrequest-eff9d39b531f
git commit --allow-empty -m "Rebuild with cleared cache"
git push heroku main
```

### 3. Verify Buildpacks Order
```bash
heroku buildpacks -a bnhsedocumentrequest-eff9d39b531f
```

Should show:
```
=== bnhsedocumentrequest-eff9d39b531f Buildpack URLs
1. heroku/nodejs
2. heroku/php
```

### 4. Check if Assets Were Built
```bash
heroku run ls -la public/build -a bnhsedocumentrequest-eff9d39b531f
```

You should see `manifest.json` and compiled JS/CSS files.

## Understanding the Fix

### Before
1. Git push to Heroku
2. PHP buildpack installs Composer dependencies
3. App runs but can't find Vite assets ❌

### After
1. Git push to Heroku
2. **Node.js buildpack runs first**
3. **npm install installs dependencies**
4. **heroku-postbuild runs `npm run build`**
5. **Vite compiles assets to public/build/**
6. PHP buildpack installs Composer dependencies
7. App runs with compiled assets ✅

## Files Changed

- ✅ `package.json` - Added heroku-postbuild script and Node.js version
- ✅ `composer.json` - Added post-install-cmd script
- 📄 `HEROKU_DEPLOYMENT.md` - Detailed deployment guide
- 📄 `QUICK_FIX.md` - This file
- 📄 `setup-heroku-buildpacks.ps1` - PowerShell setup script
- 📄 `setup-heroku-buildpacks.sh` - Bash setup script

## Need Help?

Check the detailed documentation in `HEROKU_DEPLOYMENT.md` for:
- Troubleshooting steps
- Production optimizations
- Alternative deployment methods
