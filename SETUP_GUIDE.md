# 🧠 PARANA — Empathy Detector Dashboard
## Complete Setup & Deployment Guide

### 📋 Project Overview
PARANA (Empathy Detector) is a cinematic, real-time patient monitoring system built with:
- **Backend**: Laravel 11 (PHP)
- **Frontend**: Blade Templates + Vanilla JavaScript
- **Styling**: Tailwind CSS 4 + Custom Animations
- **Database**: MySQL 8.0+
- **Visualizations**: Chart.js + Custom SVG Animations

---

## ⚙️ Prerequisites
Before starting, ensure you have:
- **PHP**: 8.1+ (Check: `php --version`)
- **MySQL**: 8.0+ (Check: `mysql --version`)
- **Composer**: Latest (Check: `composer --version`)
- **Node.js**: 16+ (Check: `node --version`)
- **Laragon** or similar PHP development environment

---

## 🚀 Step-by-Step Local Setup

### Step 1: Database Configuration
```bash
# 1. Open your MySQL client (MySQL Workbench, Laragon Console, or CLI)
# 2. Create the database
CREATE DATABASE empathy CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

# 3. Verify creation
SHOW DATABASES;
```

### Step 2: Laravel Configuration
Navigate to your project directory:
```bash
cd d:\laragon\www\Empathy
```

Verify `.env` has MySQL settings:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=empathy
DB_USERNAME=root
DB_PASSWORD=
```

### Step 3: Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install

# Clear cache
php artisan cache:clear
php artisan config:clear
```

### Step 4: Generate Application Key
```bash
php artisan key:generate
```

### Step 5: Run Database Migrations
```bash
# Run all migrations
php artisan migrate --force

# Seed sample patient data (optional)
php artisan db:seed
```

### Step 6: Build Frontend Assets
```bash
# Development mode with hot reload
npm run dev

# OR Production build
npm run build
```

### Step 7: Start the Development Server
```bash
# Option A: Using Laravel's built-in server
php artisan serve

# Option B: Using Laragon (automatic)
# Just access via browser: http://empathy.test or http://localhost:8000
```

---

## 🌐 Accessing the Dashboard

Once the server is running:

1. **Main Dashboard**
   - URL: `http://localhost:8000/dashboard`
   - Shows: Total patients, empathy distribution, mood breakdown

2. **Patient Detail Page** (with real-time visualizations)
   - URL: `http://localhost:8000/patients/{id}`
   - Example: `http://localhost:8000/patients/1`
   - Shows: Heart wave animation, data transfer visualization, neural graphs

3. **Admin Login** (if authentication is needed)
   - URL: `http://localhost:8000/admin/login`
   - Default credentials may need to be set (check migration seeders)

---

## 📊 Real-Time Monitoring Features

### Heart Rate Wave Animation (❤ Cardiac Empathy Wave)
- **What it shows**: Simulates ECG/heart rate variation based on empathy score
- **Animation**: Continuous scrolling green waveform (ECG pattern)
- **Updates**: Every second with realistic BPM variation (60-100 range)
- **Cinematic effects**: Glow, scanline overlay, pulsing indicator

### Neural Data Transfer Visualization (⇅ Data Transfer)
- **What it shows**: Bi-directional data flow (TX/RX/Sync)
- **Animation**: Falling matrix-style data stream in blue
- **Updates**: Real-time transfer rate display (1.8-4.2 GB/s simulation)
- **Nodes**: 4 neural centers (Cortex A/B, Thalamus, Amygdala) with activity levels

### Empathy Metrics
- **Empathy Index**: Primary score display (0-100)
- **Neural Sync**: Processing intensity percentage
- **Affect Load**: Emotional processing load
- **Mood Index**: Current mood state visualization

### Advanced Visualizations
1. **Empathy Waveform Chart**: Real-time line graph of empathy fluctuations
2. **12-Month Trend**: Longitudinal empathy score history
3. **Dimension Map**: Radar chart showing emotional, cognitive, affective dimensions
4. **Neural Radar**: Spinning radar visualization with 6-point polygon

---

## 🎨 Cinematic Design Elements

### Color Scheme
```
🟡 Amber (#f59e0b)    — High empathy, system alerts
🟢 Green (#00ff9f)    — Active systems, live monitoring  
🔵 Blue (#38bdf8)     — Neutral/stable systems
🟣 Purple (#a78bfa)   — Dimensional analysis
🔴 Red (#f87171)      — Low empathy, warnings
```

### Animation Styles
- **ECG Wave**: Continuous smooth scroll
- **Scanline**: Horizontal transparency lines moving top-to-bottom
- **Glow Pulse**: Breathing effect on status indicators
- **Matrix Rain**: Falling characters (data transfer)
- **Radar Sweep**: Rotating scan beam
- **Ring Rotation**: Nested rotating circles on avatar

### Glass Morphism
- Frosted glass effect with 4% opacity + 20px blur
- Subtle inner shadows and borders
- Color-coded border tints per section

---

## 🔧 Troubleshooting

### Issue: "SQLSTATE[HY000] [2002] No such file or directory"
**Solution**: MySQL is not running. Start MySQL service:
```bash
# Windows (if using MySQL Service)
net start MySQL80

# Laragon: Click the MySQL icon or use services
```

### Issue: "Exception: Driver not found"
**Solution**: Check PHP extensions. Ensure `php.ini` has:
```ini
extension=mysqli
extension=pdo_mysql
```

### Issue: Charts/animations not showing
**Solution**: Rebuild frontend assets:
```bash
npm install
npm run dev
```

### Issue: "No application encryption key has been specified"
**Solution**: Generate application key:
```bash
php artisan key:generate
```

### Issue: Cannot connect to database
**Solution**: Verify credentials in `.env`:
```bash
# Test connection
php artisan tinker
>>> DB::connection()->getPdo()
```

---

## 📝 API Endpoints

### Patient Management
- `GET /api/dashboard/stats` — Dashboard statistics
- `GET /api/patients/{id}/empathy` — Patient empathy data
- `GET /api/patients/{id}/realtime` — Real-time metrics

### Real-time Format
```json
{
  "patient": {
    "id": 1,
    "name": "John Doe",
    "age": 45,
    "sex": "Male",
    "address": "123 Main St",
    "mood": "Calm",
    "empathy_score": 78
  },
  "heartRateWave": [70, 72, 71, ...],
  "dataTransfer": {
    "received": 350,
    "sent": 200,
    "nodes": [...]
  },
  "indicators": [
    {"label": "Empathy Wave", "value": 78, "unit": "%", "status": "high"}
  ],
  "timeline": [
    {"month": "Jan", "score": 65, "patients": 12}
  ],
  "timestamp": "2024-01-22T10:30:00Z"
}
```

---

## 🎯 Customization Guide

### Changing Empathy Score Ranges
Edit [ParanaController.php](app/Http/Controllers/ParanaController.php):
```php
// Line ~33
if ($score >= 75) return 'High Empathy';    // ← Adjust threshold
if ($score >= 40) return 'Moderate Empathy'; // ← Adjust threshold
```

### Modifying Animation Speeds
Edit [show.blade.php](resources/views/parana/patients/show.blade.php):
```css
@keyframes ecg-loop {
  animation: ecg-loop 4s linear infinite; /* ← Change 4s for speed */
}
```

### Adding New Patient Fields
1. Create migration: `php artisan make:migration add_fields_to_patients`
2. Add fields in migration
3. Update `$fillable` in Patient model
4. Update forms and views

---

## 📦 Deployment to Production

### For Laravel Forge or Manual VPS:
```bash
# 1. Clone repository
git clone <repo-url>
cd Empathy

# 2. Setup environment
cp .env.example .env
php artisan key:generate

# 3. Configure database
# Edit .env with production database credentials

# 4. Install dependencies
composer install --no-dev
npm install
npm run build

# 5. Run migrations
php artisan migrate --force

# 6. Set permissions
chmod 775 storage bootstrap/cache

# 7. Setup web server (Nginx/Apache)
# Point to /public directory
```

---

## 📞 Support & Troubleshooting

If you encounter issues:

1. **Check logs**: `storage/logs/Laravel.log`
2. **Clear cache**: `php artisan cache:clear`
3. **Reset database**: `php artisan migrate:refresh --seed`
4. **Verify Node/Composer**: Run `npm list` and `composer show`

---

## 🎓 Learning Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Chart.js Docs](https://www.chartjs.org/)
- [Tailwind CSS](https://tailwindcss.com/)
- [SVG Animations](https://developer.mozilla.org/en-US/docs/Web/SVG)

---

## 📄 License & Credits

PARANA © 2024 — Built with ❤️ for empathy detection and patient monitoring.

---

**Last Updated**: January 22, 2024
**Status**: ✅ Ready for Local Development
