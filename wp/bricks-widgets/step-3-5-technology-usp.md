# STEP 3.5 — Homepage · Technologie-USP

Split-Layout Copy links, Visual rechts. Erklärt in vier Argumenten, **warum kondensiertes Aerosol** die richtige Technologie ist — mit LLM-freundlichen Short-Facts und einer einleitenden Summary, die direkt in Featured-Snippets zitierbar ist.

**GEO-Fokus:** Diese Sektion ist der wichtigste zitierbare Informations-Block für "Wie funktioniert ein Aerosol-Löschgenerator?".

---

## 1 · Platzierung

**Bricks → Pages → Startseite** — **5. Section** unter Anwendungen. Container Full-Width, darin **1 Code-Element**.

## 2 · Code-Widget-Inhalt

```html
<section class="ign-usp ign-section" aria-labelledby="ign-usp-head">
  <div class="ign-container ign-usp__inner">

    <div class="ign-usp__copy">
      <span class="eyebrow">TECHNOLOGIE</span>
      <h2 id="ign-usp-head" class="ign-usp__h2">
        Warum <span class="black">kondensiertes Aerosol.</span>
      </h2>
      <p class="ign-usp__summary">
        Ein Aerosolgenerator erzeugt bei der Auslösung mikrofeine Feststoff-Partikel,
        die die Kettenreaktion der Verbrennung auf molekularer Ebene unterbrechen.
        <strong>Kein Druckbehälter</strong>, <strong>keine Verrohrung</strong>,
        <strong>keine Raum-Abdichtung</strong>. Direkt am Risiko montiert.
      </p>

      <ul class="ign-usp__points">
        <li class="ign-usp__point">
          <div class="ign-usp__icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true">
              <path d="M12 2 L13.5 9 L20 10 L15 14.5 L16.2 22 L12 18.5 L7.8 22 L9 14.5 L4 10 L10.5 9 Z"
                    stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/>
            </svg>
          </div>
          <div>
            <h3 class="ign-usp__point-title">Reaktion in Sekunden</h3>
            <p class="ign-usp__point-desc">
              Von Thermoauslöser zu vollständigem Aerosol-Ausstoß in ≤ 20 Sekunden —
              schneller als jede herkömmliche Gas- oder Wasserlösch-Anlage.
            </p>
          </div>
        </li>

        <li class="ign-usp__point">
          <div class="ign-usp__icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true">
              <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.6"/>
              <path d="M7 12.5 L10.5 16 L17 8.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <div>
            <h3 class="ign-usp__point-title">GWP 0 · ODP 0</h3>
            <p class="ign-usp__point-desc">
              Keine fluorierten Treibhausgase (PFAS-frei), keine Ozonabbaustoffe.
              Rückstände trocken und unschädlich für Elektronik.
            </p>
          </div>
        </li>

        <li class="ign-usp__point">
          <div class="ign-usp__icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true">
              <rect x="4" y="6" width="16" height="13" rx="1.5" stroke="currentColor" stroke-width="1.6"/>
              <path d="M8 6 V4 M16 6 V4 M4 10 H20" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
            </svg>
          </div>
          <div>
            <h3 class="ign-usp__point-title">15 Jahre wartungsfrei</h3>
            <p class="ign-usp__point-desc">
              Kein Druckbehälter — keine jährliche Druckprüfung. Funktionskontrolle per Sichtprüfung.
              Nach 15 Jahren Generator tauschen.
            </p>
          </div>
        </li>

        <li class="ign-usp__point">
          <div class="ign-usp__icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true">
              <path d="M12 2 L4 6 V12 C4 17 7.5 20.5 12 22 C16.5 20.5 20 17 20 12 V6 Z"
                    stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/>
            </svg>
          </div>
          <div>
            <h3 class="ign-usp__point-title">Normenkonform ausgelegt</h3>
            <p class="ign-usp__point-desc">
              CEN/TR 15276-1 und ISO 15779. Auslegung mit 100 g/m³ Löschkonzentration,
              validiert durch VdS-anerkannte Planer.
            </p>
          </div>
        </li>
      </ul>

      <div class="ign-usp__actions">
        <a class="ign-btn ign-btn--primary" href="/technologie/">Technologie im Detail →</a>
      </div>
    </div>

    <div class="ign-usp__visual" aria-hidden="true">
      <div class="ign-usp__visual-ring"></div>
      <div class="ign-usp__visual-ring ign-usp__visual-ring--2"></div>
      <div class="ign-usp__visual-core">
        <svg viewBox="0 0 140 140" width="60" height="60" aria-hidden="true">
          <path d="M42 118 V42 h24 c18 0 30 12 30 30 v46 h-18 v-44 c0 -9 -4 -14 -12 -14 h-7 v58 z" fill="#F5F2EC"/>
        </svg>
      </div>
      <div class="ign-usp__visual-orbit ign-usp__visual-orbit--1">
        <span>≤ 20 s</span>
      </div>
      <div class="ign-usp__visual-orbit ign-usp__visual-orbit--2">
        <span>100 g/m³</span>
      </div>
      <div class="ign-usp__visual-orbit ign-usp__visual-orbit--3">
        <span>GWP 0</span>
      </div>
      <div class="ign-usp__visual-orbit ign-usp__visual-orbit--4">
        <span>15 Jahre</span>
      </div>
    </div>

  </div>
</section>

<style>
.ign-usp {
  background: var(--bone);
}
.ign-usp__inner {
  display: grid;
  grid-template-columns: 1.2fr 1fr;
  gap: 72px;
  align-items: center;
}
.ign-usp__copy { min-width: 0; }
.ign-usp__h2 {
  font-family: var(--ff-display);
  font-weight: 500;
  font-size: clamp(32px, 4vw, 48px);
  line-height: 1.03;
  letter-spacing: -0.04em;
  color: var(--slateblue);
  margin: 10px 0 18px;
}
.ign-usp__h2 .black { font-weight: 900; }
.ign-usp__summary {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 18px;
  line-height: 1.55;
  color: var(--fg-2);
  max-width: 56ch;
  margin: 0 0 36px;
}
.ign-usp__summary strong { color: var(--slateblue); font-weight: 600; }

.ign-usp__points {
  list-style: none;
  padding: 0;
  margin: 0;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 28px 36px;
}
.ign-usp__point {
  display: grid;
  grid-template-columns: 40px 1fr;
  gap: 14px;
  align-items: flex-start;
}
.ign-usp__icon {
  width: 40px; height: 40px;
  background: var(--bone-200);
  border-radius: var(--r-3);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--copper-solid);
  flex-shrink: 0;
}
.ign-usp__point-title {
  font-family: var(--ff-display);
  font-weight: 600;
  font-size: 17px;
  letter-spacing: -0.02em;
  color: var(--slateblue);
  margin: 2px 0 6px;
}
.ign-usp__point-desc {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 14px;
  line-height: 1.55;
  color: var(--fg-2);
  margin: 0;
}

.ign-usp__actions { margin-top: 36px; }

/* ===== Visual (rechte Spalte) ===== */
.ign-usp__visual {
  position: relative;
  aspect-ratio: 1;
  max-width: 440px;
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: center;
}
.ign-usp__visual-ring {
  position: absolute;
  inset: 12%;
  border: 1px solid rgba(121,57,7,0.18);
  border-radius: 50%;
}
.ign-usp__visual-ring--2 {
  inset: 26%;
  border-color: rgba(121,57,7,0.10);
}
.ign-usp__visual-core {
  width: 110px; height: 110px;
  border-radius: 50%;
  background: var(--gradient-copper);
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 0 0 8px rgba(121,57,7,0.08), var(--shadow-3);
  position: relative;
  z-index: 2;
}
.ign-usp__visual-orbit {
  position: absolute;
  background: var(--bone-50);
  border: 1px solid rgba(21,34,52,0.08);
  box-shadow: var(--shadow-2);
  padding: 8px 14px;
  border-radius: var(--r-pill);
  font-family: var(--ff-mono);
  font-weight: 500;
  font-size: 12px;
  letter-spacing: 0.08em;
  color: var(--slateblue);
  z-index: 3;
}
.ign-usp__visual-orbit--1 { top: 6%;  left: 18%; }
.ign-usp__visual-orbit--2 { top: 14%; right: 8%; }
.ign-usp__visual-orbit--3 { bottom: 14%; left: 6%; }
.ign-usp__visual-orbit--4 { bottom: 6%; right: 20%; }

@media (max-width: 960px) {
  .ign-usp__inner { grid-template-columns: 1fr; gap: 48px; }
  .ign-usp__points { grid-template-columns: 1fr; gap: 24px; }
  .ign-usp__visual { order: -1; max-width: 340px; }
}
</style>
```

---

## 3 · SEO/GEO-Notiz

Die **Summary-Absatz** direkt unter H2 ist der wichtigste GEO-Block der ganzen Seite:

> "Ein Aerosolgenerator erzeugt bei der Auslösung mikrofeine Feststoff-Partikel, die die Kettenreaktion der Verbrennung auf molekularer Ebene unterbrechen. Kein Druckbehälter, keine Verrohrung, keine Raum-Abdichtung. Direkt am Risiko montiert."

- Beantwortet "Wie funktioniert kondensiertes Aerosol?" in 3 Sätzen
- Enthält alle technischen Abgrenzungsmerkmale (kein Druckbehälter, keine Verrohrung)
- Kurz genug zum vollständigen LLM-Zitat

Die 4 H3-Überschriften (Reaktion, GWP/ODP, Wartung, Normen) decken die typischen B2B-Entscheidungskriterien ab.

## 4 · Verifikation

- [ ] Split-Layout 1.2 / 1 Desktop, Single-Column Mobile (Visual zuerst)
- [ ] 4 USP-Punkte als 2×2-Grid
- [ ] Visual: Kern-Kreis mit Copper-Gradient, 2 Ringe, 4 Orbit-Pills
- [ ] Summary-Absatz maxim. 56ch, serverseitig sichtbar
- [ ] Button führt auf `/technologie/` (Unterseite wird später angelegt)

## 5 · Anpassungspunkte

- **Summary-Text**: Direkt im HTML — das ist der zentrale GEO-Text.
- **4 Punkte**: Titel + Desc im HTML editierbar. Icons sind Inline-SVG.
- **Orbit-Pills**: 4 kurze Key-Facts im Visual — jederzeit austauschbar.

---

**Nach Verifikation → STEP 3.6 (Prozess / Ablauf) freigeben.**
