# Heroku Deployment Guide for Laravel with Vite

## Issue Fixed
The `ViteManifestNotFoundException` error has been resolved by configuring Heroku to build Vite assets during deployment.

## Changes Made

1. **package.json**: Added `heroku-postbuild` script to build Vite assets during Heroku deployment
2. **composer.json**: Added `post-install-cmd` script for Laravel asset publishing

## Deployment Steps

### 1. Ensure Buildpacks are Configured

Your Heroku app needs both Node.js and PHP buildpacks. Run these commands:

```bash
# Add Node.js buildpack (must be first to run npm build before PHP)
heroku buildpacks:add --index 1 heroku/nodejs

# Add PHP buildpack
heroku buildpacks:add heroku/php
```

Verify buildpacks:
```bash
heroku buildpacks
```

Expected output:
```
1. heroku/nodejs
2. heroku/php
```

### 2. Set Node.js Version (Optional but Recommended)

Add to your `package.json`:

```json
"engines": {
  "node": "20.x",
  "npm": "10.x"
}
```

### 3. Configure Environment Variables

Make sure your Heroku app has the necessary environment variables:

```bash
heroku config:set APP_ENV=production
heroku config:set APP_DEBUG=false
heroku config:set APP_KEY=your-app-key
heroku config:set LOG_CHANNEL=errorlog
```

### 4. Deploy to Heroku

```bash
git add .
git commit -m "Fix Vite manifest issue for Heroku deployment"
git push heroku main
```

Or if you're using a different branch:
```bash
git push heroku your-branch:main
```

## How It Works

1. When you push to Heroku, the Node.js buildpack runs first
2. It installs npm dependencies and runs `heroku-postbuild` script
3. `npm run build` compiles your Vite assets to `public/build/`
4. The PHP buildpack then runs and serves your application
5. Your app can now find the `manifest.json` file in `public/build/`

## Troubleshooting

### If you still see the error after deployment:

1. **Check build logs:**
   ```bash
   heroku logs --tail
   ```

2. **Verify buildpacks order:**
   ```bash
   heroku buildpacks
   ```
   Node.js must be listed before PHP.

3. **Check if build folder exists:**
   ```bash
   heroku run ls -la public/build
   ```
   You should see `manifest.json` and asset files.

4. **Clear build cache and redeploy:**
   ```bash
   heroku repo:purge_cache -a your-app-name
   git commit --allow-empty -m "Rebuild with cleared cache"
   git push heroku main
   ```

### Alternative: Commit Built Assets (Not Recommended)

If you cannot get the build process working on Heroku, you can commit the built assets:

1. Remove `/public/build` from `.gitignore`
2. Build assets locally: `npm run build`
3. Commit the built files: `git add public/build && git commit -m "Add built assets"`
4. Deploy: `git push heroku main`

**Note:** This approach is not recommended because:
- It bloats your repository
- You must remember to rebuild before every deployment
- Can cause merge conflicts

## Production Optimization

For better performance in production, consider adding to `vite.config.js`:

```javascript
export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        manifest: true,
        outDir: 'public/build',
        rollupOptions: {
            output: {
                manualChunks: undefined,
            },
        },
    },
});
```

## Additional Resources

- [Laravel Vite Documentation](https://laravel.com/docs/vite)
- [Heroku Node.js Support](https://devcenter.heroku.com/articles/nodejs-support)
- [Heroku PHP Support](https://devcenter.heroku.com/articles/php-support)
