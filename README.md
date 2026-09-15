# Prayer

A Laravel community site for salah, remembrance, and beneficial knowledge. Members can check prayer times, keep a daily prayer streak, use worship tools, and publish articles.

## Features

### Worship

- **Prayer times** — Today’s Fajr, Dhuhr, Asr, Maghrib and Isha with a live countdown to the next prayer. Uses device location when allowed, or a city and country you choose.
- **Hijri date** — The Islamic date is shown with the timetable and on a dedicated calendar page.
- **Qibla compass** — Points toward the Kaaba from your current coordinates.
- **Digital tasbih** — Tap counter for SubhanAllah, Alhamdulillah, Allahu Akbar, tahlil, istighfar and other phrases. Count and target stay on the device.
- **Daily duas** — Short duas for morning, evening, travel, food, sleep, home, protection, forgiveness, guidance, anxiety and parents, with Arabic, English and source.
- **99 Names of Allah** — Asmaul Husna with transliteration, meaning and live search.
- **Hijri calendar** — This Gregorian month mapped day by day to the Hijri date.
- **Verse of the visit** — A random Quran verse (Arabic and English) on the homepage.
- **Prayer tracker** — Mark Fajr, Dhuhr, Asr, Maghrib and Isha, plus optional Tahajjud and Witr. Logged-in members get a streak, monthly completion rate and a month calendar. Notes can be saved for the day.

### Library and community

- **Homepage** — Next-prayer panel, worship tools, daily verse and latest articles.
- **Articles** — Browse, read, comment and save an article locally.
- **Categories, subcategories and tags** — Filter writing by topic.
- **Author pages** — Profile and article list for each writer.
- **Static pages** — Long-form pages managed from the admin area.
- **Search** — Find articles by title, summary or body text.
- **Comments** — Signed-in members can leave a reflection on an article.
- **Contact / support tickets** — Public contact form opens a ticket; members can reply and attach files.
- **Newsletter** — Email subscribe from the footer for weekly reminders.
- **Sitemap** — `/sitemap.xml` for published content.

### Member account

- Registration, login, password reset and email / SMS / 2FA verification.
- Dashboard with today’s salah, monthly consistency and article count.
- Profile, password change and Google Authenticator 2FA.
- Create and edit articles.
- Support ticket history.

### Administration

- Admin login and password reset.
- Dashboard, profile and system info.
- User management (active, banned, verified, email tools, login as user).
- Category, subcategory, post and page management, including pending posts.
- Frontend section builder, page builder, logos, custom CSS and cookie notice.
- Email and SMS templates, SEO, extensions and plugins.
- Subscriber list and broadcast email.
- Support ticket inbox.

### Experience

- Premium Islamic visual theme (deep green, gold and cream) with serif headings and Arabic type.
- Light and dark mode, remembered on the device.
- Sticky navigation, worship dropdown and mobile menu.
- Responsive layout for phones and desktops.

## Main routes

| Path | Purpose |
| --- | --- |
| `/` | Home |
| `/prayer-times` | Salah timetable |
| `/tracker` | Prayer tracker |
| `/qibla` | Qibla compass |
| `/tasbih` | Digital tasbih |
| `/duas` | Daily duas |
| `/names` | 99 Names of Allah |
| `/hijri` | Hijri calendar |
| `/post` or `/blog` | Article index |
| `/search` | Article search |
| `/page` | Static pages |
| `/contact` | Contact form |
| `/login` `/register` | Member auth |
| `/user/dashboard` | Member home |
| `/admin` | Admin panel |

## Stack

- Laravel (PHP) in `core/`
- Blade templates in `core/resources/views/templates/basic/`
- Public assets in `assets/templates/basic/`
- Prayer times, qibla, Hijri and Quran verse use [Aladhan](https://aladhan.com/prayer-times-api) and [AlQuran Cloud](https://alquran.cloud/api)

## Setup

1. Point the web root at the project folder (`index.php` lives at the repository root).
2. Copy `core/.env.example` to `core/.env` and set the database and `APP_URL`.
3. Install PHP dependencies in `core/` with Composer if needed.
4. Run migrations:

```bash
cd core
php artisan migrate
```

5. Clear caches if views look stale:

```bash
php artisan optimize:clear
```

Default public pages work without login. The tracker streak is stored after you sign in.

---

## Let's Build Something Exceptional

I'm actively open to: **Remote Senior Full-Stack Roles · Freelance Contracts · Technical Partnerships · Long-Term Collaborations**

in **Laravel · WordPress · React/Next.js · AI-powered Platforms · Security Audits · SaaS Architecture**

- Timezone: UTC+6 (Dhaka/Rangpur) — flexible overlap for US, EU & Asia
- Available: Immediately · Production-first · Fast delivery · Transparent communication

| Platform | Link |
| --- | --- |
| Portfolio | [imrandev.bd](https://imrandev.bd) |
| LinkedIn | [linkedin.com/in/imranbru99](https://linkedin.com/in/imranbru99) |
| GitHub | [github.com/imranbru99](https://github.com/imranbru99) |
| X / Twitter | [@imrandev_bd](https://x.com/imrandev_bd) |
| YouTube | [@ImranDevBD](https://youtube.com/@ImranDevBD) |
| Instagram | [@imranbru99](https://instagram.com/imranbru99) |
| Facebook | [ExpertImranDev](https://facebook.com/ExpertImranDev) |
| TikTok | [@imrandev_bd](https://www.tiktok.com/@imrandev_bd) |
| Threads | [@imranbru99](https://www.threads.net/@imranbru99) |
| Pinterest | [@imrandev_bd](https://www.pinterest.com/imrandev_bd) |
| WhatsApp | [+880 1576-918420](https://wa.me/8801576918420) |
| Email | [me@imrandev.bd](mailto:me@imrandev.bd) |
| All Links | [linktr.ee/ExpertImranDev](https://linktr.ee/ExpertImranDev) |

> "Security isn't an add-on — it's the foundation. Scale, speed, and trust drive every line of code I write."
>
> — Imran Ahmed

