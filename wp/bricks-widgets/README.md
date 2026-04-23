# Ignitec · Bricks Code Widgets

Sammlung aller Bricks-Code-Widget-Blöcke zum Copy-Paste. Reihenfolge entspricht der Liefer-Ordnung.

**Wichtig:** STEP 0 (Child-Theme aus `../theme/ignitec-child/`) muss aktiv sein — alle Widgets verwenden die dort definierten CSS-Variablen.

## Liefer-Übersicht

| Step | Datei | Zweck | Status |
|---|---|---|---|
| 1 | `step-1-header.md` | Globaler Header mit Sticky-Verhalten, Off-Canvas-Mobile | ✅ Geliefert |
| 2 | `step-2-footer.md` | CTA-Strip + 4-Spalten-Footer + Organization-JSON-LD | ✅ Geliefert |
| 3.1 | `step-3-1-hero.md` | Homepage Hero mit Spark-Canvas (140 Partikel) | ✅ Geliefert |
| 3.2 | `step-3-2-statbar.md` | Stat Bar — 5 harte Kennzahlen | ✅ Geliefert |
| 3.3 | `step-3-3-product-highlights.md` | 6 Produkt-Highlights aus WooCommerce | ✅ Geliefert |
| 3.4 | `step-3-4-applications.md` | 4 Use-Case-Kacheln mit Filter-Deep-Links | ✅ Geliefert |
| 3.5 | `step-3-5-technology-usp.md` | Technologie-USP mit 4 Argumenten + Visual | ✅ Geliefert |
| 3.6 | `step-3-6-process.md` | 4-Step-Prozess + HowTo-JSON-LD | ✅ Geliefert |
| 3.7 | `step-3-7-faq.md` | 6 FAQ + FAQPage-JSON-LD | ✅ Geliefert |
| 3.8 | `step-3-8-contact-teaser.md` | Kontakt-Teaser mit kompaktem Formular | ✅ Geliefert |
| Form | `widget-contact-form.md` | Wiederverwendbares Kontaktformular (Bricks-nativ, kein Plugin) | ✅ Geliefert |
| 6 | `step-6-applications.md` | Anwendungs-CPT + Single + Archiv-Template | ✅ Geliefert |
| 7 | `step-7-contact.md` | Kontakt-Seite (Hero + Form + OSM-Map + LocalBusiness-JSON-LD) | ✅ Geliefert |
| 8 | `step-8-legal.md` | Impressum, Datenschutz, AGB (Templates + Musterinhalte) | ✅ Geliefert |
| 4 | _pending_ | Shop-Archiv (Bricks Filter-Elemente) | 🔜 Nach Homepage-Abnahme |
| 5 | _pending_ | Produkt-Single mit dynamischer Spec-Table | 🔜 Nach Homepage-Abnahme |

## Einbau-Workflow pro Widget

1. Passendes `.md` öffnen — oben in der Datei steht die genaue Platzierung (welche Page, welche Position).
2. Bricks-Template oder Seite öffnen, an der Stelle **1 Code-Element** einfügen.
3. Im Code-Element **Execute code ✅** aktivieren (für PHP-basierte Widgets).
4. Den Code-Block zwischen den ```` ``` ```` per Copy-Paste einfügen.
5. Speichern → Bricks signiert den Code automatisch.
6. Verifikations-Checkliste aus dem jeweiligen `.md` durchgehen.

## Änderungs-Strategie

Jedes Widget ist **komplett autark** — HTML, CSS und JS inline. Änderungen:
- **Text-Änderungen**: Direkt im HTML des Widgets.
- **Layout-Änderungen**: Im `<style>`-Block des Widgets (nur dieser Abschnitt betroffen).
- **Farb-/Spacing-Anpassung global**: In `../theme/ignitec-child/style.css` die Tokens ändern — alle Widgets übernehmen automatisch.

Keine Widget-Änderung bricht ein anderes — die CSS-Klassen sind sektionsgenau geprefixt (`.ign-hero__…`, `.ign-faq__…`, …).

## Entscheidungen (fixiert)

| Bereich | Entscheidung | Umsetzung |
|---|---|---|
| Kontaktformular | **Bricks Native Form** (kein Plugin) | `widget-contact-form.md` + `functions.php` Abschnitt 9 |
| Anwendungs-Seiten | **CPT `ignitec_application`** | `functions.php` Abschnitt 8 + `step-6-applications.md` |
| Newsletter | **Brevo (free)** | `functions.php` Abschnitt 10 (API-Integration) + Admin-Settings Abschnitt 11 |

## Brevo-Setup

Unter **Einstellungen → Ignitec** im WP-Admin:
- Anfrage-Empfänger: `office@ignitec.at`
- Brevo API-Key: aus Brevo-Account → SMTP & API → API Keys
- Brevo List-ID: ID der Newsletter-Kontaktliste

Alternativ via `wp-config.php`:
```php
define( 'IGNITEC_BREVO_API_KEY', 'xkeysib-…' );
define( 'IGNITEC_BREVO_LIST_ID', 3 );
```
