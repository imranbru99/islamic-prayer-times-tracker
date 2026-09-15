(function () {
    "use strict";

    var STORAGE_CITY = "prayer.city";
    var STORAGE_COUNTRY = "prayer.country";
    var STORAGE_COORDS = "prayer.coords";
    var STORAGE_THEME = "prayer.theme";
    var STORAGE_TASBIH = "prayer.tasbih";
    var STORAGE_BOOKMARKS = "prayer.bookmarks";

    function qs(sel, root) {
        return (root || document).querySelector(sel);
    }

    function qsa(sel, root) {
        return Array.prototype.slice.call((root || document).querySelectorAll(sel));
    }

    function on(el, ev, fn) {
        if (el) el.addEventListener(ev, fn);
    }

    function save(key, value) {
        try { localStorage.setItem(key, JSON.stringify(value)); } catch (e) {}
    }

    function load(key, fallback) {
        try {
            var raw = localStorage.getItem(key);
            return raw ? JSON.parse(raw) : fallback;
        } catch (e) {
            return fallback;
        }
    }

    function initNav() {
        var toggle = qs("[data-nav-toggle]");
        var links = qs("[data-nav-links]");
        on(toggle, "click", function () {
            if (links) links.classList.toggle("is-open");
        });
    }

    function initTheme() {
        var stored = load(STORAGE_THEME, "light");
        document.documentElement.setAttribute("data-theme", stored);
        qsa("[data-theme-toggle]").forEach(function (btn) {
            on(btn, "click", function () {
                var next = document.documentElement.getAttribute("data-theme") === "dark" ? "light" : "dark";
                document.documentElement.setAttribute("data-theme", next);
                save(STORAGE_THEME, next);
            });
        });
    }

    function parseTime(hhmm) {
        var parts = String(hhmm || "").split(":");
        var date = new Date();
        date.setHours(parseInt(parts[0], 10) || 0, parseInt(parts[1], 10) || 0, 0, 0);
        return date;
    }

    function formatCountdown(ms) {
        if (ms < 0) ms = 0;
        var total = Math.floor(ms / 1000);
        var h = Math.floor(total / 3600);
        var m = Math.floor((total % 3600) / 60);
        var s = total % 60;
        return [h, m, s].map(function (n) { return String(n).padStart(2, "0"); }).join(":");
    }

    function cityFallback() {
        return {
            city: load(STORAGE_CITY, "Dhaka"),
            country: load(STORAGE_COUNTRY, "Bangladesh")
        };
    }

    function timingsUrl(coords) {
        if (coords && coords.lat && coords.lng) {
            return "https://api.aladhan.com/v1/timings?latitude=" + coords.lat + "&longitude=" + coords.lng + "&method=2";
        }
        var place = cityFallback();
        return "https://api.aladhan.com/v1/timingsByCity?city=" + encodeURIComponent(place.city) + "&country=" + encodeURIComponent(place.country) + "&method=2";
    }

    function renderPrayerPanel(root, data) {
        if (!root || !data) return;
        var times = data.timings;
        var date = data.date;
        var keys = [
            { key: "Fajr", label: "Fajr" },
            { key: "Dhuhr", label: "Dhuhr" },
            { key: "Asr", label: "Asr" },
            { key: "Maghrib", label: "Maghrib" },
            { key: "Isha", label: "Isha" }
        ];
        var now = new Date();
        var next = null;
        keys.forEach(function (item) {
            var t = parseTime(times[item.key]);
            item.date = t;
            item.passed = t < now;
            if (!next && t >= now) next = item;
        });
        if (!next) next = { key: "Fajr", label: "Fajr", date: parseTime(times.Fajr), tomorrow: true };

        var loc = qs("[data-prayer-location]", root);
        var hijri = qs("[data-prayer-hijri]", root);
        var nextName = qs("[data-next-prayer]", root);
        var countdown = qs("[data-countdown]", root);
        var list = qs("[data-prayer-list]", root);

        if (loc) loc.textContent = data.meta && data.meta.timezone ? data.meta.timezone.replace(/_/g, " ") : cityFallback().city;
        if (hijri && date && date.hijri) {
            hijri.textContent = date.hijri.day + " " + date.hijri.month.en + " " + date.hijri.year;
        }
        if (nextName) nextName.textContent = next.label;
        if (list) {
            list.innerHTML = keys.map(function (item) {
                var cls = "prayer-row" + (item.key === next.key && !next.tomorrow ? " is-next" : "") + (item.passed ? " is-passed" : "");
                return '<div class="' + cls + '"><strong>' + item.label + "</strong><span>" + String(times[item.key]).slice(0, 5) + "</span></div>";
            }).join("");
        }
        if (countdown) {
            var target = next.date;
            if (next.tomorrow) target.setDate(target.getDate() + 1);
            function tick() {
                countdown.textContent = "in " + formatCountdown(target - new Date());
            }
            tick();
            clearInterval(root._timer);
            root._timer = setInterval(tick, 1000);
        }
    }

    function fetchPrayerTimes(root) {
        var coords = load(STORAGE_COORDS, null);
        return fetch(timingsUrl(coords))
            .then(function (res) { return res.json(); })
            .then(function (json) {
                if (json && json.data) {
                    qsa("[data-prayer-panel]").forEach(function (panel) {
                        renderPrayerPanel(panel, json.data);
                    });
                    if (root) renderPrayerPanel(root, json.data);
                    return json.data;
                }
            })
            .catch(function () {});
    }

    function locateAndLoad() {
        if (!navigator.geolocation) {
            fetchPrayerTimes();
            return;
        }
        navigator.geolocation.getCurrentPosition(function (pos) {
            save(STORAGE_COORDS, { lat: pos.coords.latitude, lng: pos.coords.longitude });
            fetchPrayerTimes();
            loadQibla(pos.coords.latitude, pos.coords.longitude);
        }, function () {
            fetchPrayerTimes();
        }, { timeout: 4000 });
    }

    function initCityForm() {
        var form = qs("[data-city-form]");
        if (!form) return;
        var city = qs("[name=city]", form);
        var country = qs("[name=country]", form);
        if (city) city.value = load(STORAGE_CITY, "Dhaka");
        if (country) country.value = load(STORAGE_COUNTRY, "Bangladesh");
        on(form, "submit", function (e) {
            e.preventDefault();
            save(STORAGE_CITY, city.value || "Dhaka");
            save(STORAGE_COUNTRY, country.value || "Bangladesh");
            localStorage.removeItem(STORAGE_COORDS);
            fetchPrayerTimes();
        });
    }

    function loadQibla(lat, lng) {
        var needle = qs("[data-qibla-needle]");
        var label = qs("[data-qibla-deg]");
        if (!needle) return;
        var coords = load(STORAGE_COORDS, lat && lng ? { lat: lat, lng: lng } : null);
        if (!coords) return;
        fetch("https://api.aladhan.com/v1/qibla/" + coords.lat + "/" + coords.lng)
            .then(function (res) { return res.json(); })
            .then(function (json) {
                if (!json || !json.data) return;
                var deg = json.data.direction;
                needle.style.transform = "rotate(" + deg + "deg)";
                if (label) label.textContent = Math.round(deg) + "° from North";
            })
            .catch(function () {});
    }

    function initTasbih() {
        var wrap = qs("[data-tasbih]");
        if (!wrap) return;
        var state = load(STORAGE_TASBIH, { count: 0, phrase: 0, target: 33 });
        var countEl = qs("[data-tasbih-count]", wrap);
        var targetEl = qs("[name=target]", wrap);
        var phraseBtns = qsa("[data-phrase]", wrap);

        function paint() {
            if (countEl) countEl.textContent = state.count;
            phraseBtns.forEach(function (btn, i) {
                btn.classList.toggle("is-on", i === state.phrase);
            });
            if (targetEl) targetEl.value = state.target;
            save(STORAGE_TASBIH, state);
        }

        on(qs("[data-tasbih-ring]", wrap), "click", function () {
            state.count += 1;
            if (state.target && state.count >= Number(state.target)) {
                state.count = Number(state.target);
            }
            paint();
        });
        on(qs("[data-tasbih-reset]", wrap), "click", function () {
            state.count = 0;
            paint();
        });
        phraseBtns.forEach(function (btn, i) {
            on(btn, "click", function () {
                state.phrase = i;
                paint();
            });
        });
        on(targetEl, "change", function () {
            state.target = Number(targetEl.value) || 33;
            paint();
        });
        paint();
    }

    function initFilters() {
        qsa("[data-filter-group]").forEach(function (group) {
            var chips = qsa("[data-filter]", group);
            var items = qsa("[data-filter-item]", group);
            chips.forEach(function (chip) {
                on(chip, "click", function () {
                    chips.forEach(function (c) { c.classList.remove("is-on"); });
                    chip.classList.add("is-on");
                    var value = chip.getAttribute("data-filter");
                    items.forEach(function (item) {
                        item.style.display = value === "all" || item.getAttribute("data-cat") === value ? "" : "none";
                    });
                });
            });
        });
    }

    function initNamesSearch() {
        var input = qs("[data-names-search]");
        if (!input) return;
        on(input, "input", function () {
            var q = input.value.toLowerCase();
            qsa("[data-name-card]").forEach(function (card) {
                card.style.display = card.textContent.toLowerCase().indexOf(q) !== -1 ? "" : "none";
            });
        });
    }

    function initHijri() {
        var root = qs("[data-hijri-cal]");
        if (!root) return;
        var now = new Date();
        fetch("https://api.aladhan.com/v1/gToHCalendar/" + (now.getMonth() + 1) + "/" + now.getFullYear())
            .then(function (res) { return res.json(); })
            .then(function (json) {
                if (!json || !json.data) return;
                root.innerHTML = json.data.map(function (day) {
                    var today = Number(day.gregorian.day) === now.getDate() ? " is-today" : "";
                    return '<div class="month-day' + today + '"><strong>' + day.hijri.day + "</strong><div>" + day.hijri.weekday.en + '</div><div class="tiny">' + day.gregorian.date + "</div></div>";
                }).join("");
            })
            .catch(function () {
                root.innerHTML = "<p>Hijri calendar could not be loaded right now.</p>";
            });
    }

    function initAyah() {
        var root = qs("[data-ayah]");
        if (!root) return;
        fetch("https://api.alquran.cloud/v1/ayah/" + (Math.floor(Math.random() * 6236) + 1) + "/editions/quran-uthmani,en.asad")
            .then(function (res) { return res.json(); })
            .then(function (json) {
                if (!json || !json.data) return;
                var ar = json.data[0];
                var en = json.data[1];
                root.innerHTML = '<p class="arabic">' + ar.text + '</p><p class="lead">' + en.text + '</p><p class="tiny">' + ar.surah.englishName + " · " + ar.numberInSurah + "</p>";
            })
            .catch(function () {});
    }

    function initBookmarks() {
        var btn = qs("[data-bookmark]");
        if (!btn) return;
        var slug = btn.getAttribute("data-bookmark");
        var marks = load(STORAGE_BOOKMARKS, []);
        function paint() {
            btn.classList.toggle("is-on", marks.indexOf(slug) !== -1);
            btn.textContent = marks.indexOf(slug) !== -1 ? "Saved" : "Save article";
        }
        on(btn, "click", function () {
            var i = marks.indexOf(slug);
            if (i === -1) marks.push(slug);
            else marks.splice(i, 1);
            save(STORAGE_BOOKMARKS, marks);
            paint();
        });
        paint();
    }

    function initAttendance() {
        qsa("[data-prayer-toggle]").forEach(function (btn) {
            on(btn, "click", function () {
                var url = btn.getAttribute("data-url");
                var token = btn.getAttribute("data-token");
                if (!url) return;
                fetch(url, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": token,
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({ prayer: btn.getAttribute("data-prayer") })
                }).then(function (res) {
                    if (res.status === 401) {
                        window.location.href = btn.getAttribute("data-login") || "/login";
                        return null;
                    }
                    return res.json();
                }).then(function (json) {
                    if (!json || !json.success) return;
                    btn.classList.toggle("is-on", json.value);
                    var today = qs("[data-today-count]");
                    if (today) today.textContent = json.today_count + " / 5";
                    if (json.stats) {
                        var streak = qs("[data-streak]");
                        var percent = qs("[data-month-percent]");
                        if (streak) streak.textContent = json.stats.streak;
                        if (percent) percent.textContent = json.stats.month_percent + "%";
                    }
                }).catch(function () {});
            });
        });
    }

    document.addEventListener("DOMContentLoaded", function () {
        initNav();
        initTheme();
        initCityForm();
        initTasbih();
        initFilters();
        initNamesSearch();
        initHijri();
        initAyah();
        initBookmarks();
        initAttendance();
        locateAndLoad();
        loadQibla();
    });
})();
