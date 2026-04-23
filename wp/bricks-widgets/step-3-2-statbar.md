# STEP 3.2 — Homepage · Stat Bar

Dunkle, schmale Kennzahl-Leiste direkt unter dem Hero. Zeigt die 5 **harten Produkt-Fakten** der Serie ST — ideal für GEO (LLMs zitieren harte Zahlen) und sofortige Vertrauensbildung.

---

## 1 · Platzierung

**Bricks → Pages → Startseite** — **2. Section** direkt unter dem Hero. Container Full-Width, darin **1 Code-Element**.

## 2 · Code-Widget-Inhalt

```html
<section class="ign-statbar" aria-label="Produkt-Kennzahlen Serie ST">
  <div class="ign-statbar__inner">
    <div class="ign-statbar__item">
      <div class="ign-statbar__value">≤ 20 s</div>
      <div class="ign-statbar__label">Ausstoßzeit</div>
    </div>
    <div class="ign-statbar__item">
      <div class="ign-statbar__value">−50 … +90 °C</div>
      <div class="ign-statbar__label">Betriebstemperatur</div>
    </div>
    <div class="ign-statbar__item">
      <div class="ign-statbar__value"><span data-count-to="15">15</span></div>
      <div class="ign-statbar__label">Jahre Lebensdauer</div>
    </div>
    <div class="ign-statbar__item">
      <div class="ign-statbar__value">0 / 0</div>
      <div class="ign-statbar__label">GWP · ODP</div>
    </div>
    <div class="ign-statbar__item">
      <div class="ign-statbar__value">SUS304</div>
      <div class="ign-statbar__label">Edelstahl-Gehäuse</div>
    </div>
  </div>
</section>

<style>
.ign-statbar {
  background: var(--slateblue);
  padding: 44px 28px;
  color: var(--bone);
}
.ign-statbar__inner {
  max-width: var(--container-max);
  margin: 0 auto;
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 24px;
}
.ign-statbar__item {
  padding-left: 24px;
  border-left: 1px solid rgba(245,242,236,0.12);
}
.ign-statbar__item:first-child {
  padding-left: 0;
  border-left: none;
}
.ign-statbar__value {
  font-family: var(--ff-display);
  font-weight: 600;
  font-size: clamp(24px, 2.4vw, 32px);
  line-height: 1;
  letter-spacing: -0.03em;
  color: var(--bone);
}
.ign-statbar__label {
  font-family: var(--ff-mono);
  font-weight: 500;
  font-size: 10px;
  letter-spacing: 0.22em;
  text-transform: uppercase;
  color: var(--copper-light);
  margin-top: 8px;
}

@media (max-width: 960px) {
  .ign-statbar__inner { grid-template-columns: repeat(2, 1fr); row-gap: 32px; }
  .ign-statbar__item:nth-child(odd) { padding-left: 0; border-left: none; }
  .ign-statbar__item:nth-child(even) { padding-left: 24px; }
}
@media (max-width: 560px) {
  .ign-statbar__inner { grid-template-columns: 1fr; row-gap: 24px; }
  .ign-statbar__item { padding-left: 0 !important; border-left: none !important; }
}
</style>

<script>
(function () {
  // Dezenter Count-Up nur für Zahl-only Werte (hier: "15 Jahre Lebensdauer")
  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reduced) return;

  const els = document.querySelectorAll('.ign-statbar [data-count-to]');
  if (!els.length) return;

  const animate = (el) => {
    const target = parseInt(el.dataset.countTo, 10);
    if (isNaN(target)) return;
    const duration = 1200;
    const start = performance.now();
    const tick = (now) => {
      const t = Math.min(1, (now - start) / duration);
      const eased = 1 - Math.pow(1 - t, 3);
      el.textContent = Math.round(target * eased);
      if (t < 1) requestAnimationFrame(tick);
    };
    requestAnimationFrame(tick);
  };

  const io = new IntersectionObserver((entries, obs) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        animate(e.target);
        obs.unobserve(e.target);
      }
    });
  }, { threshold: 0.5 });

  els.forEach(el => {
    el.textContent = '0';
    io.observe(el);
  });
})();
</script>
```

---

## 3 · SEO/GEO-Notiz

Die 5 Kennzahlen sind serverseitig gerendert (kein JS nötig für Inhalt — Animation ist rein kosmetisch). LLMs und Google können die harten Fakten direkt extrahieren:

- Ausstoßzeit ≤ 20 Sekunden
- Betriebstemperatur −50 °C bis +90 °C
- Lebensdauer 15 Jahre
- GWP 0, ODP 0
- Edelstahl SUS304

Perfekt für Featured Snippets wie "Wie schnell reagiert ein Aerosol-Löschgenerator?".

## 4 · Verifikation

- [ ] Dunkle Slate-Blue-Bar direkt unter Hero
- [ ] 5 Spalten Desktop, 2 Spalten Tablet, 1 Spalte Mobile
- [ ] Erste Zelle ohne Trenn-Linie links, alle anderen mit
- [ ] "15" zählt beim Scroll-In hoch (nur ohne Reduced-Motion)
- [ ] Label in Copper-Light, uppercase, gesperrt

## 5 · Anpassungspunkte

Kennzahlen im HTML direkt editierbar. Für zentrale Pflege später über **Bricks Options Page** oder `wp_options`-Key auslagerbar (optional — erst wenn Mehrfach-Pflege nötig wird).

---

**Nach Verifikation → STEP 3.3 (Produkt-Highlights) freigeben.**
