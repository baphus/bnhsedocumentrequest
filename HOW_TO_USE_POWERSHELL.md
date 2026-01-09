# How to Use PowerShell to Run the Setup Script

## Quick Start Guide

### Step 1: Open PowerShell

**Option A: From File Explorer (Easiest)**
1. Navigate to your project folder: `C:\Users\JKsars\Herd\bnhsedocumentrequest\bnhs-edocumentrequest`
2. Click in the address bar at the top
3. Type `powershell` and press Enter
4. PowerShell will open in that directory! ✅

**Option B: From Start Menu**
1. Press `Windows Key` or click Start
2. Type `PowerShell`
3. Click on "Windows PowerShell" or "PowerShell"
4. Navigate to your project:
   ```powershell
   cd C:\Users\JKsars\Herd\bnhsedocumentrequest\bnhs-edocumentrequest
   ```

**Option C: Right-click in File Explorer**
1. Navigate to your project folder
2. Hold `Shift` and right-click in an empty area
3. Select "Open PowerShell window here"

### Step 2: Check Execution Policy (If Needed)

If you get an error like "cannot be loaded because running scripts is disabled", run this first:

```powershell
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
```

Type `Y` when prompted and press Enter.

### Step 3: Run the Script

**Method 1: With App Name (Recommended)**
```powershell
.\setup-heroku-buildpacks.ps1 bnhsedocumentrequest-eff9d39b531f
```

**Method 2: Without App Name (Script will ask you)**
```powershell
.\setup-heroku-buildpacks.ps1
```

Then enter your app name when prompted: `bnhsedocumentrequest-eff9d39b531f`

### Step 4: What to Expect

The script will:
1. ✅ Check if Heroku CLI is installed
2. ✅ Clear existing buildpacks
3. ✅ Add Node.js buildpack (first)
4. ✅ Add PHP buildpack (second)
5. ✅ Show you the configured buildpacks
6. ✅ Give you next steps

## Common PowerShell Commands You Might Need

### Navigate to Your Project
```powershell
cd C:\Users\JKsars\Herd\bnhsedocumentrequest\bnhs-edocumentrequest
```

### Check Current Directory
```powershell
pwd
# or
Get-Location
```

### List Files in Current Directory
```powershell
ls
# or
dir
# or
Get-ChildItem
```

### Run a PowerShell Script
```powershell
.\script-name.ps1
```

### Run with Parameters
```powershell
.\script-name.ps1 parameter1 parameter2
```

## Troubleshooting

### Error: "cannot be loaded because running scripts is disabled"

**Solution:**
```powershell
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
```

### Error: "heroku: command not found"

**Solution:** Install Heroku CLI first:
- Visit: https://devcenter.heroku.com/articles/heroku-cli
- Download and install for Windows
- Restart PowerShell after installation

### Error: "The term '.\setup-heroku-buildpacks.ps1' is not recognized"

**Possible causes:**
1. You're not in the correct directory
   - Fix: `cd C:\Users\JKsars\Herd\bnhsedocumentrequest\bnhs-edocumentrequest`
2. The file doesn't exist
   - Fix: Check with `ls` or `dir` to see if the file is there
3. Typo in filename
   - Fix: Use tab completion - type `.\setup` and press Tab

### Script Runs But Heroku Commands Fail

**Check if you're logged in:**
```powershell
heroku auth:whoami
```

**If not logged in:**
```powershell
heroku login
```

## Alternative: Manual Commands (If Script Doesn't Work)

If you prefer to run commands manually, here's what the script does:

```powershell
# Set your app name
$APP_NAME = "bnhsedocumentrequest-eff9d39b531f"

# Clear existing buildpacks
heroku buildpacks:clear -a $APP_NAME

# Add Node.js buildpack (MUST be first)
heroku buildpacks:add heroku/nodejs -a $APP_NAME

# Add PHP buildpack
heroku buildpacks:add heroku/php -a $APP_NAME

# Verify
heroku buildpacks -a $APP_NAME
```

## Visual Guide

```
┌─────────────────────────────────────────┐
│ 1. Open PowerShell in project folder    │
│    (Right-click + Shift → PowerShell)   │
└─────────────────────────────────────────┘
                    ↓
┌─────────────────────────────────────────┐
│ 2. Run the script                       │
│    .\setup-heroku-buildpacks.ps1        │
│    bnhsedocumentrequest-eff9d39b531f    │
└─────────────────────────────────────────┘
                    ↓
┌─────────────────────────────────────────┐
│ 3. Wait for script to complete          │
│    (You'll see colored output)          │
└─────────────────────────────────────────┘
                    ↓
┌─────────────────────────────────────────┐
│ 4. Follow the "Next steps" shown       │
│    (Commit and deploy)                  │
└─────────────────────────────────────────┘
```

## Quick Reference

| Task | Command |
|------|---------|
| Open PowerShell in folder | `Shift + Right-click` → "Open PowerShell here" |
| Navigate to project | `cd C:\Users\JKsars\Herd\bnhsedocumentrequest\bnhs-edocumentrequest` |
| Run script | `.\setup-heroku-buildpacks.ps1 bnhsedocumentrequest-eff9d39b531f` |
| Check Heroku login | `heroku auth:whoami` |
| Fix execution policy | `Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser` |
| List files | `ls` or `dir` |
| Show current folder | `pwd` |

## Need More Help?

- **PowerShell Documentation**: https://docs.microsoft.com/en-us/powershell/
- **Heroku CLI Docs**: https://devcenter.heroku.com/articles/heroku-cli
- **Laravel Deployment**: See `HEROKU_DEPLOYMENT.md` in this project
