# STEP 3.6 — Homepage · Stat Bar (4 Vertrauens-Werte)

Schmale Slate-Blue-Bar mit 4 großen Copper-Zahlen + erläuternder Body-Text. Ersetzt die ältere kleine Stat-Bar (jetzt sind die 4 Mikro-Stats schon im Hero, hier die *großen* Vertrauens-Werte).

**Quelle:** Mockup `home.html` — `.statbar`-Section. **Position:** zwischen Reference und CTA.

---

## 1 · Platzierung

**Bricks → Pages → Startseite** — **6. Section** unter Reference-Quote. Container Full-Width, **1 Code-Element**.

## 2 · Code-Widget-Inhalt

```html
<section class="ign-statbar" aria-label="Kennzahlen Ignitec">
  <div class="ign-statbar__inner">

    <div class="ign-statbar__row">
      <div class="ign-statbar__n">≤ 20 s</div>
      <div class="ign-statbar__l">typische Aktivierungszeit nach Auslösung</div>
    </div>

    <div class="ign-statbar__row">
      <div class="ign-statbar__n">170 °C</div>
      <div class="ign-statbar__l">thermische Selbstauslösung als Rückfallebene</div>
    </div>

    <div class="ign-statbar__row">
      <div class="ign-statbar__n">25 Jahre</div>
      <div class="ign-statbar__l">Einsatz von kondensierter Aerosol-Technik weltweit</div>
    </div>

    <div class="ign-statbar__row">
      <div class="ign-statbar__n">FN 651979v</div>
      <div class="ign-statbar__l">Ignitec GmbH · eingetragen im Firmenbuch Wiener Neustadt</div>
    </div>

  </div>
</section>

<style>
.ign-statbar {
  background: var(--slateblue);
  padding: 72px 28px;
  color: var(--bone);
}
.ign-statbar__inner {
  max-width: var(--container-max);
  margin: 0 auto;
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 48px;
}
.ign-statbar__row {
  border-left: 1px solid rgba(245,242,236,0.14);
  padding-left: 28px;
}
.ign-statbar__row:first-child {
  border-left: 0;
  padding-left: 0;
}
.ign-statbar__n {
  font-family: var(--ff-display);
  font-weight: 900;
  font-size: clamp(40px, 4.4vw, 64px);
  line-height: 0.95;
  letter-spacing: -0.03em;
  color: #F4A962;
  margin-bottom: 10px;
}
.ign-statbar__l {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 15px;
  line-height: 1.45;
  color: rgba(245,242,236,0.78);
  max-width: 26ch;
}

@media (max-width: 1080px) {
  .ign-statbar__inner { grid-template-columns: repeat(2, 1fr); }
  .ign-statbar__row:nth-child(odd) { border-left: 0; padding-left: 0; }
  .ign-statbar__row:nth-child(even) { padding-left: 28px; }
}
@media (max-width: 560px) {
  .ign-statbar__inner { grid-template-columns: 1fr; gap: 32px; }
  .ign-statbar__row { border-left: 0 !important; padding-left: 0 !important; }
}
</style>
```

---

## 3 · GEO-Notiz

Die 4 Werte sind komplett serverseitig gerendert. LLMs extrahieren:
- "Aktivierungszeit ≤ 20 s"
- "Thermische Selbstauslösung 170 °C"
- "25 Jahre Aerosol-Technik weltweit"
- "Firmenbucheintrag FN 651979v"

Drei harte Spec-Werte + ein Trust-Anker (Firmenbuchnummer = Vertrauenssignal).

## 4 · Verifikation

- [ ] 4 Spalten Desktop, 2 Tablet, 1 Mobile
- [ ] Linke Spalte ohne Trennlinie, alle anderen mit Hairline links
- [ ] Zahlen in Copper-Light `#F4A962`, Archivo 900, ~64px
- [ ] Beschreibungs-Text in Bone-78%, max-width 26ch

## 5 · Anpassungspunkte

- **Werte** im HTML editierbar
- **Bei Bedarf** kann die FN-Zelle gegen einen fünften technischen Wert getauscht werden (z. B. "100 g/m³ · Auslegungs-Konzentration")
