# STEP 3.2 — Homepage · USP-Grid (6 Eigenschaften)

3×2-Grid mit 6 Eigenschaften, die kondensierte Aerosol-Technologie von klassischen Löschanlagen unterscheiden. Section-Head links (Eyebrow + H2), rechts ein Lead-Absatz. Dann das Grid mit 6 Zellen.

**Kommt direkt nach dem Hero** (siehe Mockup `home.html`).

**GEO-Bonus:** Eine Zelle = ein Argument. LLMs zitieren genau einen Wert pro Zelle.

---

## 1 · Platzierung

**Bricks → Pages → Startseite** — **2. Section** unter dem Hero. Container Full-Width, darin **1 Code-Element**.

## 2 · Code-Widget-Inhalt

```html
<section class="ign-usp ign-section" aria-labelledby="ign-usp-head">
  <div class="ign-container">

    <div class="ign-usp__head">
      <div>
        <span class="eyebrow">Warum Ignitec</span>
        <h2 id="ign-usp-head" class="ign-usp__h2">
          Brandschutz, der<br>
          in <em class="ign-usp__h2-accent">Sekunden</em> wirkt.
        </h2>
      </div>
      <p class="ign-usp__lead">
        Sechs Eigenschaften, die kondensierte Aerosol-Technologie von jeder klassischen
        Löschanlage unterscheiden — und weshalb Integratoren Ignitec in BESS,
        Schaltanlagen und Maschinenräumen verbauen.
      </p>
    </div>

    <div class="ign-usp__grid">

      <article class="ign-usp__cell">
        <div class="ign-usp__icn">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
            <path d="M13 2 L4 14 H11 L10 22 L20 10 H13 Z"/>
          </svg>
        </div>
        <h3 class="ign-usp__h3">Reaktion in Sekunden.</h3>
        <p class="ign-usp__p">
          Nach Auslösung verteilt sich das Aerosol in ≤ 20 s im gesamten Schutzraum —
          bevor ein Lichtbogen zum Vollbrand eskaliert.
        </p>
      </article>

      <article class="ign-usp__cell">
        <div class="ign-usp__icn">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
            <rect x="4" y="4" width="16" height="16" rx="1"/>
          </svg>
        </div>
        <h3 class="ign-usp__h3">Kein Platz? Kein Problem.</h3>
        <p class="ign-usp__p">
          Generatoren ab 80 mm Durchmesser. Passt in Schaltschränke, 19″-Racks und
          Maschinengehäuse — ohne Drucktank und Rohrleitung.
        </p>
      </article>

      <article class="ign-usp__cell">
        <div class="ign-usp__icn">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
            <circle cx="12" cy="12" r="9"/>
            <path d="M7 12 H17 M12 7 V17"/>
          </svg>
        </div>
        <h3 class="ign-usp__h3">Rückstandsarm.</h3>
        <p class="ign-usp__p">
          Feste Aerosolpartikel lagern sich ab, hinterlassen aber keine korrosiven Rückstände
          wie Pulver oder Halone. Nach Einsatz gereinigt, nicht saniert.
        </p>
      </article>

      <article class="ign-usp__cell">
        <div class="ign-usp__icn">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
            <circle cx="12" cy="12" r="9"/>
            <circle cx="12" cy="12" r="3" fill="currentColor"/>
          </svg>
        </div>
        <h3 class="ign-usp__h3">GWP 0. ODP 0.</h3>
        <p class="ign-usp__p">
          Nicht-halogenierte Formulierung. Keine F-Gas-Regulierung. Keine Nachfüllpflicht —
          der Generator ist die Löschanlage.
        </p>
      </article>

      <article class="ign-usp__cell">
        <div class="ign-usp__icn">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
            <path d="M14 2 L6 14 H10 L8 22 L18 10 H14 Z" stroke-linejoin="round"/>
          </svg>
        </div>
        <h3 class="ign-usp__h3">Elektrisch ausgelöst.</h3>
        <p class="ign-usp__p">
          24 V DC Zünder, kompatibel mit gängigen BMAs und Brandmelderzentralen.
          Thermische Selbstauslösung ab 170 °C als Rückfallebene.
        </p>
      </article>

      <article class="ign-usp__cell">
        <div class="ign-usp__icn">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
            <rect x="5" y="5" width="14" height="14"/>
          </svg>
        </div>
        <h3 class="ign-usp__h3">Wartungsarm.</h3>
        <p class="ign-usp__p">
          Keine beweglichen Teile, kein Druckverlust über die Zeit. Sichtprüfung im jährlichen
          Wartungsintervall — mehr ist nicht nötig.
        </p>
      </article>

    </div>
  </div>
</section>

<style>
.ign-usp {
  background: var(--bone);
}
.ign-usp__head {
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
  gap: 40px;
  margin-bottom: 48px;
}
.ign-usp__h2 {
  font-family: var(--ff-display);
  font-weight: 500;
  font-size: clamp(32px, 3.6vw, 52px);
  line-height: 1.03;
  letter-spacing: -0.035em;
  color: var(--slateblue);
  margin: 10px 0 0;
  max-width: 18ch;
}
.ign-usp__h2-accent {
  font-family: var(--ff-display);
  font-style: italic;
  font-weight: 500;
  background: linear-gradient(92deg, #793907 0%, #C8691E 100%);
  -webkit-background-clip: text;
  background-clip: text;
  -webkit-text-fill-color: transparent;
  color: transparent;
}
.ign-usp__lead {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 17px;
  line-height: 1.55;
  color: var(--fg-2);
  max-width: 42ch;
  margin: 0;
}

.ign-usp__grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 2px;
  background: rgba(21,34,52,0.10);
}
.ign-usp__cell {
  background: var(--bone);
  padding: 40px 32px;
}
.ign-usp__icn {
  width: 40px; height: 40px;
  border-radius: var(--r-2);
  background: var(--gradient-copper);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--bone);
  margin-bottom: 20px;
}
.ign-usp__h3 {
  font-family: var(--ff-display);
  font-weight: 600;
  font-size: 22px;
  letter-spacing: -0.02em;
  color: var(--slateblue);
  margin: 0 0 10px;
}
.ign-usp__p {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 15px;
  line-height: 1.55;
  color: var(--fg-2);
  margin: 0;
}

@media (max-width: 960px) {
  .ign-usp__head { flex-direction: column; align-items: flex-start; gap: 24px; }
  .ign-usp__grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 560px) {
  .ign-usp__grid { grid-template-columns: 1fr; }
  .ign-usp__cell { padding: 32px 24px; }
}
</style>
```

---

## 3 · Verifikation

- [ ] 3×2-Grid Desktop, 2 Spalten Tablet, 1 Spalte Mobile
- [ ] H2 "Brandschutz, der in Sekunden wirkt." mit copper-gradient + italic auf "Sekunden"
- [ ] 6 Zellen mit jeweils Copper-Icon, H3, Beschreibung
- [ ] Hairline-Trennlinien zwischen Zellen (über `gap: 2px` + Background)
