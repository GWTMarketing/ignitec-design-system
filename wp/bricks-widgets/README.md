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
| 3.8 | `step-3-8-contact-teaser.md` | Kontakt-Teaser mit 48-h-Versprechen | ✅ Geliefert |
| 4 | _pending_ | Shop-Archiv (Bricks Filter-Elemente) | 🔜 Nach Homepage-Abnahme |
| 5 | _pending_ | Produkt-Single mit dynamischer Spec-Table | 🔜 Nach Homepage-Abnahme |
| 6 | _pending_ | Anwendungs-Seiten (CPT **oder** WC-Kategorie-Pages) | ❓ Entscheidung offen |
| 7 | _pending_ | Kontakt-Seite (Formular-Plugin offen) | ❓ Entscheidung offen |
| 8 | _pending_ | Rechtstexte (Impressum, Datenschutz, AGB, Widerruf) | 🔜 Nach Abnahme |

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

## Offene Entscheidungen (vor STEP 6/7)

1. **Kontaktformular-Plugin:** Contact Form 7 (free) oder Fluent Forms Free?
2. **Anwendungs-Seiten:** Custom Post Type `ignitec_application` oder erweiterte WooCommerce-Kategorie-Pages?
3. **Newsletter / Leadmagnet:** Brevo, MailPoet (free) — oder gar nicht?
