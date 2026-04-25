# STEP 8 — Rechtstexte (Germanized Pro)

Alle Pflichtseiten (Impressum, Datenschutz, AGB, Widerruf) werden über den **Germanized Pro Rechtstextegenerator** erstellt. Kein Custom-Code, keine eigenen Vorlagen — der Generator liefert Austrian-Recht-konforme Inhalte direkt aus dem Plugin.

Eine **anwaltliche Endprüfung** wird vom Plugin-Hersteller empfohlen, ist aber kein Freelancer-Scope (siehe Hinweis am Ende).

---

## 1 · Voraussetzung

- [ ] Germanized Pro installiert + Lizenz aktiv (siehe SETUP-GUIDE TEIL 2)
- [ ] WooCommerce installiert (Germanized hängt sich an WC)

## 2 · Rechtstextegenerator durchlaufen

**WP-Admin → Germanized → Rechtliches → Rechtstexte-Generator**

- [ ] **Schritt 1 · Branchen-Wahl:** "Online-Shop" auswählen
- [ ] **Schritt 2 · Unternehmensdaten:** ausfüllen
  - Firma: `Ignitec GmbH`
  - Straße: `Michael-Hainisch-Straße 8`
  - PLZ/Ort: `2493 Lichtenwörth`
  - Land: Österreich
  - Geschäftsführer: _(Name vom Auftraggeber)_
  - Firmenbuch: `FN 651979v` · Wiener Neustadt
  - UID: `ATU81975427`
  - E-Mail: `office@ignitec.at`
  - Telefon: _(vom Auftraggeber)_
- [ ] **Schritt 3 · Verkaufs-Modus:** B2C **und** B2B aktivieren (Germanized erstellt 2 AGB-Varianten)
- [ ] **Schritt 4 · Versand:** Versandkosten und Lieferzeiten aus Phase 6 übernehmen, Gefahrgut-Aufpreis erwähnen
- [ ] **Schritt 5 · Zahlung:** _(zunächst leer lassen — Stripe + Rechnungskauf nicht im aktuellen Scope)_
- [ ] **Schritt 6 · Generieren:** Klick → Plugin legt 4 WordPress-Seiten automatisch an:
  - `/impressum/`
  - `/datenschutz/`
  - `/agb/`
  - `/widerrufsbelehrung/`

## 3 · Pflichtseiten in Bricks gestalten

Damit die generierten Inhalte zum Brand-Look passen:

- [ ] **Bricks → Templates → Add New** · Name `Legal Layout` · Type **Page**
- [ ] Im Template **1 Section Full-Width** mit:
  - Container `max-width: 820px`
  - **1 Block-Element** mit Bricks Dynamic Data: `{post_title}` als H1
  - **1 Post-Content-Element** (rendert den Germanized-generierten Inhalt)
- [ ] **Conditions:** Page = "Impressum, Datenschutz, AGB, Widerrufsbelehrung" zuweisen
- [ ] Optional: Hairline-Trenner, Crumbs, "Stand vom"-Datum via `{post_modified_date}`

**Style-Snippet** (Custom-CSS im Template):

```css
.brxe-post-content { font-family: var(--ff-body); font-weight: 300; font-size: 17px; line-height: 1.7; color: var(--fg-1); }
.brxe-post-content h2 { font-family: var(--ff-display); font-weight: 600; font-size: 26px; letter-spacing: -.025em; color: var(--slateblue); margin: 40px 0 12px; }
.brxe-post-content h3 { font-family: var(--ff-display); font-weight: 600; font-size: 20px; letter-spacing: -.02em; color: var(--slateblue); margin: 28px 0 10px; }
.brxe-post-content p { margin: 0 0 1em; }
.brxe-post-content ul, .brxe-post-content ol { margin: 0 0 1em; padding-left: 22px; }
.brxe-post-content a { color: var(--copper-solid); text-decoration: underline; text-underline-offset: 3px; }
```

## 4 · Footer-Menü "Service" ergänzen

- [ ] **WP-Admin → Design → Menüs → Footer Service**
- [ ] Einträge ergänzen: `Impressum` · `Datenschutz` · `AGB` · `Widerrufsbelehrung`
- [ ] Alle 4 sind nach Generierung als WordPress-Seiten verfügbar

## 5 · Germanized-spezifische Aktivierungen

In **Germanized → Allgemein**:

- [ ] **Lieferzeiten:** je Produkt aktivierbar (für später bei der Produktanlage)
- [ ] **Grundpreise:** Anzeige je Produkt einschalten
- [ ] **Widerrufsbelehrung im Checkout:** automatisch verlinkt
- [ ] **Doppelte Opt-In-Bestätigung:** für Newsletter-Funktionen aktivieren (falls genutzt)
- [ ] **Vorkassenbankkonto / SEPA-Mandat:** nicht aktivieren (außer Auftraggeber wünscht es)

## 6 · Updates

Die Germanized-Texte werden **automatisch aktualisiert**, wenn sich die Rechtsgrundlage ändert (z. B. neue EU-Verordnung). Wichtig:

- [ ] Auto-Update für Germanized-Plugin AKTIV halten (sonst veraltete Rechtstexte)
- [ ] Bei Aktualisierung der Stammdaten (Geschäftsführer, Adresse) den Rechtstextegenerator erneut durchlaufen

## 7 · Verifikation

- [ ] `/impressum/` zeigt korrekte Daten (Firma, GF, Firmenbuch, UID)
- [ ] `/datenschutz/` enthält Borlabs-Cookie-Hinweis (siehe `step-borlabs-cookie.md`)
- [ ] `/agb/` zeigt B2C- und B2B-Varianten
- [ ] `/widerrufsbelehrung/` ist verlinkt und funktioniert
- [ ] Footer-Menü "Service" zeigt alle 4 Links
- [ ] Im Bricks-Frontend wirken die Texte typografisch konsistent

## 8 · Hinweise an den Auftraggeber

Der Germanized-Generator liefert **Vorlagen**, die für 95 % der Standard-Online-Shops korrekt sind. Bei branchenspezifischen Besonderheiten (Gefahrgut-Versand UN 3268, B2B-only-Klauseln, internationale Lieferungen) wird **eine zusätzliche Prüfung durch eine IT-Recht-Kanzlei oder Anwalt empfohlen** — Aufwand ~150-400 € einmalig. Das ist **nicht Teil des Freelancer-Scopes**.

---

**Nach Verifikation kann das Footer-Menü und damit die Pflichtseiten-Verlinkung produktiv geschaltet werden.**
