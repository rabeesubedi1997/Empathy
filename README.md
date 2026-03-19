# 🧠 PARANA — Empathy Detector Dashboard

A **cinematic, real-time patient monitoring system** with sci-fi aesthetics for empathy detection and visualization.

[![Laravel](https://img.shields.io/badge/Laravel-11.0-FF2D20)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-00758F)](https://mysql.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind%20CSS-4.0-38B2AC)](https://tailwindcss.com)

## 🎯 Overview

PARANA is a sophisticated healthcare dashboard showcasing:

- **Real-time Patient Monitoring**: Live heart rate waves, neural data streams, empathy metrics
- **Cinematic UI**: Deep contrasts, warm highlights, subtle shadows, sci-fi animations
- **Interactive Dashboards**: Patient registry, individual monitoring, statistical analysis
- **Dynamic Visualizations**: ECG animations, matrix data flows, radar charts, trend analysis
- **MySQL Integration**: Properly configured for local development and production deployment

## ✨ Features

### Dashboard
- 📊 4 KPI cards (Total, High/Moderate/Low empathy counts)
- 📈 Real-time empathy distribution
- 😊 Patient mood state breakdown
- 👥 Recent patient list with quick access

### Patient Details Page (Main Feature)
- ❤️ **Heart Rate Animation**: Scrolling ECG pattern with live BPM display
- 🔵 **Neural Data Transfer**: Blue matrix-style data stream with TX/RX/Sync rates
- 📊 **Real-time Metrics**: Empathy Index, Neural Sync, Affect Load, Mood Index
- 📈 **Waveform Chart**: Live empathy fluctuations
- 📉 **12-Month Trend**: Historical empathy progression
- 🎯 **Radar Chart**: Multi-dimensional emotional analysis
- ⭕ **Score Ring**: Animated SVG empathy percentage display
- 🧠 **Patient Intel**: Full profile, diagnosis, notes

### Cinematic Effects
- 🌟 Glow pulses on status indicators
- 📺 Scanline overlay effect (CRT aesthetics)
- 🎪 Matrix rain animation
- 🔴 Rotating radar sweep
- 🎬 Smooth transitions and morphing effects
- 🎨 Color-coded status system (Amber/Green/Blue/Purple/Red)

## 🛠️ Tech Stack

| Layer | Technology |
|-------|-----------|
| **Backend** | Laravel 11 (PHP 8.1+) |
| **Database** | MySQL 8.0+ |
| **Frontend** | Blade Templates, Vanilla JavaScript |
| **Styling** | Tailwind CSS 4.0 |
| **Charts** | Chart.js |
| **Animations** | CSS3 + SVG + GSAP (optional) |

## 🚀 Quick Start

### Prerequisites
- PHP 8.1+
- MySQL 8.0+
- Composer
- Node.js 16+

### Installation

```bash
# 1. Clone or navigate to project
cd d:\laragon\www\Empathy

# 2. Create MySQL database
# CREATE DATABASE empathy CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

# 3. Install dependencies
composer install
npm install

# 4. Configure environment
# Edit .env:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_DATABASE=empathy
# DB_USERNAME=root
# DB_PASSWORD=

php artisan key:generate

# 5. Setup database
php artisan migrate
php artisan db:seed

# 6. Build and serve
npm run dev          # Terminal 1 (keep running)
php artisan serve    # Terminal 2
```

### Quick Setup Script (Windows)
```bash
./setup.bat
```

### Access Application
- **Dashboard**: http://localhost:8000/dashboard
- **Patients**: http://localhost:8000/patients
- **Patient Details**: http://localhost:8000/patients/1

## 📚 Documentation

- **[QUICKSTART.md](QUICKSTART.md)** — 5-minute setup guide
- **[SETUP_GUIDE.md](SETUP_GUIDE.md)** — Comprehensive setup & deployment
- **[API Reference](#api-endpoints)** — REST endpoints for real-time data

## 📡 API Endpoints

```bash
GET  /dashboard                    # Main dashboard page
GET  /patients                     # Patient registry
GET  /patients/{id}                # Patient details (with visualizations)
POST /patients                     # Create patient
PUT  /patients/{id}                # Update patient
DELETE /patients/{id}              # Remove patient

GET  /api/dashboard/stats          # Dashboard statistics (JSON)
GET  /api/patients/{id}/empathy    # Empathy data (JSON)
GET  /api/patients/{id}/realtime   # Real-time metrics (JSON)
```

## 🎨 Color Scheme

```
🟡 Amber   #f59e0b  → High Empathy, Critical Alerts
🟢 Green   #00ff9f  → Active Systems, Live Monitoring
🔵 Blue    #38bdf8  → Neutral/Stable States
🟣 Purple  #a78bfa  → Analysis, Deep Data
🔴 Red     #f87171  → Low Empathy, Warnings
```

## 📦 Project Structure

```
empathy/
├── app/
│   ├── Http/Controllers/ParanaController.php    # Main controller
│   └── Models/Patient.php                       # Patient model
├── config/
│   └── database.php                              # MySQL config
├── database/
│   ├── migrations/2024_01_22_000001_...         # Schema
│   └── seeders/PatientSeeder.php                # Test data
├── resources/
│   ├── views/parana/
│   │   ├── dashboard.blade.php                  # Dashboard
│   │   └── patients/show.blade.php              # Patient monitor
│   ├── css/app.css                              # Styles
│   └── js/realtime-patient.js                   # Real-time module
├── routes/
│   └── web.php                                  # Route definitions
├── QUICKSTART.md                                # Quick setup
├── SETUP_GUIDE.md                               # Full guide
└── setup.bat                                    # Auto-setup (Windows)
```

## 🔧 Customization

### Adding Patient Fields
1. Create migration: `php artisan make:migration add_fields_to_patients`
2. Update `$fillable` in `Patient` model
3. Update views and forms

### Changing Empathy Thresholds
Edit [ParanaController.php](app/Http/Controllers/ParanaController.php):
```php
if ($score >= 75) return 'High Empathy';    // ← Adjust here
if ($score >= 40) return 'Moderate Empathy'; // ← Adjust here
```

### Modifying Animation Speed
Edit [show.blade.php](resources/views/parana/patients/show.blade.php):
```css
@keyframes ecg-loop {
  animation: ecg-loop 4s linear infinite; /* ← Change 4s */
}
```

## 🧪 Testing

```bash
# Run migrations fresh with seeds
php artisan migrate:refresh --seed

# Clear all data
php artisan tinker
>>> Patient::truncate()

# Add single patient
>>> Patient::create(['name'=>'John Doe','age'=>30,'sex'=>'Male','address'=>'123 St','empathy_score'=>75,'mood_state'=>'Calm'])
```

## 🚢 Deployment

### For Laragon (Local)
1. Ensure MySQL is running
2. Run `php artisan serve`
3. Frontend builds automatically with `npm run dev`

### For Production
```bash
composer install --no-dev
npm install
npm run build
php artisan migrate --force
php artisan config:cache
chmod 775 storage bootstrap/cache
```

## 🐛 Troubleshooting

| Issue | Solution |
|-------|----------|
| MySQL connection fails | Ensure MySQL is running, check `.env` credentials |
| Charts don't display | Run `npm install && npm run dev` |
| Port 8000 in use | Use `php artisan serve --port=8001` |
| Migrations fail | Verify database exists and is empty |
| No test data | Run `php artisan db:seed` |

## 📄 License

This project is a demonstration of modern healthcare UI/UX patterns built with Laravel and Tailwind CSS.

## 👨‍💻 Author

Developed with ❤️ for empathy detection and patient care monitoring.

---

**Status**: ✅ Ready for Local Development & Deployment

For detailed setup instructions, see [SETUP_GUIDE.md](SETUP_GUIDE.md)

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
