# STEP 3.7 — Homepage · CTA (Copper-Carrier mit Glass-Card)

Voll-Copper-Carrier als Conversion-Endspurt. Links: Eyebrow + H2 + Lead + zwei CTAs. Rechts: dunkle Glass-Card mit Direktkontakt-Daten (Telefon, E-Mail, Adresse, Firmenbuch, UID).

**Quelle:** Mockup `home.html` — `.cta`-Section. **Position:** vor dem globalen Footer-CTA-Strip aus STEP 2 (oder ersetzt diesen — siehe Hinweis).

> **Wichtig:** Der globale Footer (STEP 2) enthält bereits einen CTA-Strip "Gemeinsam auslegen. Ruhig entscheiden." Damit es keine Doppelung gibt, **eine** der beiden Optionen wählen:
> - **A** Diesen CTA hier auf der Homepage einsetzen → globalen CTA-Strip in STEP 2 entfernen (nur Footer behalten)
> - **B** Globalen CTA-Strip behalten → diesen Homepage-CTA weglassen
>
> Der Mockup zeigt Variante A. Empfehlung: **A**.

---

## 1 · Wenn Variante A — globalen CTA-Strip entfernen

In `step-2-footer.md` den Block `<section class="ign-cta-strip">` … `</section>` entfernen. Footer-Sektion bleibt unverändert.

## 2 · Platzierung Homepage

**Bricks → Pages → Startseite** — **7. Section** unter Stat Bar. Container Full-Width, **1 Code-Element**.

## 3 · Code-Widget-Inhalt

```html
<section class="ign-cta" aria-labelledby="ign-cta-head">
  <div class="ign-cta__inner">

    <div class="ign-cta__copy">
      <span class="eyebrow ign-cta__eyebrow">Projektanfrage</span>
      <h2 id="ign-cta-head" class="ign-cta__h2">
        Welche Generatorgröße<br>
        passt in Ihr Schutzvolumen?
      </h2>
      <p class="ign-cta__p">
        Senden Sie uns Raumvolumen, Einsatzfeld und Auslöseart — wir empfehlen die passende
        Größe und senden Datenblatt plus Erstangebot innerhalb von zwei Werktagen.
      </p>
      <div class="ign-cta__buttons">
        <a class="ign-btn ign-btn--bone-on-copper" href="/kontakt/">Anfrage stellen →</a>
        <a class="ign-btn ign-btn--ghost" href="/konfigurator/">Konfigurator öffnen</a>
      </div>
    </div>

    <aside class="ign-cta__card">
      <h3 class="ign-cta__card-h">Direktkontakt Technik</h3>
      <div class="ign-cta__line">
        <span>Telefon</span>
        <span>+43 (0) — TBD</span>
      </div>
      <div class="ign-cta__line">
        <span>E-Mail</span>
        <span><a href="mailto:office@ignitec.at">office@ignitec.at</a></span>
      </div>
      <div class="ign-cta__line">
        <span>Adresse</span>
        <span>Lichtenwörth, Österreich</span>
      </div>
      <div class="ign-cta__line">
        <span>Firmenbuch</span>
        <span>FN 651979v</span>
      </div>
      <div class="ign-cta__line">
        <span>UID</span>
        <span>ATU81975427</span>
      </div>
    </aside>

  </div>
</section>

<style>
.ign-cta {
  background: var(--gradient-copper);
  color: var(--bone);
  padding: 112px 28px;
  position: relative;
  overflow: hidden;
}
.ign-cta::after {
  content: "";
  position: absolute;
  top: -50%; right: -10%;
  width: 60%; height: 200%;
  background: radial-gradient(circle, rgba(245,242,236,0.08) 0%, transparent 60%);
  pointer-events: none;
}
.ign-cta__inner {
  max-width: var(--container-max);
  margin: 0 auto;
  display: grid;
  grid-template-columns: 1.4fr 1fr;
  gap: 56px;
  align-items: center;
  position: relative;
  z-index: 1;
}
.ign-cta__eyebrow {
  color: rgba(245,242,236,0.85);
}
.ign-cta__eyebrow::before {
  background: rgba(245,242,236,0.85);
}
.ign-cta__h2 {
  font-family: var(--ff-display);
  font-weight: 500;
  font-size: clamp(36px, 4.6vw, 56px);
  line-height: 1.04;
  letter-spacing: -0.035em;
  color: var(--bone);
  margin: 10px 0 20px;
}
.ign-cta__p {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 18px;
  line-height: 1.55;
  color: rgba(245,242,236,0.9);
  max-width: 46ch;
  margin: 0 0 32px;
}
.ign-cta__buttons {
  display: flex;
  gap: 12px;
  flex-wrap: wrap;
}

.ign-cta__card {
  background: rgba(15,10,8,0.55);
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
  border: 1px solid rgba(245,242,236,0.15);
  border-radius: var(--r-4);
  padding: 32px;
}
.ign-cta__card-h {
  font-family: var(--ff-mono);
  font-weight: 500;
  font-size: 11px;
  letter-spacing: 0.22em;
  text-transform: uppercase;
  color: rgba(245,242,236,0.65);
  margin: 0 0 18px;
}
.ign-cta__line {
  padding: 12px 0;
  border-top: 1px solid rgba(245,242,236,0.12);
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 14.5px;
  gap: 16px;
}
.ign-cta__line:first-of-type {
  border-top: 0;
}
.ign-cta__line span:first-child {
  font-family: var(--ff-mono);
  font-size: 12px;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: rgba(245,242,236,0.65);
}
.ign-cta__line span:last-child {
  color: var(--bone);
  font-family: var(--ff-body);
  font-weight: 500;
  text-align: right;
}
.ign-cta__line a {
  color: var(--bone);
  text-decoration: none;
}
.ign-cta__line a:hover {
  color: #FFD8A6;
  text-decoration: none;
}

@media (max-width: 960px) {
  .ign-cta__inner { grid-template-columns: 1fr; gap: 40px; }
  .ign-cta { padding: 80px 24px; }
}
</style>
```

---

## 4 · Verifikation

- [ ] Voller Copper-Gradient-Hintergrund mit dezenten Lichtspot rechts
- [ ] Glass-Card rechts: Backdrop-Blur, Bone-Trennlinien
- [ ] 5 Direktkontakt-Zeilen in der Card
- [ ] Mobile: Single-Column, Card unter dem Copy-Block

## 5 · Anpassungspunkte

- **Telefon:** `+43 (0) — TBD` durch reale Nummer ersetzen
- **E-Mail-Subject:** Bei Bedarf `mailto:office@ignitec.at?subject=…` mit Vorbefüllung
- **Konfigurator-CTA:** URL anpassen, sobald Konfigurator-Page existiert
- **Lead-Text:** "innerhalb von zwei Werktagen" konsistent mit dem 48-h-Versprechen aus Hero und Footer halten
