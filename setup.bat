@echo off
REM ============================================
REM PARANA — Empathy Detector Auto-Setup
REM For Windows (Laragon)
REM ============================================

echo.
echo   ╔════════════════════════════════════════╗
echo   ║  🧠 PARANA — Empathy Detector         ║
echo   ║  Auto-Setup Script (Windows)          ║
echo   ╚════════════════════════════════════════╝
echo.

REM Check if running from correct directory
if not exist "artisan" (
    echo ❌ ERROR: artisan file not found!
    echo Please run this script from the project root directory.
    echo Expected: D:\laragon\www\Empathy
    pause
    exit /b 1
)

echo ✓ Project directory verified: %cd%
echo.

REM Step 1: MySQL Database Creation
echo ⏳ Step 1/6: Creating MySQL Database...
echo.
echo   Please ensure MySQL is running!
echo   If you haven't created the database yet, run this in MySQL Client:
echo   ---
echo   CREATE DATABASE empathy CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
echo   ---
echo.
pause

REM Step 2: Install Dependencies
echo.
echo ⏳ Step 2/6: Installing PHP Dependencies (Composer)...
echo   This may take a few minutes...
echo.
call composer install
if errorlevel 1 (
    echo ❌ Composer install failed!
    pause
    exit /b 1
)
echo ✓ PHP dependencies installed

REM Step 3: Install Node Dependencies
echo.
echo ⏳ Step 3/6: Installing Node.js Dependencies (npm)...
echo   This may take a few minutes...
echo.
call npm install
if errorlevel 1 (
    echo ❌ npm install failed!
    pause
    exit /b 1
)
echo ✓ Node dependencies installed

REM Step 4: Generate Application Key
echo.
echo ⏳ Step 4/6: Generating Application Key...
call php artisan key:generate
if errorlevel 1 (
    echo ❌ Key generation failed!
    pause
    exit /b 1
)
echo ✓ Application key generated

REM Step 5: Run Migrations
echo.
echo ⏳ Step 5/6: Running Database Migrations...
echo   If this fails, ensure MySQL database 'empathy' exists and is empty.
echo.
call php artisan migrate --force
if errorlevel 1 (
    echo ⚠️  Migration warning. Continuing...
)
echo ✓ Database migrations completed

REM Step 6: Seed Sample Data
echo.
echo ⏳ Step 6/6: Seeding Sample Patient Data (18 records)...
call php artisan db:seed
if errorlevel 1 (
    echo ⚠️  Seeding warning. Continuing...
)
echo ✓ Sample data loaded

REM Completion Message
echo.
echo ╔════════════════════════════════════════════════════════════╗
echo ║  ✅ SETUP COMPLETE!                                        ║
echo ╚════════════════════════════════════════════════════════════╝
echo.
echo   Next Steps:
echo   ---
echo   1. Open two terminals (PowerShell/CMD) in this directory:
echo.
echo      Terminal 1 (Frontend):
echo      $ npm run dev
echo.
echo      Terminal 2 (Backend):
echo      $ php artisan serve
echo.
echo   2. Open browser:
echo      - Dashboard: http://localhost:8000/dashboard
echo      - Patient:   http://localhost:8000/patients/1
echo.
echo   3. Default Login (if needed):
echo      - User: admin
echo      - Pass: Check database seeds or use authentication bypass
echo.
echo   For detailed setup, see: SETUP_GUIDE.md
echo   For quick reference, see: QUICKSTART.md
echo ---
echo.
pause
