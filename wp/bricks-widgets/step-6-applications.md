# STEP 6 — Anwendungen · Übersichtsseite (`/anwendungen/`)

**Eine** Übersichtsseite mit 6 Anwendungs-Sektionen. **Keine Einzelseiten** (laut Scope). Jede Sektion ist über einen Anchor-Link aus dem Homepage-Anwendungen-Block erreichbar (`#bess`, `#schaltanlagen` etc.).

> **Scope-Hinweis:** Im Scope der Auftraggeber-Checkliste explizit nur als Übersicht definiert. Wenn später Einzelseiten gewünscht sind, kann dieser Block in einen Custom Post Type überführt werden — bleibt vorerst aber **eine reguläre WordPress-Page** mit mehreren Bricks-Sections.

---

## 1 · WordPress-Seite anlegen

- [ ] **Seiten → Neu** · Titel `Anwendungen` · Slug `anwendungen`
- [ ] In Bricks öffnen → die Sektionen unten als 7 separate Bricks-Sections aufbauen (1 Intro + 6 Anwendungs-Anker)

## 2 · Layout-Aufbau in Bricks

| # | Section | Inhalt | Code-Element? |
|---|---|---|---|
| 1 | Hero/Intro | Eyebrow + H1 + Lead | reines Bricks-Heading + Text |
| 2 | BESS (`#bess`) | Anwendungs-Block | 1 Code-Element |
| 3 | Schaltanlagen (`#schaltanlagen`) | dito | 1 Code-Element |
| 4 | Serverraum (`#serverraum`) | dito | 1 Code-Element |
| 5 | Maschinenraum (`#maschinenraum`) | dito | 1 Code-Element |
| 6 | Fahrzeug (`#fahrzeug`) | dito | 1 Code-Element |
| 7 | Windkraft (`#windkraft`) | dito | 1 Code-Element |

Empfohlen: **eine** zentrale "Anwendungs-Block-Komponente" als Bricks-Template und 6× verwenden mit unterschiedlichen Daten — oder im Code-Element einfach 6× den unten gezeigten Block einfügen mit angepasstem Inhalt.

## 3 · Hero/Intro-Section (oben)

```html
<section class="ign-app-intro">
  <div class="ign-container">
    <span class="eyebrow">Anwendungsbereiche</span>
    <h1 class="ign-app-intro__h1">
      Sechs Felder. Eine Antwort:<br>
      <em class="ign-app-intro__h1-accent">Aerosol.</em>
    </h1>
    <p class="ign-app-intro__lead">
      Kondensierte Aerosol-Generatoren schützen geschlossene Volumina dort, wo
      Wasser, Pulver oder fluorierte Gase nicht in Frage kommen — von Battery-Storage
      bis Windkraft-Gondel.
    </p>

    <nav class="ign-app-intro__toc" aria-label="Anker-Navigation">
      <a href="#bess">01 BESS &amp; Batteriespeicher</a>
      <a href="#schaltanlagen">02 Schaltanlagen</a>
      <a href="#serverraum">03 Serverraum</a>
      <a href="#maschinenraum">04 Maschinenraum</a>
      <a href="#fahrzeug">05 Fahrzeuge</a>
      <a href="#windkraft">06 Windkraft</a>
    </nav>
  </div>
</section>

<style>
.ign-app-intro {
  background: var(--bone);
  padding: 140px 0 64px;
}
.ign-app-intro__h1 {
  font-family: var(--ff-display);
  font-weight: 600;
  font-size: clamp(40px, 5vw, 64px);
  line-height: 1.02;
  letter-spacing: -0.04em;
  color: var(--slateblue);
  margin: 12px 0 20px;
  max-width: 18ch;
}
.ign-app-intro__h1-accent {
  font-family: var(--ff-display);
  font-style: italic;
  font-weight: 600;
  background: linear-gradient(92deg, #793907 0%, #C8691E 100%);
  -webkit-background-clip: text;
  background-clip: text;
  -webkit-text-fill-color: transparent;
  color: transparent;
}
.ign-app-intro__lead {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 19px;
  line-height: 1.55;
  color: var(--fg-2);
  max-width: 60ch;
  margin: 0 0 40px;
}
.ign-app-intro__toc {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 8px;
  border-top: 1px solid rgba(21,34,52,0.1);
  padding-top: 24px;
}
.ign-app-intro__toc a {
  font-family: var(--ff-mono);
  font-weight: 500;
  font-size: 12px;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: var(--fg-2);
  text-decoration: none;
  padding: 8px 0;
  border-bottom: 1px solid rgba(21,34,52,0.06);
}
.ign-app-intro__toc a:hover { color: var(--copper-solid); border-bottom-color: var(--copper-solid); }

@media (max-width: 720px) {
  .ign-app-intro__toc { grid-template-columns: 1fr; }
}
</style>
```

## 4 · Anwendungs-Block (6× verwenden, je mit eigener Anker-ID)

**Beispiel: BESS** — die anderen 5 funktionieren strukturell identisch. Inhalt vom Auftraggeber.

```html
<section class="ign-app-block" id="bess">
  <div class="ign-container ign-app-block__inner">

    <div class="ign-app-block__copy">
      <span class="eyebrow">Anwendungsfeld 01</span>
      <h2 class="ign-app-block__h2">BESS &amp; Batteriespeicher</h2>
      <p class="ign-app-block__lead">
        Battery-Energy-Storage-Systems (BESS) und Lithium-Ionen-Racks bringen ein
        spezifisches Risiko mit: Thermal Runaway. Eine einzelne Zelle kann die
        Nachbarzellen entzünden — innerhalb weniger Minuten.
      </p>

      <h3 class="ign-app-block__h3">Wie Aerosol hier wirkt</h3>
      <p class="ign-app-block__p">
        Der Generator ist direkt am Risiko montiert (Rack, Battery-Modul, Gehäuse).
        Bei thermischer oder elektrischer Auslösung verteilt sich das Aerosol
        binnen ≤ 20 s und unterbricht die Kettenreaktion bevor das Feuer auf
        Nachbarmodule übergreift. Kein Drucktank, keine Verrohrung, kein
        Flutungs-Volumen-Gefängnis.
      </p>

      <h3 class="ign-app-block__h3">Typische Auslegung</h3>
      <ul class="ign-app-block__ul">
        <li>Schutzvolumen pro Modul: 0,3 – 1,5 m³</li>
        <li>Auslösung: thermisch primär, elektrisch via BMS-Kontakt</li>
        <li>Empfohlene Größen: <strong>IGNI-ST060</strong> bis <strong>IGNI-ST250</strong></li>
        <li>Norm: CEN/TR 15276-1, ergänzende Richtlinien für Li-Ion</li>
      </ul>
    </div>

    <aside class="ign-app-block__facts">
      <dl>
        <div><dt>Volumen</dt><dd>0,3 – 1,5 m³</dd></div>
        <div><dt>Reaktion</dt><dd>≤ 20 s</dd></div>
        <div><dt>Auslösung</dt><dd>Thermisch + Elektrisch</dd></div>
        <div><dt>Empfohlen</dt><dd>ST-60 / ST-100 / ST-250</dd></div>
      </dl>
      <a class="ign-btn ign-btn--ghost-dark" href="/produkte/?serie=ST-60,ST-100,ST-250">Passende Geräte ansehen →</a>
    </aside>

  </div>
</section>

<style>
.ign-app-block {
  background: var(--bone);
  padding: 72px 0;
  border-top: 1px solid rgba(21,34,52,0.08);
  scroll-margin-top: 96px;  /* Für Anchor-Sprung mit Sticky-Header */
}
.ign-app-block:nth-of-type(even) {
  background: var(--bone-50);
}
.ign-app-block__inner {
  display: grid;
  grid-template-columns: 1.6fr 1fr;
  gap: 56px;
  align-items: start;
}
.ign-app-block__h2 {
  font-family: var(--ff-display);
  font-weight: 600;
  font-size: clamp(28px, 3.4vw, 40px);
  letter-spacing: -0.03em;
  color: var(--slateblue);
  margin: 10px 0 20px;
}
.ign-app-block__h3 {
  font-family: var(--ff-display);
  font-weight: 600;
  font-size: 19px;
  letter-spacing: -0.02em;
  color: var(--slateblue);
  margin: 24px 0 8px;
}
.ign-app-block__lead {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 18px;
  line-height: 1.55;
  color: var(--fg-2);
  margin: 0 0 8px;
  max-width: 56ch;
}
.ign-app-block__p {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 16px;
  line-height: 1.65;
  color: var(--fg-2);
  margin: 0 0 12px;
  max-width: 60ch;
}
.ign-app-block__ul {
  list-style: none;
  padding: 0;
  margin: 8px 0 0;
  font-family: var(--ff-body);
  font-size: 15px;
  line-height: 1.7;
  color: var(--fg-2);
}
.ign-app-block__ul li {
  padding-left: 20px;
  position: relative;
  margin-bottom: 4px;
}
.ign-app-block__ul li::before {
  content: "—";
  position: absolute;
  left: 0;
  color: var(--copper-solid);
}
.ign-app-block__ul strong { color: var(--slateblue); font-weight: 600; }

.ign-app-block__facts {
  background: var(--bone);
  border: 1px solid rgba(21,34,52,0.08);
  border-radius: var(--r-4);
  padding: 24px;
  position: sticky;
  top: 120px;
}
.ign-app-block:nth-of-type(even) .ign-app-block__facts { background: var(--bone-50); }
.ign-app-block__facts dl {
  margin: 0 0 20px;
  display: flex;
  flex-direction: column;
  gap: 14px;
}
.ign-app-block__facts dl div { margin: 0; }
.ign-app-block__facts dt {
  font-family: var(--ff-mono);
  font-size: 11px;
  letter-spacing: 0.18em;
  text-transform: uppercase;
  color: var(--fg-3);
  margin-bottom: 4px;
}
.ign-app-block__facts dd {
  font-family: var(--ff-display);
  font-weight: 600;
  font-size: 16px;
  color: var(--slateblue);
  margin: 0;
}

@media (max-width: 960px) {
  .ign-app-block__inner { grid-template-columns: 1fr; }
  .ign-app-block__facts { position: static; }
}
</style>
```

## 5 · Sechs Anwendungen · Inhalts-Vorlagen

Für die Pflege durch den Auftraggeber — eine Tabelle mit Kopier-Vorlage:

| Anker | Titel | Volumen | Empfohlene Geräte |
|---|---|---|---|
| `#bess` | BESS & Batteriespeicher | 0,3 – 1,5 m³ | ST-60, ST-100, ST-250 |
| `#schaltanlagen` | Schaltanlagen & Trafostationen | 0,5 – 5 m³ | ST-100, ST-250, ST-500 |
| `#serverraum` | Serverraum & Datacenter | 1 – 5 m³ | ST-250, ST-500, ST-1000 |
| `#maschinenraum` | Maschinen & CNC-Zentren | 1 – 10 m³ | ST-250, ST-500, ST-1000 |
| `#fahrzeug` | Busse, Bahn & Sonderfahrzeuge | 0,3 – 2 m³ | ST-60, ST-100, ST-250 |
| `#windkraft` | Windkraft & Anlagentechnik | 2 – 10 m³ | ST-250, ST-500, ST-1000 |

## 6 · SEO & Schema

- [ ] In **Rank Math Pro** für die Seite einen klaren Title + Description setzen
- [ ] Keine eigenen Single-Pages → kein Schema pro Anwendung
- [ ] Heading-Hierarchie: 1× H1 (Hero-Intro), 6× H2 (Anwendungs-Sections), H3 für Subheadings → SEO-clean

## 7 · Verifikation

- [ ] `/anwendungen/` lädt mit 1 Hero + 6 Anwendungs-Sections
- [ ] Anker-Links springen sauber (Sticky-Header berücksichtigt via `scroll-margin-top`)
- [ ] Toc-Navigation oben funktioniert
- [ ] "Passende Geräte ansehen →" verlinkt auf Shop-Archiv mit Filter (sobald Produkt-Archiv steht — STEP 4)
- [ ] Mobile: Single-Column, Sticky-Facts deaktiviert
- [ ] Crossbrowser-Check (Chrome, FF, Safari, Edge)

## 8 · Anpassungspunkte

- **Inhalte 6× pflegen:** Pro Anwendung Block kopieren, Anker-ID + Texte ändern
- **Empfohlene Geräte-Filter:** `?serie=ST-XX,ST-YY` setzt Bricks-Filter im Shop-Archiv (sobald STEP 4 fertig)
- **Sticky-Fact-Box:** Wenn nicht gewünscht, `position: sticky` entfernen
