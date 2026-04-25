# STEP 3.5 — Homepage · Referenz / Quote

Schmaler Vertrauens-Block mit einem prägnanten Kunden-Zitat. Links: Eyebrow + Chip-Tags (Projekt-Daten). Rechts: großes Zitat mit Anführungszeichen-Ornament + Attribution.

**Quelle:** Mockup `home.html` — `.refband`-Section.

**Hinweis:** Der Mockup zeigt den Kunden als anonymisiert ("Thomas K. · Energieversorger TBD"). Vor Go-Live durch eine reale, freigegebene Referenz ersetzen.

---

## 1 · Platzierung

**Bricks → Pages → Startseite** — **5. Section** unter Anwendungen. Container Full-Width, **1 Code-Element**.

## 2 · Code-Widget-Inhalt

```html
<section class="ign-ref ign-section" aria-label="Kunden-Referenz">
  <div class="ign-container">
    <div class="ign-ref__row">

      <div class="ign-ref__meta">
        <span class="eyebrow">Referenz</span>
        <div class="ign-ref__chips">
          <span class="ign-ref__chip">BESS · 2,4 MWh</span>
          <span class="ign-ref__chip">Österreich</span>
          <span class="ign-ref__chip">2025</span>
        </div>
      </div>

      <div class="ign-ref__quote-wrap">
        <blockquote class="ign-ref__quote">
          Die Entscheidung für Aerosol statt Gas war eine reine Volumenrechnung —
          und eine Kostenrechnung. Beides hat Ignitec in zwei Nachmittagen für uns beantwortet.
        </blockquote>
        <div class="ign-ref__attr">
          <div class="ign-ref__avatar" aria-hidden="true"></div>
          <div class="ign-ref__who">
            Thomas K.
            <span>Technischer Leiter · Energieversorger (TBD nach Referenzfreigabe)</span>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<style>
.ign-ref {
  background: var(--bone);
  border-top: 1px solid rgba(21,34,52,0.08);
}
.ign-ref__row {
  display: grid;
  grid-template-columns: 1fr 1.6fr;
  gap: 64px;
  align-items: start;
}

.ign-ref__chips {
  margin-top: 16px;
  display: flex;
  flex-wrap: wrap;
  gap: 6px;
}
.ign-ref__chip {
  font-family: var(--ff-mono);
  font-weight: 500;
  font-size: 11px;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: var(--slateblue);
  background: rgba(21,34,52,0.06);
  padding: 4px 10px;
  border-radius: var(--r-1);
}

.ign-ref__quote {
  font-family: var(--ff-display);
  font-weight: 500;
  font-size: clamp(22px, 2.4vw, 32px);
  line-height: 1.25;
  letter-spacing: -0.02em;
  color: var(--slateblue);
  margin: 0;
  position: relative;
  padding-left: 0;
}
.ign-ref__quote::before {
  content: "»";
  color: var(--copper-solid);
  font-size: 48px;
  line-height: 0.5;
  vertical-align: -4px;
  margin-right: 8px;
  font-weight: 700;
}

.ign-ref__attr {
  margin-top: 28px;
  display: flex;
  align-items: center;
  gap: 16px;
}
.ign-ref__avatar {
  width: 48px; height: 48px;
  border-radius: 50%;
  background: var(--gradient-copper);
  flex-shrink: 0;
}
.ign-ref__who {
  font-family: var(--ff-display);
  font-weight: 600;
  font-size: 14px;
  color: var(--slateblue);
  line-height: 1.4;
}
.ign-ref__who span {
  display: block;
  font-weight: 400;
  color: var(--fg-3);
  font-size: 12.5px;
  margin-top: 2px;
}

@media (max-width: 760px) {
  .ign-ref__row { grid-template-columns: 1fr; gap: 32px; }
}
</style>
```

---

## 3 · Verifikation

- [ ] 1:1.6-Grid Desktop, 1-Spalte Mobile
- [ ] 3 Chips mit JetBrains-Mono uppercase
- [ ] Großes »-Zitatzeichen in Copper
- [ ] Avatar als Copper-Gradient-Kreis (kann durch echtes Foto ersetzt werden)

## 4 · Anpassungspunkte

- **Avatar:** `.ign-ref__avatar` durch `<img>` ersetzen, sobald ein freigegebenes Foto vorliegt
- **Chips:** Im HTML — typische Tags: Branche, Projektgröße, Land, Jahr
- **Quote:** Vor Go-Live durch realen, schriftlich freigegebenen Kundenstatement ersetzen
- **Attribution:** Mockup ist anonymisiert ("Thomas K. · TBD") — bitte rechtzeitig durch Klarnamen ergänzen
