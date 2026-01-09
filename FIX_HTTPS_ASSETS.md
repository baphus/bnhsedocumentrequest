# Fix: White Page / No CSS on Heroku (HTTPS Issue)

## Problem
Your app is deployed but shows a white page with no CSS. Browser console shows:
```
Blocked loading mixed active content "http://..."
```

This happens because:
- Your page is served over **HTTPS** (secure)
- But assets are being loaded over **HTTP** (insecure)
- Browsers block mixed content for security

## Quick Fix (2 Steps)

### Step 1: Set APP_URL to HTTPS on Heroku

**Option A: Use PowerShell Script (Easiest)**
```powershell
.\fix-https-assets.ps1 bnhsedocumentrequest-eff9d39b531f
```

**Option B: Manual Command**
```bash
heroku config:set APP_URL=https://bnhsedocumentrequest-eff9d39b531f.herokuapp.com -a bnhsedocumentrequest-eff9d39b531f
```

### Step 2: Clear Cache and Restart

```bash
# Clear Laravel config cache
heroku run php artisan config:clear -a bnhsedocumentrequest-eff9d39b531f

# Restart the app
heroku restart -a bnhsedocumentrequest-eff9d39b531f
```

### Step 3: Verify

Visit your app: https://bnhsedocumentrequest-eff9d39b531f.herokuapp.com

The CSS should now load correctly! ✅

## What We Fixed

### 1. Updated `AppServiceProvider.php`
- Added `URL::forceScheme('https')` for production
- This ensures all Laravel-generated URLs (including Vite assets) use HTTPS

### 2. Created Fix Script
- `fix-https-assets.ps1` - Automatically sets APP_URL to HTTPS

## Why This Happened

1. Heroku serves your app over HTTPS by default
2. But `APP_URL` was set to HTTP (or not set at all)
3. Laravel Vite uses `APP_URL` to generate asset URLs
4. So assets were generated as `http://...` instead of `https://...`
5. Browser blocks HTTP resources on HTTPS pages (mixed content)

## Alternative: Check Current Config

To see your current APP_URL:
```bash
heroku config:get APP_URL -a bnhsedocumentrequest-eff9d39b531f
```

If it shows `http://...`, that's the problem!

## Troubleshooting

### Still seeing white page?

1. **Check browser console** - Are there still HTTP errors?
2. **Verify APP_URL is set correctly:**
   ```bash
   heroku config:get APP_URL -a bnhsedocumentrequest-eff9d39b531f
   ```
   Should show: `https://bnhsedocumentrequest-eff9d39b531f.herokuapp.com`

3. **Clear all caches:**
   ```bash
   heroku run php artisan config:clear -a bnhsedocumentrequest-eff9d39b531f
   heroku run php artisan cache:clear -a bnhsedocumentrequest-eff9d39b531f
   heroku run php artisan view:clear -a bnhsedocumentrequest-eff9d39b531f
   heroku restart -a bnhsedocumentrequest-eff9d39b531f
   ```

4. **Check if assets exist:**
   ```bash
   heroku run ls -la public/build -a bnhsedocumentrequest-eff9d39b531f
   ```

5. **View source of your page** - Check if asset URLs start with `https://`

### Assets still loading over HTTP?

Make sure you've:
- ✅ Set APP_URL to HTTPS
- ✅ Cleared config cache
- ✅ Restarted the app
- ✅ Committed and deployed the AppServiceProvider changes

## Files Changed

- ✅ `app/Providers/AppServiceProvider.php` - Forces HTTPS in production
- ✅ `vite.config.js` - Updated build configuration
- 📄 `fix-https-assets.ps1` - Helper script to set APP_URL
- 📄 `FIX_HTTPS_ASSETS.md` - This documentation

## Next Steps After Fix

1. Commit the AppServiceProvider changes:
   ```bash
   git add app/Providers/AppServiceProvider.php
   git commit -m "Force HTTPS for production assets"
   git push heroku main
   ```

2. Verify everything works:
   - Visit your app
   - Check browser console (should be no errors)
   - Verify CSS is loading
   - Test all pages

## Understanding the Fix

### Before
```
Page: https://your-app.herokuapp.com (HTTPS)
Assets: http://your-app.herokuapp.com/build/... (HTTP)
Result: ❌ Browser blocks HTTP assets
```

### After
```
Page: https://your-app.herokuapp.com (HTTPS)
Assets: https://your-app.herokuapp.com/build/... (HTTPS)
Result: ✅ Everything loads correctly
```

The `URL::forceScheme('https')` in AppServiceProvider ensures that even if APP_URL is wrong, Laravel will still generate HTTPS URLs in production.
