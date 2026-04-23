# STEP 3.6 — Homepage · Prozess / Ablauf

4-Step Timeline auf dunklem Slate-Blue-Hintergrund. Zeigt den B2B-Projektablauf: **Analyse → Auslegung → Installation → Wartung**. Kommuniziert Verlässlichkeit und klare Zuständigkeiten — zentrales Argument für Entscheider:innen.

**Schema.org:** `HowTo` JSON-LD eingebettet — Featured-Snippet-fähig.

---

## 1 · Platzierung

**Bricks → Pages → Startseite** — **6. Section** unter Technologie-USP. Container Full-Width, darin **1 Code-Element**.

## 2 · Code-Widget-Inhalt

```php
<?php
/**
 * IGNITEC · Prozess / Ablauf
 * 4-Step-Timeline mit HowTo-JSON-LD für Featured Snippets.
 */

$steps = [
	[
		'no'    => '01',
		'title' => 'Analyse',
		'short' => 'Risiko, Volumen, Umgebung',
		'long'  => 'Wir erfassen das zu schützende Volumen, die Umgebungstemperaturen und die Energie- bzw. Brandlast-Profile. Remote-Formular oder Vor-Ort-Begehung.',
		'duration' => 'Typ. 1–3 Werktage',
	],
	[
		'no'    => '02',
		'title' => 'Auslegung',
		'short' => '100 g/m³ · CEN/TR 15276-1',
		'long'  => 'Normenkonforme Berechnung der Aerosol-Menge, Platzierung der Generatoren und Auslöse-Logik. Dokumentation mit Plan und Datenblatt.',
		'duration' => 'Innerhalb 48 h',
	],
	[
		'no'    => '03',
		'title' => 'Installation',
		'short' => 'Schnell · mechanisch',
		'long'  => 'Montage durch zertifizierte Partner oder Endkunden-Team. Keine Verrohrung, keine Druckprüfung, kein Nassraum-Eingriff.',
		'duration' => 'Halber bis ganzer Werktag',
	],
	[
		'no'    => '04',
		'title' => 'Wartung',
		'short' => 'Sichtprüfung · 15 Jahre',
		'long'  => 'Jährliche Sichtprüfung der Thermoauslöser und Kontakte. Kein Druckbehälter → keine wiederkehrende Druckprüfung. Austausch nach 15 Jahren.',
		'duration' => 'Jährlich · 15 min / Gerät',
	],
];

$howto_schema = [
	'@context'    => 'https://schema.org',
	'@type'       => 'HowTo',
	'name'        => 'Aerosol-Löschsystem planen und installieren',
	'description' => 'Vier-Schritte-Ablauf von Analyse bis Wartung eines kondensierten Aerosol-Löschsystems nach CEN/TR 15276-1.',
	'step'        => array_map( function ( $s ) {
		return [
			'@type' => 'HowToStep',
			'name'  => $s['title'],
			'text'  => $s['long'],
		];
	}, $steps ),
];
?>

<section class="ign-process ign-section" aria-labelledby="ign-process-head">
  <div class="ign-container">
    <span class="eyebrow" style="color:var(--copper-light);">PROZESS</span>
    <h2 id="ign-process-head" class="ign-process__h2">
      Von der Anfrage zur <span class="black">einsatzbereiten Anlage.</span>
    </h2>
    <p class="ign-process__lead">
      Vier klar getrennte Phasen. Jede mit definierter Leistung, definierter Dauer und definierter Verantwortung.
    </p>

    <ol class="ign-process__timeline">
      <?php foreach ( $steps as $i => $s ) : ?>
        <li class="ign-process__step">
          <div class="ign-process__marker">
            <span class="ign-process__no"><?php echo esc_html( $s['no'] ); ?></span>
          </div>
          <div class="ign-process__body">
            <h3 class="ign-process__title"><?php echo esc_html( $s['title'] ); ?></h3>
            <div class="ign-process__short"><?php echo esc_html( $s['short'] ); ?></div>
            <p class="ign-process__long"><?php echo esc_html( $s['long'] ); ?></p>
            <div class="ign-process__duration"><?php echo esc_html( $s['duration'] ); ?></div>
          </div>
        </li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>

<script type="application/ld+json">
<?php echo wp_json_encode( $howto_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ); ?>
</script>

<style>
.ign-process {
  background: var(--ink-000);
  color: var(--fg-on-dark-1);
}
.ign-process__h2 {
  font-family: var(--ff-display);
  font-weight: 500;
  font-size: clamp(32px, 4vw, 48px);
  line-height: 1.03;
  letter-spacing: -0.04em;
  color: var(--bone);
  margin: 10px 0 14px;
}
.ign-process__h2 .black { font-weight: 900; }
.ign-process__lead {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 17px;
  line-height: 1.55;
  color: var(--fg-on-dark-2);
  max-width: 60ch;
  margin: 0 0 48px;
}

.ign-process__timeline {
  list-style: none;
  padding: 0;
  margin: 0;
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 24px;
  position: relative;
}
.ign-process__timeline::before {
  content: "";
  position: absolute;
  top: 30px; left: 40px; right: 40px;
  height: 1px;
  background: linear-gradient(90deg,
    rgba(208,110,61,0.4) 0%,
    rgba(208,110,61,0.4) 50%,
    rgba(245,242,236,0.08) 100%);
  z-index: 0;
}
.ign-process__step {
  position: relative;
  z-index: 1;
}
.ign-process__marker {
  width: 60px; height: 60px;
  background: var(--ink-100);
  border: 1px solid rgba(208,110,61,0.35);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 20px;
  position: relative;
}
.ign-process__marker::after {
  content: "";
  position: absolute;
  inset: -4px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(208,110,61,0.22) 0%, rgba(208,110,61,0) 70%);
  z-index: -1;
}
.ign-process__no {
  font-family: var(--ff-mono);
  font-weight: 500;
  font-size: 13px;
  letter-spacing: 0.12em;
  color: var(--copper-light);
}
.ign-process__title {
  font-family: var(--ff-display);
  font-weight: 600;
  font-size: 22px;
  letter-spacing: -0.02em;
  color: var(--bone);
  margin: 0 0 6px;
}
.ign-process__short {
  font-family: var(--ff-mono);
  font-weight: 500;
  font-size: 11px;
  letter-spacing: 0.16em;
  text-transform: uppercase;
  color: var(--copper-light);
  margin-bottom: 14px;
}
.ign-process__long {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 14px;
  line-height: 1.55;
  color: var(--fg-on-dark-2);
  margin: 0 0 18px;
}
.ign-process__duration {
  font-family: var(--ff-mono);
  font-size: 11px;
  letter-spacing: 0.12em;
  color: var(--fg-on-dark-3);
  padding-top: 14px;
  border-top: 1px solid rgba(245,242,236,0.08);
}

@media (max-width: 960px) {
  .ign-process__timeline { grid-template-columns: 1fr 1fr; }
  .ign-process__timeline::before { display: none; }
}
@media (max-width: 560px) {
  .ign-process__timeline { grid-template-columns: 1fr; gap: 36px; }
}
</style>
```

---

## 3 · SEO/GEO-Notiz

- **HowTo JSON-LD** — Google kann die 4 Schritte als Rich-Result anzeigen (Step-Carousel).
- **Jeder Step** hat H3-Titel + ausführliche Description → semantisch für LLMs.
- **Duration-Angaben** ("48 h", "15 min / Gerät") sind konkrete Signale, die in "Wie lange dauert die Planung einer Aerosol-Anlage?"-Antworten landen können.

## 4 · Verifikation

- [ ] Dunkler Slate-Blue Hintergrund
- [ ] 4 Schritte mit Nummern-Kreisen, horizontale Copper-Linie zwischen Markern
- [ ] Rich-Results-Test zeigt `HowTo`-Schema valid
- [ ] Responsive: 2 Spalten Tablet, 1 Spalte Mobile

## 5 · Anpassungspunkte

- **Steps editieren**: `$steps`-Array oben im Block (Nummer, Titel, Kurz, Lang, Duration).
- **Anzahl der Steps**: Grid-Columns automatisch über `repeat(4, 1fr)` — bei 3 oder 5 Schritten manuell anpassen.

---

**Nach Verifikation → STEP 3.7 (FAQ) freigeben.**
