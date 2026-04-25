# STEP 3.4 — Homepage · Anwendungen (Dark · 6-Spalten-Grid)

Vollflächige Sektion auf Ink-Carrier mit 6 Anwendungs-Zellen. Section-Head split (Eyebrow + H2 links, Lead rechts). Jede Zelle: nummerische Kennung, Anwendungs-Name, Detail-Tag.

**Quelle:** Mockup `home.html` — Section "Dort, wo Wasser keine Option ist."

---

## 1 · Platzierung

**Bricks → Pages → Startseite** — **4. Section** unter Produkt-Teaser. Container Full-Width, **1 Code-Element**.

## 2 · Code-Widget-Inhalt

```html
<section class="ign-apps ign-section" aria-labelledby="ign-apps-head">
  <div class="ign-container">

    <div class="ign-apps__head">
      <div>
        <span class="eyebrow ign-apps__eyebrow">Einsatzfelder</span>
        <h2 id="ign-apps-head" class="ign-apps__h2">
          Dort, wo Wasser<br>
          keine Option ist.
        </h2>
      </div>
      <p class="ign-apps__lead">
        Aerosol-Löschtechnik ist überall dort im Einsatz, wo Strom, Mechanik
        oder sensible Elektronik ein klassisches Löschmittel ausschließen.
      </p>
    </div>

    <div class="ign-apps__grid">
      <a class="ign-apps__cell" href="/anwendungen/#bess">
        <div class="ign-apps__no">01</div>
        <div>
          <div class="ign-apps__name">BESS &amp;<br>Batterie­speicher</div>
          <div class="ign-apps__dx">Thermal Runaway, Li-Ion-Racks</div>
        </div>
      </a>
      <a class="ign-apps__cell" href="/anwendungen/#schaltanlagen">
        <div class="ign-apps__no">02</div>
        <div>
          <div class="ign-apps__name">Schalt­anlagen &amp;<br>Trafostationen</div>
          <div class="ign-apps__dx">NSHV, MSHV, Umspannwerke</div>
        </div>
      </a>
      <a class="ign-apps__cell" href="/anwendungen/#serverraum">
        <div class="ign-apps__no">03</div>
        <div>
          <div class="ign-apps__name">Daten­zentren &amp;<br>Serverräume</div>
          <div class="ign-apps__dx">Rack-Level, Raumflutung</div>
        </div>
      </a>
      <a class="ign-apps__cell" href="/anwendungen/#maschinenraum">
        <div class="ign-apps__no">04</div>
        <div>
          <div class="ign-apps__name">Maschinen &amp;<br>CNC-Zentren</div>
          <div class="ign-apps__dx">Kapselung, Öl- und Spänebrände</div>
        </div>
      </a>
      <a class="ign-apps__cell" href="/anwendungen/#fahrzeug">
        <div class="ign-apps__no">05</div>
        <div>
          <div class="ign-apps__name">Busse, Bahn &amp;<br>Sonder­fahrzeuge</div>
          <div class="ign-apps__dx">Motorraum, Batteriekasten</div>
        </div>
      </a>
      <a class="ign-apps__cell" href="/anwendungen/#windkraft">
        <div class="ign-apps__no">06</div>
        <div>
          <div class="ign-apps__name">Wind­kraft &amp;<br>Anlagentechnik</div>
          <div class="ign-apps__dx">Gondel, Umrichterkabine</div>
        </div>
      </a>
    </div>
  </div>
</section>

<style>
.ign-apps {
  background: var(--ink-000);
  color: var(--bone);
  padding: 112px 28px;
}
.ign-apps__head {
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
  gap: 40px;
  padding-bottom: 28px;
  border-bottom: 1px solid rgba(245,242,236,0.12);
  margin-bottom: 48px;
}
.ign-apps__eyebrow { color: var(--copper-light); }
.ign-apps__h2 {
  font-family: var(--ff-display);
  font-weight: 500;
  font-size: clamp(32px, 3.6vw, 52px);
  line-height: 1.03;
  letter-spacing: -0.035em;
  color: var(--bone);
  margin: 10px 0 0;
  max-width: 18ch;
}
.ign-apps__lead {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 17px;
  line-height: 1.55;
  color: rgba(245,242,236,0.72);
  max-width: 38ch;
  margin: 0;
}

.ign-apps__grid {
  display: grid;
  grid-template-columns: repeat(6, 1fr);
  gap: 1px;
  background: rgba(245,242,236,0.08);
  border: 1px solid rgba(245,242,236,0.08);
}
.ign-apps__cell {
  background: var(--ink-100);
  padding: 32px 22px;
  min-height: 180px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  text-decoration: none;
  color: inherit;
  transition: background var(--dur-base) var(--ease-standard);
}
.ign-apps__cell:hover {
  background: var(--ink-200);
  text-decoration: none;
  color: inherit;
}
.ign-apps__no {
  font-family: var(--ff-mono);
  font-weight: 500;
  font-size: 11px;
  letter-spacing: 0.22em;
  color: rgba(244,169,98,0.75);
}
.ign-apps__name {
  font-family: var(--ff-display);
  font-weight: 600;
  font-size: 17px;
  line-height: 1.2;
  letter-spacing: -0.01em;
  color: var(--bone);
}
.ign-apps__dx {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 12.5px;
  line-height: 1.5;
  color: rgba(245,242,236,0.55);
  margin-top: 8px;
}

@media (max-width: 1080px) {
  .ign-apps__grid { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 720px) {
  .ign-apps__head { flex-direction: column; align-items: flex-start; gap: 24px; }
  .ign-apps__grid { grid-template-columns: repeat(2, 1fr); }
  .ign-apps { padding: 80px 24px; }
}
@media (max-width: 480px) {
  .ign-apps__grid { grid-template-columns: 1fr; }
}
</style>
```

---

## 3 · Verifikation

- [ ] Volle Ink-000-Bühne, dunkler Carrier
- [ ] 6 Zellen Desktop, 3 Tablet, 2 Mobile-XL, 1 Mobile-S
- [ ] Hairline-Trenngrid via 1px Background-Color
- [ ] Hover: Zelle wird heller (Ink-100 → Ink-200)
- [ ] Klick führt auf `/anwendungen/#<anchor>` (Sektion auf der Übersichts-Seite — siehe `step-6-applications.md`)

## 4 · Anpassungspunkte

- **Reihenfolge** der 6 Anwendungen — im HTML sortieren
- **Slugs** in `href` müssen mit den CPT-Einträgen aus STEP 6 übereinstimmen
- **Anzahl** kann auf 4 oder 8 angepasst werden (Grid-Template-Columns mit anpassen)
