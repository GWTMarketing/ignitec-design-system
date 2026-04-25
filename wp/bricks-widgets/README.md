# Ignitec · Bricks Code Widgets

Sammlung aller Bricks-Code-Widget-Blöcke zum Copy-Paste. Reihenfolge entspricht dem Mockup `extracted/mockups/home.html`.

**Wichtig:** STEP 0 (Child-Theme aus `../theme/ignitec-child/`) muss aktiv sein — alle Widgets verwenden die dort definierten CSS-Variablen.

## Liefer-Übersicht

| Step | Datei | Zweck | Status |
|---|---|---|---|
| 1 | `step-1-header.md` | Globaler Header (Sticky, Off-Canvas-Mobile, IgniTec-Wordmark-PNG) | ✅ |
| 2 | `step-2-footer.md` | Globaler Footer (4 Spalten + Claim + Organization-JSON-LD) | ✅ |
| 3.1 | `step-3-1-hero.md` | **Hero** mit Spark-Canvas + rotierenden Ringen + Aerosol-Unit-Mock + Stat-Micro inline | ✅ |
| 3.2 | `step-3-2-usp.md` | **USP-Grid** 3×2 (6 Eigenschaften, Section-Head split) | ✅ |
| 3.3 | `step-3-3-product-highlights.md` | **Produkt-Teaser** 4 Karten mit Copper-Tile + Größe + SKU | ✅ |
| 3.4 | `step-3-4-applications.md` | **Anwendungen** 6-Spalten Dark-Grid | ✅ |
| 3.5 | `step-3-5-reference.md` | **Referenz** mit Chips + großem Zitat | ✅ |
| 3.6 | `step-3-6-statbar.md` | **Stat Bar** 4-Spalten Slate-Blue mit Copper-Zahlen | ✅ |
| 3.7 | `step-3-7-cta.md` | **CTA-Carrier** Copper-Gradient mit Glass-Card | ✅ |
| 3.8 | `step-3-8-faq.md` | **FAQ** (optional, GEO-Bonus, FAQPage-JSON-LD) | ✅ |
| Form | `widget-contact-form.md` | Wiederverwendbares Kontaktformular (Bricks-nativ) | ✅ |
| 6 | `step-6-applications.md` | Anwendungs-CPT + Single + Archiv-Template | ✅ |
| 7 | `step-7-contact.md` | Kontakt-Seite (Hero + Form + OSM-Map + LocalBusiness) | ✅ |
| 8 | `step-8-legal.md` | Impressum, Datenschutz, AGB | ✅ |
| 4 | _pending_ | Shop-Archiv (Bricks Filter-Elemente) | 🔜 nach Homepage-Abnahme |
| 5 | _pending_ | Produkt-Single mit dynamischer Spec-Table | 🔜 nach Homepage-Abnahme |

## Homepage-Flow (Mockup-Reihenfolge)

1. **Hero** — Vollbild dunkel, Spark-Canvas, Ringe, Aerosol-Unit
2. **USP** — 6 Eigenschaften
3. **Produkt-Teaser** — 4 Featured-Größen
4. **Anwendungen** — 6 Use-Cases auf Dunkel
5. **Referenz** — Kunden-Zitat
6. **Stat Bar** — 4 Vertrauens-Werte
7. **CTA** — Copper-Sektion mit Direktkontakt-Card
8. **FAQ** *(optional)* — 6 Q&A für GEO/Featured-Snippets

## Brand-Regeln (kurz)

Aus `extracted/reference/ignitec-brand_SKILL_original.md` und README.md des Design-Systems:

- **Hero Claim Exception:** Genau **ein** Wort pro Hero-Headline darf italic + Copper-Gradient sein. Nur auf dunklem Carrier. Nie ausserhalb des Hero.
- **Sentence-Case** in allen Headlines, außer JetBrains-Mono-Eyebrows (UPPERCASE +0.22em).
- **Numbers immer mit Einheit:** `≤ 20 s`, niemals "superschnell".
- **Bone ist nicht weiß:** `#F5F2EC`, niemals `#FFFFFF` außer im Druck.
- **Keine Emoji** in technischer Kommunikation. Mittel-Punkt `·` ist Brand-Trenner.
- **Triadische Claim** "Reaction. Protection. Solution." — niemals erweitern.
- **Adresse:** Lichtenwörth, Michael-Hainisch-Straße 8, 2493 (Source of Truth — der Mockup `home.html` hat fälschlich "Linz" stehen).

## Einbau-Workflow pro Widget

1. Passendes `.md` öffnen — oben in der Datei steht die genaue Platzierung.
2. Bricks-Template oder Seite öffnen, an der Stelle **1 Code-Element** einfügen.
3. Im Code-Element **Execute code ✅** aktivieren (für PHP-basierte Widgets).
4. Code aus dem ```` ``` ````-Block per Copy-Paste einfügen.
5. Speichern → Bricks signiert den Code automatisch.
6. Verifikations-Checkliste aus dem `.md` durchgehen.

## Entscheidungen (fixiert)

| Bereich | Entscheidung | Umsetzung |
|---|---|---|
| Kontaktformular | **Bricks Native Form** (kein Plugin) | `widget-contact-form.md` + `functions.php` Abschnitt 9 |
| Anwendungs-Seiten | **CPT `ignitec_application`** | `functions.php` Abschnitt 8 + `step-6-applications.md` |
| Newsletter | **Brevo (free)** | `functions.php` Abschnitt 10 + Admin-Settings Abschnitt 11 |
| Produktgrößen | **8 Größen** (Mockup: 30 g bis 2,0 kg) | `pa_serie`-Terms in `functions.php` |
| CTA-Doppelung | Globaler CTA-Strip aus STEP 2 entfernen, wenn `step-3-7-cta.md` aktiv | Hinweis in step-3-7-cta.md |

## Brevo-Setup

Unter **Einstellungen → Ignitec** im WP-Admin:
- Anfrage-Empfänger: `office@ignitec.at`
- Brevo API-Key: aus Brevo → SMTP & API → API Keys
- Brevo List-ID: ID der Newsletter-Kontaktliste

Alternativ via `wp-config.php`:
```php
define( 'IGNITEC_BREVO_API_KEY', 'xkeysib-…' );
define( 'IGNITEC_BREVO_LIST_ID', 3 );
```
