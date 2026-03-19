# 🚀 PARANA — Quick Start Guide

## 📌 One-Line Summary
PARANA is a **cinematic real-time empathy detector dashboard** with live heart rate animations, neural data streams, and sci-fi visualizations for patient monitoring.

---

## ⚡ Quick Setup (5 minutes)

### 1️⃣ Create MySQL Database
```sql
CREATE DATABASE empathy CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 2️⃣ Install & Configure
```bash
cd d:\laragon\www\Empathy

# Install dependencies
composer install
npm install

# Generate app key
php artisan key:generate
```

### 3️⃣ Setup Database
```bash
# Run migrations
php artisan migrate

# Load sample data (18 test patients)
php artisan db:seed
```

### 4️⃣ Build Frontend
```bash
npm run dev
```
*(In another terminal, keep this running for live updates)*

### 5️⃣ Start Server
```bash
php artisan serve
```

### 6️⃣ Access Dashboard
Open your browser:
- **Main Dashboard**: http://localhost:8000/dashboard
- **Patient Details**: http://localhost:8000/patients/1

---

## 🎨 What You'll See

### Dashboard View
- 4 KPI cards (Total, High, Moderate, Low Empathy)
- Empathy distribution chart
- Recent patients list
- Live system metrics

### Patient Details Page (✨ Main Feature)
When you visit a patient (e.g., `/patients/1`), you'll see:

#### 🟢 Heart Wave Monitor
- Animated ECG pattern with green glow
- Real-time BPM display (60-100 simulation)
- Sinus rhythm status indicator

#### 🔵 Neural Data Transfer
- Blue falling matrix-style data stream
- Transfer rate (TX/RX/Sync) bars with percentages
- 4 neural processing nodes (Cortex A/B, Thalamus, Amygdala)

#### 📊 Live Metrics
- **Empathy Index**: Main empathy score (0-100)
- **Neural Sync**: Brain processing activity
- **Affect Load**: Emotional processing intensity
- **Mood Index**: Current mood visualization

#### 📈 Advanced Charts
- **Waveform Chart**: Real-time empathy fluctuations
- **12-Month Trend**: Historical empathy progression
- **Dimension Map**: Radar chart of emotional dimensions
- **Neural Radar**: 6-point polygon analysis

#### ⭕ Score Ring
- Animated SVG circle showing empathy percentage
- Emotional, Cognitive, Affective sub-gauges
- Color-coded (Amber=High, Blue=Moderate, Red=Low)

#### 🧠 Patient Intel Panel
- Full patient information
- Diagnosis, mood state, registration date
- Notes section (if added)

---

## 🎮 Interactive Features

### Real-Time Updates
- Data refreshes every 3 seconds
- Charts update smoothly with animation
- Metrics respond to patient data changes

### Animations
- **ECG Wave**: Continuous scrolling (4s loop)
- **Matrix Rain**: Falling data characters
- **Radar Sweep**: Rotating scan beam
- **Glow Effects**: Pulsing status indicators
- **Scanlines**: CRT-style overlay effect

### Colors
- 🟡 **Amber** (#f59e0b) = High Empathy / Important
- 🟢 **Green** (#00ff9f) = Active / System OK
- 🔵 **Blue** (#38bdf8) = Standard / Processing
- 🟣 **Purple** (#a78bfa) = Analysis / Deep data
- 🔴 **Red** (#f87171) = Low Empathy / Warning

---

## 📂 Key Files Modified

| File | Purpose |
|------|---------|
| `.env` | MySQL database config |
| `package.json` | Dependencies (Chart.js, GSAP) |
| `config/database.php` | Set MySQL as default |
| `app/Http/Controllers/ParanaController.php` | Added realtime metrics API |
| `routes/web.php` | Added `/api/patients/{id}/realtime` route |
| `resources/js/realtime-patient.js` | Real-time data fetching module |
| `resources/views/parana/patients/show.blade.php` | Cinematic patient details view |
| `database/seeders/PatientSeeder.php` | 18 sample patient records |

---

## 🔧 Common Commands

```bash
# Start development
composer install && npm install && npm run dev

# Run servers
php artisan serve              # Terminal 1
npm run dev                    # Terminal 2

# Database
php artisan migrate            # Run migrations
php artisan db:seed            # Load sample data
php artisan migrate:reset      # Clear all data
php artisan migrate:refresh    # Reset + migrate + seed

# Cache
php artisan cache:clear        # Clear app cache
php artisan config:clear       # Clear config cache

# Build for production
npm run build                  # Minified assets
```

---

## 📱 Adding New Patients

### Via Web Interface
1. Go to `/patients`
2. Click "Create" or "Add New"
3. Fill form:
   - Name, Age, Sex
   - Address, Email (optional), Phone (optional)
   - Diagnosis, Empathy Score (0-100)
   - Mood State, Notes
4. Submit → Automatic trend generation

### Via Artisan (CLI)
Create a custom seeder or use Tinker:
```bash
php artisan tinker
> Patient::create(['name'=>'John Doe','age'=>30,'sex'=>'Male','address'=>'123 St','empathy_score'=>75,'mood_state'=>'Calm'])
```

---

## 🎯 Testing Real-Time Updates

1. Open patient details page
2. Keep page open
3. Every 3 seconds, data refreshes:
   - BPM fluctuates ±5
   - Data transfer rate changes (1.8-4.2 GB/s)
   - Charts animate smoothly
   - Live clock updates

---

## ⚠️ If Something Doesn't Work

| Problem | Solution |
|---------|----------|
| Port 8000 in use | `php artisan serve --port=8001` |
| MySQL won't connect | Verify `.env` DB credentials, MySQL is running |
| Charts blank | `npm install` then `npm run dev` |
| Migrations fail | Check `.env` database name is `empathy` |
| Assets outdated | `npm run build` or clear browser cache |
| No test data | `php artisan db:seed` |

---

## 🌟 What's Next?

### Customization Ideas
```
✅ Add patient photos/avatars
✅ Export patient data to PDF
✅ Add more mood states
✅ Connect to real biomedical sensors
✅ Add patient search/filtering
✅ Create empathy trend reports
✅ Add multi-language support
✅ Implement dark/light theme toggle
```

### Performance Optimizations
```
✅ Cache patient data (Redis)
✅ Lazy-load charts
✅ Paginate patient lists
✅ Optimize database queries
✅ Compress assets
```

---

## 📞 Need Help?

1. **Check logs**: `tail -f storage/logs/Laravel.log`
2. **Read docs**: Open [SETUP_GUIDE.md](SETUP_GUIDE.md)
3. **Run fresh**: `php artisan migrate:refresh --seed`
4. **Clear all**: `php artisan tinker` → `Patient::truncate()`

---

## ✅ Verification Checklist

- [x] MySQL database `empathy` created
- [x] `.env` configured with MySQL
- [x] Dependencies installed (`composer install`, `npm install`)
- [x] Application key generated
- [x] Migrations run (`php artisan migrate`)
- [x] Sample data seeded (`php artisan db:seed`)
- [x] Frontend built (`npm run dev`)
- [x] Server started (`php artisan serve`)
- [x] Can access http://localhost:8000/dashboard
- [x] Can view patient at http://localhost:8000/patients/1

---

**🎉 You're all set! Enjoy the cinematic PARANA experience!**

*Questions? Errors? Check the full [SETUP_GUIDE.md](SETUP_GUIDE.md)*
