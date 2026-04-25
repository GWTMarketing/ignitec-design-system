# STEP 3.8 — Homepage · FAQ (optional · GEO-Erweiterung)

6 native `<details>`-Accordions mit FAQPage-JSON-LD. **Nicht** im Mockup `home.html` enthalten, aber **stark empfohlen** für Featured-Snippets und LLM-Zitate. Brand-konform: dezente Bone-Bühne, Short-Answer-First, native HTML-Elemente ohne JS.

**Position:** als letzte Section auf der Homepage, **unter** dem CTA aus STEP 3.7. Wer den CTA als Final-Section möchte, kann diesen Step überspringen.

---

## 1 · Platzierung

**Bricks → Pages → Startseite** — **8. Section** unter CTA. Container Full-Width, **1 Code-Element**.

## 2 · Code-Widget-Inhalt

```php
<?php
/**
 * IGNITEC · FAQ (native <details>) + FAQPage JSON-LD
 * Short-Answer-First — optimiert für Featured Snippets und LLM-Zitate.
 */

$faqs = [
	[
		'q' => 'Was ist ein kondensiertes Aerosol-Löschsystem?',
		'a_short' => 'Ein Aerosolgenerator erzeugt bei Auslösung mikrofeine Feststoff-Partikel, die die chemische Kettenreaktion der Verbrennung unterbrechen — ohne Druckbehälter und ohne Verrohrung.',
		'a_long' => 'Im Gegensatz zu Gas-Lösch-Anlagen speichert ein Aerosolgenerator den Wirkstoff in fester Form. Bei thermischer oder elektrischer Auslösung wird das Aerosol in ≤ 20 Sekunden freigesetzt und verteilt sich homogen im Schutzvolumen. Der Wirkmechanismus ist katalytisch — die Partikel stören die Radikalbildung in der Flamme. Rückstände sind trocken und unschädlich für elektronische Komponenten.',
	],
	[
		'q' => 'Für welche Einsatzbereiche eignet sich die Serie ST?',
		'a_short' => 'Geschlossene oder weitgehend geschlossene Volumina von 0,4 bis 27 m³: Schaltschränke, BESS-Battery-Racks, Maschinenräume, Serverräume, Spezialfahrzeuge, Windkraftgondeln.',
		'a_long' => 'Die Serie ST umfasst acht Gerätegrößen (30 g bis 2,0 kg Aerosolmasse). Die Gerätewahl folgt der Auslegungs-Konzentration. Für Bereiche über 27 m³ werden mehrere Generatoren kombiniert. Nicht geeignet sind offene Freiflächen, flüssige Brände der Klasse B in Wannenform sowie reaktive Metallbrände (Klasse D).',
	],
	[
		'q' => 'Wie lange dauert die Auslegung eines Schutzkonzepts?',
		'a_short' => 'Innerhalb von zwei Werktagen ab vollständiger Anfrage. Die Auslegung folgt CEN/TR 15276-1.',
		'a_long' => 'Voraussetzung ist die Angabe des Schutzvolumens, der Betriebstemperaturen und der Auslöse-Art (thermisch, elektrisch, dual). Mit diesen Daten berechnen wir Aerosol-Menge, Gerätewahl und Positionierung. Die Dokumentation umfasst Berechnungsblatt, Installationsplan und Datenblätter. Bei komplexen Objekten (BESS-Großspeicher, Mehr-Zonen-Auslegung) kann die Vor-Ort-Begehung 1–3 zusätzliche Werktage dauern.',
	],
	[
		'q' => 'Welche Wartungsarbeiten sind erforderlich?',
		'a_short' => 'Jährliche Sichtprüfung der Thermoauslöser und Kontakte. Keine wiederkehrende Druckprüfung — der Generator enthält keinen Druckbehälter.',
		'a_long' => 'Der Aufwand liegt bei rund 15 Minuten pro Gerät. Geprüft werden Sichtzustand des Gehäuses, Festigkeit der Kontakte, Funktion der thermischen Auslösung (Glaskolben oder Meltlink) sowie die elektrische Continuity bei Dual-Auslösung. Wartung ist nicht zertifizierungspflichtig und kann durch geschultes Endkunden-Personal erfolgen.',
	],
	[
		'q' => 'Ist Aerosol-Löschen umweltverträglich?',
		'a_short' => 'Ja. GWP 0 und ODP 0. Die Serie ST enthält keine fluorierten Treibhausgase, kein PFAS und keine Ozonabbaustoffe.',
		'a_long' => 'Das Aerosol basiert auf Kaliumsalzen und organischen Bindern. Nach Freisetzung bleiben trockene, nicht-toxische Feststoff-Rückstände zurück, die mit einem Staubsauger entfernt werden. Die F-Gas-Verordnung (EU 517/2014, Update 2024) ist nicht anwendbar, eine Meldepflicht besteht nicht. Im Gegensatz zu HFC-Gas-Anlagen gibt es keine Entsorgungs-Zusatzkosten am Lebensende.',
	],
	[
		'q' => 'Welche Normen und Zulassungen erfüllt die Serie ST?',
		'a_short' => 'CEN/TR 15276-1 (europäische Auslegungsregel für kondensierte Aerosole) und ISO 15779. Typprüfung nach EN 15276. VdS- und UL-Listungen verfügbar.',
		'a_long' => 'Die Auslegung nach CEN/TR 15276-1 ist in Deutschland, Österreich und weiteren EU-Staaten anerkannt. ISO 15779 bildet die internationale Basis. Für VdS-geforderte Objekte (Versicherungsvorgaben) bieten wir gelistete Varianten; UL-2775 wird für den US-Export angeboten. Maschinen-Richtlinie 2006/42/EG, EMV-Richtlinie und CE-Kennzeichnung sind bei allen Geräten erfüllt.',
	],
];

$schema = [
	'@context'  => 'https://schema.org',
	'@type'     => 'FAQPage',
	'mainEntity' => array_map( function ( $f ) {
		return [
			'@type' => 'Question',
			'name'  => $f['q'],
			'acceptedAnswer' => [
				'@type' => 'Answer',
				'text'  => $f['a_short'] . ' ' . $f['a_long'],
			],
		];
	}, $faqs ),
];
?>

<section class="ign-faq ign-section" aria-labelledby="ign-faq-head">
  <div class="ign-container ign-faq__inner">

    <div class="ign-faq__copy">
      <span class="eyebrow">Häufige Fragen</span>
      <h2 id="ign-faq-head" class="ign-faq__h2">
        Kurz erklärt.<br>
        <strong>In Tiefe dokumentiert.</strong>
      </h2>
      <p class="ign-faq__lead">
        Die wichtigsten Fragen aus Planungs-Workshops — mit sofort zitierbaren Kurzantworten
        und technischer Tiefe für Detailprüfung.
      </p>
      <a class="ign-btn ign-btn--ghost-dark" href="/wissen/">Vollständige Wissensdatenbank →</a>
    </div>

    <div class="ign-faq__list">
      <?php foreach ( $faqs as $i => $f ) : ?>
        <details class="ign-faq__item"<?php echo $i === 0 ? ' open' : ''; ?>>
          <summary class="ign-faq__q">
            <span class="ign-faq__q-text"><?php echo esc_html( $f['q'] ); ?></span>
            <span class="ign-faq__q-icon" aria-hidden="true"></span>
          </summary>
          <div class="ign-faq__a">
            <p class="ign-faq__a-short"><?php echo esc_html( $f['a_short'] ); ?></p>
            <p class="ign-faq__a-long"><?php echo esc_html( $f['a_long'] ); ?></p>
          </div>
        </details>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<script type="application/ld+json">
<?php echo wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ); ?>
</script>

<style>
.ign-faq { background: var(--bone); }
.ign-faq__inner {
  display: grid;
  grid-template-columns: 1fr 1.4fr;
  gap: 72px;
  align-items: flex-start;
}
.ign-faq__h2 {
  font-family: var(--ff-display);
  font-weight: 500;
  font-size: clamp(32px, 3.6vw, 48px);
  line-height: 1.03;
  letter-spacing: -0.035em;
  color: var(--slateblue);
  margin: 10px 0 14px;
}
.ign-faq__h2 strong { font-weight: 900; }
.ign-faq__lead {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 17px;
  line-height: 1.55;
  color: var(--fg-2);
  max-width: 48ch;
  margin: 0 0 24px;
}

.ign-faq__list { display: flex; flex-direction: column; gap: 4px; }
.ign-faq__item {
  background: var(--bone-50);
  border: 1px solid rgba(21,34,52,0.06);
  border-radius: var(--r-4);
  transition: border-color var(--dur-base) var(--ease-standard),
              box-shadow var(--dur-base) var(--ease-standard);
}
.ign-faq__item[open] {
  border-color: rgba(121,57,7,0.25);
  box-shadow: var(--shadow-2);
}
.ign-faq__q {
  list-style: none;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 24px;
  padding: 22px 26px;
  cursor: pointer;
  user-select: none;
}
.ign-faq__q::-webkit-details-marker { display: none; }
.ign-faq__q-text {
  font-family: var(--ff-display);
  font-weight: 600;
  font-size: 18px;
  letter-spacing: -0.015em;
  color: var(--slateblue);
  line-height: 1.35;
}
.ign-faq__q-icon {
  position: relative;
  width: 20px; height: 20px;
  flex-shrink: 0;
}
.ign-faq__q-icon::before,
.ign-faq__q-icon::after {
  content: "";
  position: absolute;
  background: var(--copper-solid);
  top: 50%; left: 50%;
  transform: translate(-50%, -50%);
  transition: transform var(--dur-base) var(--ease-standard),
              opacity var(--dur-base) var(--ease-standard);
}
.ign-faq__q-icon::before { width: 14px; height: 2px; }
.ign-faq__q-icon::after { width: 2px; height: 14px; }
.ign-faq__item[open] .ign-faq__q-icon::after { transform: translate(-50%, -50%) rotate(90deg); opacity: 0; }

.ign-faq__a {
  padding: 0 26px 26px;
  border-top: 1px solid rgba(21,34,52,0.06);
  margin-top: 4px;
  padding-top: 20px;
}
.ign-faq__a-short {
  font-family: var(--ff-body);
  font-weight: 500;
  font-size: 16px;
  line-height: 1.55;
  color: var(--slateblue);
  margin: 0 0 14px;
  padding-left: 14px;
  border-left: 2px solid var(--copper-solid);
}
.ign-faq__a-long {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 15px;
  line-height: 1.65;
  color: var(--fg-2);
  margin: 0;
}

@media (max-width: 960px) {
  .ign-faq__inner { grid-template-columns: 1fr; gap: 32px; }
}
</style>
```

---

## 3 · Verifikation

- [ ] FAQPage-JSON-LD valid im Google Rich Results Test
- [ ] Erstes FAQ-Item standardmäßig offen
- [ ] Plus → Minus beim Aufklappen, ohne JavaScript
- [ ] Short-Answer mit Copper-Border-Left
- [ ] Mobile: 1 Spalte
