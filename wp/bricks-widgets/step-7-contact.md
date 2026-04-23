# STEP 7 — Kontakt-Seite (`/kontakt/`)

Volle Kontakt-Seite: Intro-Hero, komplettes Formular (alle Projekt-Felder), Firmeninfo-Karte, datenschutzfreundliche OpenStreetMap, LocalBusiness-JSON-LD.

**Voraussetzung:** `functions.php` Abschnitt 9–11 geladen, und das Kontaktformular-Widget verstanden (siehe `widget-contact-form.md`).

---

## 1 · WordPress-Seite anlegen

**WP-Admin → Seiten → Hinzufügen**
- Titel: `Kontakt`
- Slug: `kontakt`
- Template: Standard (Bricks übernimmt Layout)

## 2 · Bricks-Seiten-Layout

In der Page-Edit-Ansicht mit Bricks die Seite öffnen → 3 Sections:

1. Section Full-Width → **1 Code-Element**: Hero-Intro (siehe Abschnitt 3)
2. Section Full-Width → **1 Code-Element**: Form + Info-Grid (siehe Abschnitt 4)
3. Section Full-Width → **1 Code-Element**: Map + LocalBusiness (siehe Abschnitt 5)

Alternativ: Alle drei Blöcke in ein einziges Code-Element — dann in der Entwurfs-UI als **1 Code-Widget pro Section** pflegen für einfache Editierbarkeit.

---

## 3 · Sektion A · Hero-Intro

```html
<section class="ign-contact-hero">
  <div class="ign-container ign-contact-hero__inner">
    <span class="eyebrow">KONTAKT</span>
    <h1 class="ign-contact-hero__h1">
      Schreiben Sie uns.<br>
      <span class="black">Wir melden uns binnen 4 Stunden.</span>
    </h1>
    <p class="ign-contact-hero__lead">
      B2B-Anfragen für Auslegung, Angebot, Partner-Programm oder Rückfragen zur Technologie.
      Wir arbeiten werktags von Montag bis Freitag.
    </p>

    <dl class="ign-contact-hero__quick">
      <div>
        <dt>E-Mail</dt>
        <dd><a href="mailto:office@ignitec.at">office@ignitec.at</a></dd>
      </div>
      <div>
        <dt>Reaktion</dt>
        <dd>≤ 4 h (werktags)</dd>
      </div>
      <div>
        <dt>Auslegung</dt>
        <dd>≤ 48 h</dd>
      </div>
    </dl>
  </div>
</section>

<style>
.ign-contact-hero {
  background: var(--bone);
  padding: 140px 0 72px;
}
.ign-contact-hero__inner { max-width: 840px; }
.ign-contact-hero__h1 {
  font-family: var(--ff-display);
  font-weight: 500;
  font-size: clamp(40px, 5vw, 64px);
  line-height: 1.02;
  letter-spacing: -0.04em;
  color: var(--slateblue);
  margin: 10px 0 20px;
}
.ign-contact-hero__h1 .black { font-weight: 900; }
.ign-contact-hero__lead {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 19px;
  line-height: 1.55;
  color: var(--fg-2);
  max-width: 62ch;
  margin: 0 0 32px;
}
.ign-contact-hero__quick {
  display: grid;
  grid-template-columns: repeat(3, auto);
  gap: 32px 64px;
  margin: 0;
  padding: 24px 0 0;
  border-top: 1px solid rgba(21,34,52,0.08);
  justify-content: start;
}
.ign-contact-hero__quick div { margin: 0; }
.ign-contact-hero__quick dt {
  font-family: var(--ff-mono);
  font-size: 11px;
  letter-spacing: 0.2em;
  text-transform: uppercase;
  color: var(--fg-3);
  margin-bottom: 4px;
}
.ign-contact-hero__quick dd {
  font-family: var(--ff-display);
  font-weight: 600;
  font-size: 18px;
  letter-spacing: -0.02em;
  color: var(--slateblue);
  margin: 0;
}
.ign-contact-hero__quick a { color: var(--copper-solid); text-decoration: none; }
.ign-contact-hero__quick a:hover { color: var(--accent-hover); text-decoration: underline; }

@media (max-width: 720px) {
  .ign-contact-hero__quick { grid-template-columns: 1fr; gap: 18px; }
}
</style>
```

---

## 4 · Sektion B · Formular + Info-Grid

Das Formular ist **der komplette Code aus `widget-contact-form.md`**, eingebettet in einen 2-Spalten-Grid. Links das Formular, rechts eine Info-Karte mit Firmendaten, Ansprechpartner:in und direkten Anwendungs-Links.

```php
<?php
$action_url = esc_url( admin_url( 'admin-post.php' ) );
$nonce      = wp_create_nonce( 'ignitec_inquiry' );
?>

<section class="ign-contact-main ign-section">
  <div class="ign-container ign-contact-main__grid">

    <!-- Linke Spalte: Formular -->
    <div class="ign-contact-main__form-col">
      <h2 class="ign-contact-main__h2">Anfrage an Ignitec</h2>
      <p class="ign-contact-main__p">
        Pflichtfelder sind mit <span aria-hidden="true">*</span> markiert.
        Die Projekt-Angaben helfen uns, die Auslegung beim ersten Rückruf direkt vorzubereiten.
      </p>

      <!-- === FORMULAR-CODE IDENTISCH zu widget-contact-form.md === -->
      <form class="ign-form" id="ign-form" method="post" action="<?php echo $action_url; ?>" novalidate>
        <input type="hidden" name="action" value="ignitec_inquiry">
        <input type="hidden" name="ignitec_nonce" value="<?php echo esc_attr( $nonce ); ?>">
        <div aria-hidden="true" style="position:absolute;left:-10000px;top:auto;width:1px;height:1px;overflow:hidden;">
          <label>Website<input type="text" name="ignitec_website" tabindex="-1" autocomplete="off"></label>
        </div>

        <fieldset class="ign-form__group">
          <legend>Kontakt</legend>
          <div class="ign-form__row">
            <div class="ign-form__field ign-form__field--inline">
              <label for="ign-anrede">Anrede</label>
              <select name="anrede" id="ign-anrede">
                <option value="">—</option>
                <option value="Frau">Frau</option>
                <option value="Herr">Herr</option>
                <option value="divers">divers</option>
              </select>
            </div>
            <div class="ign-form__field ign-form__field--required">
              <label for="ign-firma">Firma <span aria-hidden="true">*</span></label>
              <input type="text" name="firma" id="ign-firma" autocomplete="organization" required>
            </div>
          </div>
          <div class="ign-form__row">
            <div class="ign-form__field">
              <label for="ign-vorname">Vorname</label>
              <input type="text" name="vorname" id="ign-vorname" autocomplete="given-name">
            </div>
            <div class="ign-form__field ign-form__field--required">
              <label for="ign-nachname">Nachname <span aria-hidden="true">*</span></label>
              <input type="text" name="nachname" id="ign-nachname" autocomplete="family-name" required>
            </div>
          </div>
          <div class="ign-form__row">
            <div class="ign-form__field ign-form__field--required">
              <label for="ign-email">E-Mail <span aria-hidden="true">*</span></label>
              <input type="email" name="email" id="ign-email" autocomplete="email" required>
            </div>
            <div class="ign-form__field">
              <label for="ign-telefon">Telefon</label>
              <input type="tel" name="telefon" id="ign-telefon" autocomplete="tel">
            </div>
          </div>
        </fieldset>

        <fieldset class="ign-form__group">
          <legend>Projekt</legend>
          <div class="ign-form__row">
            <div class="ign-form__field">
              <label for="ign-einsatzbereich">Einsatzbereich</label>
              <select name="einsatzbereich" id="ign-einsatzbereich">
                <option value="">— wählen —</option>
                <option>Schaltschrank</option>
                <option>BESS</option>
                <option>Maschinenraum</option>
                <option>Serverraum</option>
                <option>Fahrzeug</option>
                <option>Industrie</option>
              </select>
            </div>
            <div class="ign-form__field">
              <label for="ign-schutzvolumen">Schutzvolumen (m³)</label>
              <input type="number" name="schutzvolumen" id="ign-schutzvolumen" min="0" step="0.1" inputmode="decimal">
            </div>
          </div>
          <div class="ign-form__row">
            <div class="ign-form__field">
              <label for="ign-temp">Temperaturbereich</label>
              <input type="text" name="temp_bereich" id="ign-temp" placeholder="z. B. −20 … +50 °C">
            </div>
            <div class="ign-form__field">
              <label for="ign-ausloesung">Auslöse-Art</label>
              <select name="ausloesung" id="ign-ausloesung">
                <option value="">— wählen —</option>
                <option>Thermisch</option>
                <option>Elektrisch</option>
                <option>Dual</option>
                <option value="Beratung">Noch unklar — Beratung gewünscht</option>
              </select>
            </div>
          </div>
          <div class="ign-form__row">
            <div class="ign-form__field">
              <label for="ign-zeitrahmen">Zeitrahmen</label>
              <select name="zeitrahmen" id="ign-zeitrahmen">
                <option value="">— wählen —</option>
                <option value="sofort">Sofort</option>
                <option value="1-3-monate">1–3 Monate</option>
                <option value="3-6-monate">3–6 Monate</option>
                <option value="laenger">Länger als 6 Monate</option>
                <option value="unbestimmt">Noch unbestimmt</option>
              </select>
            </div>
            <div class="ign-form__field"></div>
          </div>
          <div class="ign-form__field">
            <label for="ign-nachricht">Nachricht</label>
            <textarea name="nachricht" id="ign-nachricht" rows="5"
              placeholder="Objekt, Anforderungen, offene Fragen…"></textarea>
          </div>
        </fieldset>

        <div class="ign-form__consent">
          <label class="ign-form__checkbox">
            <input type="checkbox" name="consent" value="yes" required>
            <span>Ich habe die <a href="/datenschutz/">Datenschutzerklärung</a> gelesen und willige in die Verarbeitung meiner Daten zur Bearbeitung der Anfrage ein. <span aria-hidden="true">*</span></span>
          </label>
          <label class="ign-form__checkbox">
            <input type="checkbox" name="newsletter" value="yes">
            <span>Ja, ich möchte den Ignitec-Newsletter mit Fachartikeln erhalten. Jederzeit abbestellbar.</span>
          </label>
        </div>

        <div class="ign-form__actions">
          <button type="submit" class="ign-btn ign-btn--primary">Anfrage senden →</button>
          <span class="ign-form__hint">Antwort binnen 4 h · Auslegung binnen 48 h.</span>
        </div>
      </form>
      <!-- === ENDE FORMULAR === -->
    </div>

    <!-- Rechte Spalte: Info-Karte -->
    <aside class="ign-contact-main__info">
      <div class="ign-contact-main__card">
        <span class="eyebrow">IGNITEC GMBH</span>
        <address class="ign-contact-main__addr">
          Michael-Hainisch-Straße 8<br>
          2493 Lichtenwörth<br>
          Österreich
        </address>

        <dl class="ign-contact-main__meta">
          <div><dt>E-Mail</dt><dd><a href="mailto:office@ignitec.at">office@ignitec.at</a></dd></div>
          <div><dt>Firmenbuch</dt><dd>FN 651979v</dd></div>
          <div><dt>UID</dt><dd>ATU81975427</dd></div>
          <div><dt>Bürozeiten</dt><dd>Mo–Fr, 8:00–17:00</dd></div>
        </dl>
      </div>

      <div class="ign-contact-main__shortcut">
        <span class="eyebrow">SHORTCUTS</span>
        <ul>
          <li><a href="/anwendungen/bess/">BESS-Brandschutz</a></li>
          <li><a href="/anwendungen/schaltschrank/">Schaltschrank-Brandschutz</a></li>
          <li><a href="/anwendungen/serverraum/">Serverraum-Brandschutz</a></li>
          <li><a href="/downloads/datenblaetter/">Datenblätter (PDF)</a></li>
          <li><a href="/konfigurator/">Konfigurator starten</a></li>
        </ul>
      </div>
    </aside>

  </div>
</section>

<style>
.ign-contact-main { background: var(--bone-100); }
.ign-contact-main__grid {
  display: grid;
  grid-template-columns: 1.6fr 1fr;
  gap: 48px;
  align-items: start;
}
.ign-contact-main__h2 {
  font-family: var(--ff-display);
  font-weight: 600;
  font-size: clamp(28px, 3.2vw, 36px);
  letter-spacing: -0.03em;
  color: var(--slateblue);
  margin: 0 0 10px;
}
.ign-contact-main__p {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 16px;
  color: var(--fg-2);
  max-width: 60ch;
  margin: 0 0 32px;
}

.ign-contact-main__card {
  background: var(--bone);
  border-radius: var(--r-4);
  padding: 28px;
  border: 1px solid rgba(21,34,52,0.06);
  margin-bottom: 20px;
}
.ign-contact-main__addr {
  font-family: var(--ff-body);
  font-size: 15px;
  line-height: 1.6;
  color: var(--fg-1);
  font-style: normal;
  margin: 12px 0 20px;
}
.ign-contact-main__meta {
  display: flex;
  flex-direction: column;
  gap: 12px;
  margin: 0;
  padding: 20px 0 0;
  border-top: 1px solid rgba(21,34,52,0.06);
}
.ign-contact-main__meta div { margin: 0; display: grid; grid-template-columns: 1fr 1.2fr; gap: 12px; }
.ign-contact-main__meta dt {
  font-family: var(--ff-mono);
  font-size: 11px;
  letter-spacing: 0.16em;
  text-transform: uppercase;
  color: var(--fg-3);
}
.ign-contact-main__meta dd {
  font-family: var(--ff-body);
  font-size: 14px;
  color: var(--slateblue);
  margin: 0;
}
.ign-contact-main__meta a { color: var(--copper-solid); text-decoration: none; }

.ign-contact-main__shortcut {
  background: var(--bone);
  border-radius: var(--r-4);
  padding: 28px;
  border: 1px solid rgba(21,34,52,0.06);
}
.ign-contact-main__shortcut ul {
  list-style: none;
  padding: 14px 0 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.ign-contact-main__shortcut a {
  font-family: var(--ff-body);
  font-size: 14px;
  color: var(--slateblue);
  text-decoration: none;
  border-bottom: 1px solid rgba(21,34,52,0.06);
  padding-bottom: 10px;
  display: block;
}
.ign-contact-main__shortcut a:hover {
  color: var(--copper-solid);
  text-decoration: none;
}
.ign-contact-main__shortcut li:last-child a { border-bottom: 0; padding-bottom: 0; }

@media (max-width: 960px) {
  .ign-contact-main__grid { grid-template-columns: 1fr; }
}
</style>
```

> **Wichtig:** Die Form-Styles (`.ign-form__*`) sind in `widget-contact-form.md` definiert. Entweder identisch in diesem Widget wiederholen **oder besser** einmalig in `style.css` des Child-Themes einbauen — dann sind sie überall verfügbar.

---

## 5 · Sektion C · Map + LocalBusiness JSON-LD

```php
<?php
$lat = 47.830;   // Lichtenwörth, NÖ — bitte die exakten Koordinaten aus Google Maps übernehmen
$lng = 16.256;
$zoom = 15;
$osm_url = sprintf(
	'https://www.openstreetmap.org/export/embed.html?bbox=%F%%2C%F%%2C%F%%2C%F&layer=mapnik&marker=%F%%2C%F',
	$lng - 0.01, $lat - 0.005, $lng + 0.01, $lat + 0.005, $lat, $lng
);

$localbiz = [
	'@context'  => 'https://schema.org',
	'@type'     => 'LocalBusiness',
	'name'      => 'Ignitec GmbH',
	'url'       => home_url( '/' ),
	'email'     => 'office@ignitec.at',
	'address'   => [
		'@type'           => 'PostalAddress',
		'streetAddress'   => 'Michael-Hainisch-Straße 8',
		'postalCode'      => '2493',
		'addressLocality' => 'Lichtenwörth',
		'addressCountry'  => 'AT',
	],
	'geo'       => [
		'@type'     => 'GeoCoordinates',
		'latitude'  => $lat,
		'longitude' => $lng,
	],
	'openingHoursSpecification' => [
		[
			'@type'     => 'OpeningHoursSpecification',
			'dayOfWeek' => [ 'Monday','Tuesday','Wednesday','Thursday','Friday' ],
			'opens'     => '08:00',
			'closes'    => '17:00',
		],
	],
	'areaServed' => [ 'DE', 'AT', 'CH' ],
];
?>

<section class="ign-contact-map" aria-label="Anfahrt">
  <div class="ign-container ign-contact-map__inner">
    <div class="ign-contact-map__copy">
      <span class="eyebrow">ANFAHRT</span>
      <h2 class="ign-contact-map__h2">Lichtenwörth · Niederösterreich.</h2>
      <p class="ign-contact-map__p">
        Besuche nur nach Voranmeldung.
        Unser Standort liegt verkehrsgünstig zwischen Wiener Neustadt und Ebreichsdorf.
      </p>
      <a class="ign-btn ign-btn--ghost-dark"
         href="https://www.openstreetmap.org/?mlat=<?php echo esc_attr( $lat ); ?>&mlon=<?php echo esc_attr( $lng ); ?>#map=<?php echo (int) $zoom; ?>/<?php echo esc_attr( $lat ); ?>/<?php echo esc_attr( $lng ); ?>"
         target="_blank" rel="noopener">
        In OpenStreetMap öffnen →
      </a>
    </div>
    <div class="ign-contact-map__frame">
      <iframe
        src="<?php echo esc_url( $osm_url ); ?>"
        width="100%" height="380"
        style="border:0;border-radius:10px;"
        loading="lazy"
        title="Karte: Ignitec GmbH, Lichtenwörth"></iframe>
    </div>
  </div>
</section>

<script type="application/ld+json">
<?php echo wp_json_encode( $localbiz, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ); ?>
</script>

<style>
.ign-contact-map { background: var(--bone); padding: 72px 0; }
.ign-contact-map__inner {
  display: grid;
  grid-template-columns: 1fr 1.4fr;
  gap: 48px;
  align-items: center;
}
.ign-contact-map__h2 {
  font-family: var(--ff-display);
  font-weight: 500;
  font-size: clamp(28px, 3vw, 36px);
  letter-spacing: -0.03em;
  color: var(--slateblue);
  margin: 10px 0 14px;
}
.ign-contact-map__p {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 16px;
  line-height: 1.55;
  color: var(--fg-2);
  margin: 0 0 24px;
  max-width: 50ch;
}
.ign-contact-map__frame { box-shadow: var(--shadow-2); border-radius: 10px; overflow: hidden; }
@media (max-width: 960px) {
  .ign-contact-map__inner { grid-template-columns: 1fr; }
}
</style>
```

---

## 6 · SEO/GEO-Notiz

- **LocalBusiness JSON-LD** aktiviert Google Maps Pack und Local-Packs für "Brandschutz Lichtenwörth", "Aerosol-Löschanlage Österreich".
- **Öffnungszeiten** maschinenlesbar — Google kann "Jetzt geöffnet"-Badge anzeigen.
- **AreaServed** DE/AT/CH — stärkt Reichweite über Österreich hinaus.
- **OpenStreetMap** statt Google Maps: keine Third-Party-Cookies, kein Consent-Banner nötig.

## 7 · Verifikation

- [ ] `/kontakt/` zeigt 3 Sections: Intro, Form+Info, Map
- [ ] Formular submit → Erfolgs-Banner ersetzt Formular
- [ ] LocalBusiness Schema.org valid im Rich Results Test
- [ ] Map lädt ohne Cookie-Warnung
- [ ] Responsive: Alle Sections ab 960px single-column
- [ ] Brevo (wenn konfiguriert): Opt-In registriert Kontakt in Liste

## 8 · Anpassungspunkte

- **Lat/Lng**: Exakte Koordinaten von Google Maps kopieren (Rechtsklick auf den Standort-Marker → "Was ist hier?" → Koordinaten).
- **Öffnungszeiten**: Im `$localbiz`-Array anpassen.
- **Shortcuts-Liste**: Im HTML direkt editieren — die 5 wichtigsten CTAs.
- **Map-Anbieter**: Bei Wunsch nach Google Maps: iframe-src auf Google-Embed umstellen + Consent-Banner-Integration.

---

**Nach Verifikation → STEP 8 (Legal) freigeben.**
