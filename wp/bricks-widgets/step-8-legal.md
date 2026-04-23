# STEP 8 — Rechtstexte (Impressum, Datenschutz, AGB)

Drei Pflicht-Seiten für österreichische B2B-Websites. Textvorlagen mit den konkreten Ignitec-Daten vorbefüllt — **vor Go-Live unbedingt von einer Rechtsanwaltskanzlei prüfen lassen.** Die Vorlagen decken die Mindestanforderungen ab, ersetzen aber keine juristische Beratung.

**Kein Widerrufsrecht-Pflichtblatt**, weil Ignitec rein B2B arbeitet (keine Verbraucher:innen als Kund:innen). Falls der Shop später Endkunden bedient, muss das nachgezogen werden.

---

## 1 · Gemeinsames "Legal-Layout"-Template

Für alle drei Seiten ein einheitliches Bricks-Template anlegen:

**Bricks → Templates → Add New**
- Name: `Legal Layout`
- Template Type: **Page** (kann jeder Legal-Seite manuell zugewiesen werden)

Im Template:
- Section Full-Width
- Container mit `max-width: 820px` (schmale Lese-Spalte)
- **1 Code-Element** mit dem gemeinsamen Legal-CSS + `<?php the_content(); ?>`

**Code-Element-Inhalt:**

```php
<article class="ign-legal ign-section">
  <div class="ign-legal__inner">
    <header class="ign-legal__head">
      <nav class="ign-legal__crumbs" aria-label="Breadcrumb">
        <a href="/">Start</a> <span>/</span> <span class="ign-legal__crumbs-current"><?php the_title(); ?></span>
      </nav>
      <h1 class="ign-legal__h1"><?php the_title(); ?></h1>
      <div class="ign-legal__meta">
        Stand: <?php echo esc_html( get_the_modified_date( 'd. F Y' ) ); ?>
      </div>
    </header>

    <div class="ign-legal__prose">
      <?php the_content(); ?>
    </div>
  </div>
</article>

<style>
.ign-legal {
  background: var(--bone);
  padding-top: 140px;
}
.ign-legal__inner {
  max-width: 820px;
  margin: 0 auto;
  padding: 0 28px;
}
.ign-legal__crumbs {
  font-family: var(--ff-mono);
  font-size: 12px;
  letter-spacing: 0.12em;
  color: var(--fg-3);
  margin-bottom: 24px;
}
.ign-legal__crumbs a { color: var(--fg-3); text-decoration: none; }
.ign-legal__crumbs a:hover { color: var(--copper-solid); }
.ign-legal__crumbs span { margin: 0 8px; opacity: 0.5; }
.ign-legal__crumbs-current { margin: 0; opacity: 1; color: var(--slateblue); }

.ign-legal__h1 {
  font-family: var(--ff-display);
  font-weight: 600;
  font-size: clamp(36px, 4.4vw, 52px);
  letter-spacing: -0.04em;
  line-height: 1.02;
  color: var(--slateblue);
  margin: 10px 0 16px;
}
.ign-legal__meta {
  font-family: var(--ff-mono);
  font-size: 12px;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: var(--fg-3);
  padding-bottom: 32px;
  border-bottom: 1px solid rgba(21,34,52,0.1);
  margin-bottom: 40px;
}

.ign-legal__prose {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 17px;
  line-height: 1.7;
  color: var(--fg-1);
}
.ign-legal__prose h2 {
  font-family: var(--ff-display);
  font-weight: 600;
  font-size: 26px;
  letter-spacing: -0.025em;
  color: var(--slateblue);
  margin: 40px 0 12px;
}
.ign-legal__prose h3 {
  font-family: var(--ff-display);
  font-weight: 600;
  font-size: 20px;
  letter-spacing: -0.02em;
  color: var(--slateblue);
  margin: 28px 0 10px;
}
.ign-legal__prose p { margin: 0 0 1em; }
.ign-legal__prose ul, .ign-legal__prose ol { margin: 0 0 1em; padding-left: 22px; }
.ign-legal__prose ul li { margin-bottom: 6px; }
.ign-legal__prose a { color: var(--copper-solid); text-decoration: underline; text-underline-offset: 3px; }
.ign-legal__prose strong { color: var(--slateblue); }
.ign-legal__prose code {
  font-family: var(--ff-mono);
  font-size: 14px;
  background: var(--bone-200);
  padding: 2px 6px;
  border-radius: 3px;
}
</style>
```

Danach die folgenden 3 Seiten als normale WP-Seiten anlegen und das Template im Bricks-Page-Settings-Dropdown zuweisen. Inhalte mit dem Gutenberg- oder Classic-Editor pflegen.

---

## 2 · Seite "Impressum" (`/impressum/`)

**Inhalt (Gutenberg Classic Block oder direkt in Block-Editor einfügen):**

```markdown
## Medieninhaberin und Herausgeberin

**Ignitec GmbH**  
Michael-Hainisch-Straße 8  
2493 Lichtenwörth  
Österreich

E-Mail: [office@ignitec.at](mailto:office@ignitec.at)

## Unternehmensdaten

- **Firmenbuchnummer:** FN 651979v
- **Firmenbuchgericht:** Landesgericht Wiener Neustadt
- **UID-Nummer:** ATU81975427
- **Gewerbliche Tätigkeit:** Handel, Vertrieb und Auslegung von stationären Brandschutz-Löschsystemen
- **Geschäftsführung:** _(Namen ergänzen)_
- **Mitgliedschaften:** WKO — Wirtschaftskammer Niederösterreich

## Aufsichtsbehörde / Gewerbebehörde

Bezirkshauptmannschaft Wiener Neustadt

## Anwendbare Rechtsvorschriften

Die unternehmerische Tätigkeit unterliegt der Gewerbeordnung (GewO), abrufbar unter [ris.bka.gv.at](https://www.ris.bka.gv.at/).

## Angaben nach § 5 ECG und § 25 MedienG

Inhalt, Zweck, grundlegende Richtung: Unternehmenswebsite zur Information über Produkte und Dienstleistungen im Bereich kondensierter Aerosol-Löschsysteme. Keine journalistisch-redaktionellen Inhalte.

## Online-Streitbeilegung

Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit:  
[https://ec.europa.eu/consumers/odr](https://ec.europa.eu/consumers/odr)

Wir sind nicht bereit und nicht verpflichtet, an einem Streitbeilegungsverfahren vor einer Verbraucherschlichtungsstelle teilzunehmen.

## Haftungsausschluss

Trotz sorgfältiger inhaltlicher Kontrolle übernehmen wir keine Haftung für die Inhalte externer Links. Für den Inhalt der verlinkten Seiten sind ausschließlich deren Betreiber verantwortlich.

## Urheberrecht

Alle Inhalte dieser Website (Texte, Bilder, Grafiken, Logos, Layout) sind urheberrechtlich geschützt. Jede Verwertung außerhalb der engen Grenzen des Urheberrechtsgesetzes bedarf der vorherigen schriftlichen Zustimmung der Ignitec GmbH.
```

---

## 3 · Seite "Datenschutz" (`/datenschutz/`)

Umfangreicher, weil DSGVO-pflichtig. Muss **vor Go-Live** juristisch geprüft werden.

```markdown
## Verantwortliche Stelle

**Ignitec GmbH**, Michael-Hainisch-Straße 8, 2493 Lichtenwörth, Österreich.  
Kontakt: [office@ignitec.at](mailto:office@ignitec.at)

Eine gesetzlich verpflichtende Datenschutzbeauftragte ist nicht bestellt.

## Rechte der betroffenen Personen

Sie haben jederzeit das Recht auf:

- Auskunft über die über Sie gespeicherten Daten (Art. 15 DSGVO)
- Berichtigung unrichtiger Daten (Art. 16)
- Löschung (Art. 17)
- Einschränkung der Verarbeitung (Art. 18)
- Datenübertragbarkeit (Art. 20)
- Widerspruch (Art. 21)
- Widerruf erteilter Einwilligungen (Art. 7 Abs. 3)

Anfragen per E-Mail an [office@ignitec.at](mailto:office@ignitec.at). Zusätzlich besteht ein Beschwerderecht bei der österreichischen Datenschutzbehörde (dsb.gv.at).

## Verarbeitung bei Website-Besuch

### Server-Logfiles

Bei jedem Aufruf werden technisch notwendige Daten erfasst: IP-Adresse, Datum/Uhrzeit, aufgerufene Ressource, Referrer, User-Agent. **Rechtsgrundlage:** Art. 6 Abs. 1 lit. f DSGVO — berechtigtes Interesse am sicheren Betrieb der Website. **Speicherdauer:** max. 14 Tage.

### Kontaktformular

Bei Nutzung unseres Kontaktformulars werden die von Ihnen eingegebenen Daten (Firma, Name, E-Mail, Telefon, Projekt-Angaben, Nachricht) sowie IP-Adresse und Zeitstempel erfasst und per E-Mail an `office@ignitec.at` übermittelt. **Rechtsgrundlage:** Art. 6 Abs. 1 lit. b DSGVO (Vertragsanbahnung) bzw. lit. f (berechtigtes Interesse an effizienter Anfragebearbeitung). **Speicherdauer:** bis zum Abschluss der Anfrage + gesetzliche Aufbewahrungsfristen (bei Geschäftsabschluss: 7 Jahre nach BAO).

### Newsletter (Opt-In, optional)

Mit Setzen des Newsletter-Hakens im Kontaktformular willigen Sie ein, dass wir Ihre E-Mail-Adresse, Vor- und Nachname sowie Firma an unseren Versanddienstleister **Brevo** (Sendinblue SAS, 106 boulevard Haussmann, 75008 Paris, Frankreich) übermitteln. Brevo ist zertifiziert unter dem EU-U.S. Data Privacy Framework; innerhalb der EU gilt die DSGVO direkt.

Sie erhalten eine Bestätigungs-Mail (Double-Opt-In) und können den Newsletter jederzeit über den Abmelde-Link abbestellen. **Rechtsgrundlage:** Art. 6 Abs. 1 lit. a DSGVO (Einwilligung).

### Cookies

Diese Website setzt ausschließlich technisch notwendige Cookies (Session, Warenkorb, Login). Es werden keine Tracking- oder Marketing-Cookies verwendet. Externe Dienste (z. B. Google Fonts) werden nicht in Anspruch genommen, Fonts werden lokal ausgeliefert oder über Google Fonts mit DSGVO-konformer Konfiguration bezogen.

_(Falls später Google Analytics, Meta Pixel o. ä. eingebunden werden, muss dieser Abschnitt entsprechend ergänzt und ein Cookie-Consent-Banner mit Opt-In-Logik eingesetzt werden.)_

## Weitergabe an Dritte

Eine Übermittlung Ihrer Daten an Dritte erfolgt nur, wenn:

- Sie ausdrücklich eingewilligt haben (z. B. Newsletter → Brevo)
- die Weitergabe zur Vertragserfüllung erforderlich ist (z. B. Versanddienstleister für Produktlieferungen)
- eine gesetzliche Pflicht besteht (z. B. Finanzbehörden)

## Auftragsverarbeitung

Wir haben mit folgenden Dienstleistern Auftragsverarbeitungsverträge nach Art. 28 DSGVO abgeschlossen:

- **Hosting-Anbieter:** _(Name ergänzen)_
- **E-Mail-Versand / Newsletter:** Brevo (Sendinblue SAS, Paris, FR)

## WooCommerce-Produktbestellungen

Sofern Sie über diese Website Produkte bestellen, werden Rechnungs- und Lieferadresse sowie Zahlungsinformationen gespeichert. **Rechtsgrundlage:** Art. 6 Abs. 1 lit. b DSGVO. **Speicherdauer:** 7 Jahre (§ 132 BAO).

## Technische und organisatorische Maßnahmen

Übertragung per TLS-Verschlüsselung. Datenhaltung in der EU. Zugriff auf Kundendaten nur für autorisiertes Personal. Regelmäßige Software-Updates.

## Kontakt

Fragen zum Datenschutz: [office@ignitec.at](mailto:office@ignitec.at)
```

---

## 4 · Seite "AGB" (`/agb/`)

Reine B2B-AGB. Prüfen lassen!

```markdown
## Allgemeine Geschäftsbedingungen der Ignitec GmbH

**Stand:** April 2026. Ausschließlich B2B. Verbraucher:innen im Sinne des § 1 KSchG sind ausgeschlossen.

## 1 · Geltungsbereich

(1) Diese AGB gelten für alle Verträge zwischen der Ignitec GmbH (im Folgenden "Ignitec") und Unternehmen im Sinne von § 1 UGB über Lieferungen und Leistungen im Bereich kondensierter Aerosol-Löschsysteme.

(2) Abweichende Bedingungen des Vertragspartners werden nicht Vertragsbestandteil, sofern sie nicht schriftlich von Ignitec bestätigt werden.

## 2 · Angebote und Vertragsabschluss

(1) Angebote von Ignitec sind freibleibend und unverbindlich, sofern sie nicht ausdrücklich als verbindlich bezeichnet sind.

(2) Ein Vertrag kommt zustande, wenn Ignitec eine Bestellung schriftlich oder per E-Mail bestätigt.

## 3 · Auslegung und Beratung

(1) Die technische Auslegung erfolgt auf Basis der vom Kunden bereitgestellten Angaben (Schutzvolumen, Betriebstemperatur, Auslöse-Art). Für die Richtigkeit und Vollständigkeit dieser Angaben ist der Kunde verantwortlich.

(2) Die Auslegung nach CEN/TR 15276-1 ist als Planungshilfe zu verstehen; die endgültige Verantwortung für die Eignung im konkreten Anwendungsfall liegt beim Kunden bzw. dessen Brandschutzplaner:in.

## 4 · Preise und Zahlung

(1) Alle Preise verstehen sich netto zuzüglich gesetzlicher Umsatzsteuer, ab Lager 2493 Lichtenwörth.

(2) Rechnungen sind binnen 14 Tagen ab Rechnungsdatum ohne Abzug zahlbar. Bei Zahlungsverzug werden Zinsen gemäß § 456 UGB berechnet.

## 5 · Lieferung und Gefahrenübergang

(1) Lieferung erfolgt ab Lager, sofern nicht anders vereinbart. Die Gefahr geht mit Übergabe an den Frachtführer auf den Kunden über.

(2) Teillieferungen sind zulässig und werden als eigene Geschäfte behandelt.

## 6 · Eigentumsvorbehalt

Die gelieferten Waren bleiben bis zur vollständigen Bezahlung im Eigentum der Ignitec GmbH.

## 7 · Gewährleistung

(1) Gewährleistungsfrist: 24 Monate ab Gefahrenübergang.

(2) Offensichtliche Mängel sind binnen 14 Tagen nach Erhalt schriftlich zu rügen. Versteckte Mängel binnen 14 Tagen nach Entdeckung.

(3) Bei berechtigten Mängelrügen hat Ignitec das Recht, nach eigener Wahl Nachbesserung oder Austausch vorzunehmen.

## 8 · Haftung

(1) Ignitec haftet nur für Vorsatz und grobe Fahrlässigkeit.

(2) Die Haftung für Folgeschäden, entgangenen Gewinn und mittelbare Schäden ist ausgeschlossen, soweit gesetzlich zulässig.

(3) Die Haftungsbeschränkungen gelten nicht für Personenschäden und Schäden nach dem Produkthaftungsgesetz.

## 9 · Schlussbestimmungen

(1) Es gilt österreichisches Recht unter Ausschluss der Verweisungsnormen und des UN-Kaufrechts.

(2) Erfüllungsort und ausschließlicher Gerichtsstand ist Wiener Neustadt.

(3) Sollten einzelne Bestimmungen dieser AGB unwirksam sein, berührt dies die Wirksamkeit der übrigen Bestimmungen nicht.

---

_Diese AGB ersetzen keine anwaltliche Beratung. Vor Verwendung bitte durch eine auf Wirtschaftsrecht spezialisierte Kanzlei prüfen lassen._
```

---

## 5 · Seiten-Setup

| Titel | Slug | Inhalt | Template |
|---|---|---|---|
| Impressum | `impressum` | Abschnitt 2 oben | Legal Layout |
| Datenschutz | `datenschutz` | Abschnitt 3 oben | Legal Layout |
| AGB | `agb` | Abschnitt 4 oben | Legal Layout |

Im Footer-Menü "Service" (aus STEP 2) werden diese 3 Seiten automatisch angezeigt, sobald sie angelegt und dem Menü hinzugefügt sind.

## 6 · Verifikation

- [ ] Alle 3 Seiten als WordPress-Pages angelegt
- [ ] Bricks-Template "Legal Layout" zugewiesen
- [ ] Schmale Lese-Spalte (max 820px), Breadcrumbs, Stand-Datum
- [ ] "Stand"-Datum aktualisiert sich automatisch bei jeder Änderung (`get_the_modified_date`)
- [ ] Im Footer-Menü "Service" verlinkt
- [ ] Links in Datenschutz / AGB funktionieren
- [ ] **Anwaltliche Prüfung erfolgt** vor Go-Live

## 7 · Anpassungspunkte

- **Geschäftsführer-Name** im Impressum ergänzen (Platzhalter `_(Namen ergänzen)_`)
- **Hosting-Anbieter** im Datenschutz ergänzen (Platzhalter `_(Name ergänzen)_`)
- **Stand-Datum** wird automatisch von WordPress aus der letzten Bearbeitung gezogen — bei inhaltlichen Updates einfach die Seite speichern.

---

**Damit sind alle nicht-produktabhängigen Steps abgeschlossen. STEP 4 (Shop-Archiv) und STEP 5 (Produkt-Single) folgen nach Anlage der realen WooCommerce-Produkte.**
