<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display TV Masjid - {{ $masjidName }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --bg-dark: #041B19;
            --bg-card: #08332F;
            --bg-card-active: #0F5A53;
            --primary: #0D9488;
            --accent: #2DD4BF;
            --gold: #F59E0B;
            --gold-light: #FDE68A;
            --text-light: #F8FAFC;
            --text-dim: #94A3B8;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            background: radial-gradient(circle at 50% 20%, #083A35 0%, #031412 100%);
            color: var(--text-light);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            min-height: 100vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            user-select: none;
        }

        /* Header TV */
        .tv-header {
            background: rgba(4, 27, 25, 0.75);
            backdrop-filter: blur(12px);
            border-bottom: 2px solid rgba(45, 212, 191, 0.25);
            padding: 1.25rem 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .mosque-brand h1 {
            font-size: 2.2rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            color: #fff;
            margin-bottom: 0.2rem;
            text-transform: uppercase;
        }
        .mosque-brand p {
            color: var(--accent);
            font-size: 1.05rem;
            font-weight: 500;
        }

        .clock-display {
            text-align: right;
        }
        .time-box {
            font-size: 3.2rem;
            font-weight: 900;
            font-variant-numeric: tabular-nums;
            letter-spacing: 2px;
            color: var(--gold-light);
            line-height: 1;
            text-shadow: 0 0 20px rgba(245, 158, 11, 0.4);
        }
        .date-box {
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--text-dim);
            margin-top: 0.35rem;
        }

        /* Main Content */
        .tv-body {
            flex: 1;
            padding: 2rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 2rem;
        }

        /* Next Prayer Alert Banner */
        .next-prayer-banner {
            background: rgba(13, 148, 136, 0.2);
            border: 1px solid rgba(45, 212, 191, 0.4);
            border-radius: 16px;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            backdrop-filter: blur(8px);
        }

        /* 6 Prayer Times Row */
        .prayer-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 1.25rem;
        }
        .prayer-card {
            background: var(--bg-card);
            border: 1px solid rgba(45, 212, 191, 0.15);
            border-radius: 20px;
            padding: 1.5rem 1rem;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 8px 24px rgba(0,0,0,0.3);
            position: relative;
            overflow: hidden;
        }
        .prayer-card.active {
            background: linear-gradient(135deg, #0F766E 0%, #115E59 100%);
            border: 2px solid var(--accent);
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 14px 32px rgba(45, 212, 191, 0.3);
        }
        .prayer-card.active::before {
            content: "SELANJUTNYA";
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            background: var(--gold);
            color: #000;
            font-size: 0.65rem;
            font-weight: 800;
            letter-spacing: 1px;
            padding: 2px 10px;
            border-radius: 0 0 8px 8px;
        }
        .prayer-name {
            font-size: 1.25rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-dim);
            margin-bottom: 0.75rem;
        }
        .prayer-card.active .prayer-name {
            color: #fff;
        }
        .prayer-time {
            font-size: 2.6rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: 1px;
            font-variant-numeric: tabular-nums;
        }
        .prayer-card.active .prayer-time {
            color: var(--gold-light);
            text-shadow: 0 0 15px rgba(245, 158, 11, 0.5);
        }

        /* Widgets Row (Khatib + Saldo Kas + Pengajian) */
        .info-grid {
            display: grid;
            grid-template-columns: 1.2fr 1.5fr 1.3fr;
            gap: 1.25rem;
        }
        .info-card {
            background: rgba(8, 51, 47, 0.6);
            border: 1px solid rgba(45, 212, 191, 0.15);
            border-radius: 16px;
            padding: 1.25rem 1.5rem;
            backdrop-filter: blur(6px);
        }
        .info-card-title {
            font-size: 0.9rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--accent);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Running Text Marquee Footer */
        .tv-footer {
            background: #020F0D;
            border-top: 1px solid rgba(45, 212, 191, 0.2);
            padding: 0.75rem 0;
            display: flex;
            align-items: center;
            overflow: hidden;
            white-space: nowrap;
        }
        .marquee-label {
            background: var(--primary);
            color: #fff;
            font-weight: 800;
            font-size: 0.85rem;
            padding: 0.4rem 1.25rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            z-index: 10;
            box-shadow: 4px 0 12px rgba(0,0,0,0.5);
        }
        .marquee-content {
            display: inline-block;
            padding-left: 100%;
            animation: marquee 35s linear infinite;
            font-size: 1.15rem;
            font-weight: 600;
            color: var(--text-light);
        }
        .marquee-item {
            margin-right: 4rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        @keyframes marquee {
            0% { transform: translate(0, 0); }
            100% { transform: translate(-100%, 0); }
        }

        /* Fullscreen Overlay Iqomah */
        #iqomahOverlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(3, 18, 16, 0.95);
            z-index: 9999;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .iqomah-countdown {
            font-size: 8rem;
            font-weight: 900;
            color: var(--gold);
            text-shadow: 0 0 40px rgba(245, 158, 11, 0.6);
            font-variant-numeric: tabular-nums;
        }
    </style>
</head>
<body>

<!-- Header Display TV -->
<header class="tv-header">
    <div class="mosque-brand">
        <h1>{{ $masjidName }}</h1>
        <p><i class="bi bi-geo-alt-fill me-1"></i> {{ $masjidAddress }}</p>
    </div>
    <div class="clock-display">
        <div class="time-box" id="liveClock">00:00:00</div>
        <div class="date-box" id="liveDate">Memuat tanggal...</div>
    </div>
</header>

<!-- Body Content -->
<main class="tv-body">
    <!-- Banner Info Waktu Selanjutnya -->
    <div class="next-prayer-banner">
        <div class="d-flex align-items-center gap-3">
            <span class="badge bg-warning text-dark px-3 py-2 fw-800 fs-6 rounded-pill">WAKTU BERIKUTNYA</span>
            <span class="fs-4 fw-700" id="nextPrayerName">Menghitung...</span>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="text-muted fw-semibold">Menuju Adzan:</span>
            <span class="fs-3 fw-900 text-warning" id="nextPrayerCountdown">00:00:00</span>
        </div>
    </div>

    <!-- 6 Jadwal Sholat Offline -->
    <div class="prayer-grid">
        <div class="prayer-card" id="card-imsak">
            <div class="prayer-name">Imsak</div>
            <div class="prayer-time" id="time-imsak">--:--</div>
        </div>
        <div class="prayer-card" id="card-subuh">
            <div class="prayer-name">Subuh</div>
            <div class="prayer-time" id="time-subuh">--:--</div>
        </div>
        <div class="prayer-card" id="card-terbit">
            <div class="prayer-name">Syuruq</div>
            <div class="prayer-time" id="time-terbit">--:--</div>
        </div>
        <div class="prayer-card" id="card-dzuhur">
            <div class="prayer-name">Dzuhur</div>
            <div class="prayer-time" id="time-dzuhur">--:--</div>
        </div>
        <div class="prayer-card" id="card-ashar">
            <div class="prayer-name">Ashar</div>
            <div class="prayer-time" id="time-ashar">--:--</div>
        </div>
        <div class="prayer-card" id="card-maghrib">
            <div class="prayer-name">Maghrib</div>
            <div class="prayer-time" id="time-maghrib">--:--</div>
        </div>
        <div class="prayer-card" id="card-isya">
            <div class="prayer-name">Isya'</div>
            <div class="prayer-time" id="time-isya">--:--</div>
        </div>
    </div>

    <!-- 3 Widget Informasi Bawah -->
    <div class="info-grid">
        <!-- Kas Masjid Terkini -->
        <div class="info-card">
            <div class="info-card-title"><i class="bi bi-wallet2"></i> Saldo Kas Terkini</div>
            <div class="fs-3 fw-800 text-success mt-2">Rp {{ number_format($totalBalance, 0, ',', '.') }}</div>
            <div class="text-muted small mt-1">
                @foreach($cashBooks as $cb)
                    <span class="me-2">{{ $cb->name }}: <strong>Rp {{ number_format($cb->balance(), 0, ',', '.') }}</strong></span>
                @endforeach
            </div>
        </div>

        <!-- Khatib Shalat Jumat -->
        <div class="info-card">
            <div class="info-card-title"><i class="bi bi-person-badge"></i> Khatib Jumat ({{ $upcomingFriday->translatedFormat('d M Y') }})</div>
            @if($fridayKhatib)
                <div class="fs-5 fw-700 text-white mt-1">{{ $fridayKhatib->khatib_name }}</div>
                <div class="text-warning small mt-1"><i class="bi bi-book me-1"></i> {{ $fridayKhatib->theme ?: 'Tema Khutbah Menyesuaikan' }}</div>
            @else
                <div class="text-muted small mt-2">Jadwal khatib akan segera diumumkan.</div>
            @endif
        </div>

        <!-- Kajian / Pengajian Terdekat -->
        <div class="info-card">
            <div class="info-card-title"><i class="bi bi-calendar-event"></i> Kajian Mendatang</div>
            @forelse($upcomingPengajian as $k)
                <div class="small text-white text-truncate mt-1">
                    <strong class="text-accent">{{ $k->ustadz }}:</strong> {{ $k->topic }}
                </div>
            @empty
                <div class="text-muted small mt-2">Belum ada agenda kajian pekan ini.</div>
            @endforelse
        </div>
    </div>
</main>

<!-- Running Text Marquee -->
<footer class="tv-footer">
    <div class="marquee-label">Warta Masjid</div>
    <div class="marquee-content">
        <span class="marquee-item"><i class="bi bi-info-circle-fill text-warning"></i> {{ $runningText }}</span>
        <span class="marquee-item"><i class="bi bi-cash-coin text-success"></i> Saldo Kas Total Masjid: Rp {{ number_format($totalBalance, 0, ',', '.') }}</span>
        <span class="marquee-item"><i class="bi bi-moon-stars text-accent"></i> Mari luruskan dan rapatkan shaf saat shalat berjamaah.</span>
    </div>
</footer>

<!-- Overlay Hitung Mundur Iqomah -->
<div id="iqomahOverlay">
    <h1 class="display-3 fw-900 text-white mb-2" id="iqomahTitle">WAKTU ADZAN TIBA</h1>
    <p class="fs-4 text-accent mb-4">Mempersiapkan Shalat Berjamaah</p>
    <div class="iqomah-countdown" id="iqomahTimer">10:00</div>
    <p class="fs-4 text-warning mt-4 fw-bold" id="iqomahInstruction">Menuju Iqomah — Silakan Laksanakan Shalat Sunnah Qabliyah</p>
</div>

<script>
/**
 * Standalone Offline Prayer Time Calculation (Standar Hisab Kemenag RI / MABIMS)
 * Bekerja 100% offline tanpa perlu koneksi internet atau API pihak ketiga.
 */
const LATITUDE = {{ $latitude }};
const LONGITUDE = {{ $longitude }};
const IQOMAH_MINUTES = {{ $iqomahMinutes }};

function toRad(deg) { return deg * Math.PI / 180; }
function toDeg(rad) { return rad * 180 / Math.PI; }

function calculatePrayerTimes(date, lat, lng) {
    const year = date.getFullYear();
    const month = date.getMonth() + 1;
    const day = date.getDate();

    // Julian Date
    const a = Math.floor((14 - month) / 12);
    const y = year + 4800 - a;
    const m = month + 12 * a - 3;
    const jd = day + Math.floor((153 * m + 2) / 5) + 365 * y + Math.floor(y / 4) - Math.floor(y / 100) + Math.floor(y / 400) - 32045;

    const d = jd - 2451545.0; // Days since J2000.0

    // Solar coordinates
    const g = 357.529 + 0.98560028 * d;
    const q = 280.459 + 0.98564736 * d;
    const L = q + 1.915 * Math.sin(toRad(g)) + 0.020 * Math.sin(toRad(2 * g));
    const e = 23.439 - 0.00000036 * d;

    const RA = toDeg(Math.atan2(Math.cos(toRad(e)) * Math.sin(toRad(L)), Math.cos(toRad(L)))) / 15;
    const D = toDeg(Math.asin(Math.sin(toRad(e)) * Math.sin(toRad(L)))); // Declination
    const EqT = q / 15 - RA; // Equation of time

    // Timezone Indonesia Barat default (UTC+7)
    const timezone = 7;
    const noon = 12 + timezone - (lng / 15) - EqT;

    // Kemenag standard angles: Subuh -20°, Isya -18°, Zenith 90.8333°
    function sunAngleTime(angle, isAfterNoon) {
        const cosH = (Math.sin(toRad(-angle)) - Math.sin(toRad(lat)) * Math.sin(toRad(D))) / (Math.cos(toRad(lat)) * Math.cos(toRad(D)));
        if (cosH > 1 || cosH < -1) return null;
        const H = toDeg(Math.acos(cosH)) / 15;
        return isAfterNoon ? noon + H : noon - H;
    }

    // Ashar (Shafi'i: shadow length factor 1)
    const asrAngle = -toDeg(Math.atan(1 + Math.tan(toRad(Math.abs(lat - D)))));
    const asrTime = sunAngleTime(asrAngle, true);

    const subuhHours = sunAngleTime(20, false);
    const sunriseHours = sunAngleTime(0.8333, false);
    const maghribHours = sunAngleTime(0.8333, true);
    const isyaHours = sunAngleTime(18, true);

    // Ihtiyat (safety margin 2 minutes standard Kemenag)
    const ihtiyat = 2 / 60;

    function formatTime(decimalHour) {
        if (decimalHour === null) return "--:--";
        let h = Math.floor(decimalHour);
        let m = Math.floor((decimalHour - h) * 60);
        if (m >= 60) { h++; m -= 60; }
        return String(h).padStart(2, '0') + ':' + String(m).padStart(2, '0');
    }

    return {
        imsak: formatTime(subuhHours - 10 / 60 + ihtiyat),
        subuh: formatTime(subuhHours + ihtiyat),
        terbit: formatTime(sunriseHours - ihtiyat),
        dzuhur: formatTime(noon + ihtiyat),
        ashar: formatTime(asrTime + ihtiyat),
        maghrib: formatTime(maghribHours + ihtiyat),
        isya: formatTime(isyaHours + ihtiyat)
    };
}

// Runtime TV Clock & Schedule Loop
let prayerTimesToday = null;

function updateClock() {
    const now = new Date();
    const h = String(now.getHours()).padStart(2, '0');
    const m = String(now.getMinutes()).padStart(2, '0');
    const s = String(now.getSeconds()).padStart(2, '0');
    document.getElementById('liveClock').textContent = `${h}:${m}:${s}`;

    const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    const months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    document.getElementById('liveDate').textContent = `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;

    // Recalculate daily prayer times if null
    if (!prayerTimesToday) {
        prayerTimesToday = calculatePrayerTimes(now, LATITUDE, LONGITUDE);
        document.getElementById('time-imsak').textContent = prayerTimesToday.imsak;
        document.getElementById('time-subuh').textContent = prayerTimesToday.subuh;
        document.getElementById('time-terbit').textContent = prayerTimesToday.terbit;
        document.getElementById('time-dzuhur').textContent = prayerTimesToday.dzuhur;
        document.getElementById('time-ashar').textContent = prayerTimesToday.ashar;
        document.getElementById('time-maghrib').textContent = prayerTimesToday.maghrib;
        document.getElementById('time-isya').textContent = prayerTimesToday.isya;
    }

    updateNextPrayer(now);
}

function timeStringToDate(timeStr) {
    const [h, m] = timeStr.split(':').map(Number);
    const d = new Date();
    d.setHours(h, m, 0, 0);
    return d;
}

function updateNextPrayer(now) {
    if (!prayerTimesToday) return;

    const list = [
        { key: 'subuh', name: 'Subuh', time: timeStringToDate(prayerTimesToday.subuh) },
        { key: 'terbit', name: 'Syuruq', time: timeStringToDate(prayerTimesToday.terbit) },
        { key: 'dzuhur', name: 'Dzuhur', time: timeStringToDate(prayerTimesToday.dzuhur) },
        { key: 'ashar', name: 'Ashar', time: timeStringToDate(prayerTimesToday.ashar) },
        { key: 'maghrib', name: 'Maghrib', time: timeStringToDate(prayerTimesToday.maghrib) },
        { key: 'isya', name: 'Isya\'', time: timeStringToDate(prayerTimesToday.isya) }
    ];

    let next = null;
    for (const item of list) {
        if (item.time > now) {
            next = item;
            break;
        }
    }

    // Jika sudah lewat Isya, target berikutnya adalah Subuh besok
    if (!next) {
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        const tomorrowTimes = calculatePrayerTimes(tomorrow, LATITUDE, LONGITUDE);
        const subuhTomorrow = timeStringToDate(tomorrowTimes.subuh);
        subuhTomorrow.setDate(subuhTomorrow.getDate() + 1);
        next = { key: 'subuh', name: 'Subuh (Besok)', time: subuhTomorrow };
    }

    // Set Active Card Highlight
    document.querySelectorAll('.prayer-card').forEach(c => c.classList.remove('active'));
    const activeCard = document.getElementById(`card-${next.key}`);
    if (activeCard) activeCard.classList.add('active');

    // Countdown
    document.getElementById('nextPrayerName').textContent = next.name + ` (${prayerTimesToday[next.key] || ''})`;
    const diffMs = next.time - now;
    const diffSec = Math.floor(diffMs / 1000);
    const ch = String(Math.floor(diffSec / 3600)).padStart(2, '0');
    const cm = String(Math.floor((diffSec % 3600) / 60)).padStart(2, '0');
    const cs = String(diffSec % 60).padStart(2, '0');
    document.getElementById('nextPrayerCountdown').textContent = `${ch}:${cm}:${cs}`;

    // Check Iqomah trigger (misal saat waktu sholat tiba s/d 10 menit setelahnya)
    checkIqomahState(now, list);
}

function checkIqomahState(now, list) {
    const overlay = document.getElementById('iqomahOverlay');
    let isInIqomah = false;

    // Fardhu prayers only for iqomah
    const fardhu = ['subuh', 'dzuhur', 'ashar', 'maghrib', 'isya'];

    for (const item of list) {
        if (!fardhu.includes(item.key)) continue;

        const prayerTime = item.time.getTime();
        const nowTime = now.getTime();
        const diffMinutes = (nowTime - prayerTime) / (1000 * 60);

        if (diffMinutes >= 0 && diffMinutes <= IQOMAH_MINUTES) {
            isInIqomah = true;
            const remainingSec = Math.floor((IQOMAH_MINUTES * 60) - ((nowTime - prayerTime) / 1000));
            const rm = String(Math.floor(remainingSec / 60)).padStart(2, '0');
            const rs = String(remainingSec % 60).padStart(2, '0');

            document.getElementById('iqomahTitle').textContent = `ADZAN ${item.name.toUpperCase()} TELAH TIBA`;
            document.getElementById('iqomahTimer').textContent = `${rm}:${rs}`;
            if (remainingSec <= 10) {
                document.getElementById('iqomahInstruction').textContent = "IQOMAH TELAH TIBA — LURUSKAN DAN RAPATKAN SHAF";
            }
            break;
        }
    }

    overlay.style.display = isInIqomah ? 'flex' : 'none';
}

// 1-Click Fullscreen toggle on click or key 'F'
window.addEventListener('keydown', e => {
    if (e.key === 'f' || e.key === 'F') {
        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen().catch(() => {});
        } else {
            document.exitFullscreen().catch(() => {});
        }
    }
});

setInterval(updateClock, 1000);
updateClock();
</script>

</body>
</html>
