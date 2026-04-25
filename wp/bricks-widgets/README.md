# Ignitec · Bricks Code Widgets

Sammlung aller Bricks-Code-Widget-Blöcke und Setup-Anleitungen. Reihenfolge entspricht dem Mockup `extracted/mockups/home.html` und der Auftraggeber-Checkliste in `/IMPLEMENTATION-CHECKLIST.md`.

**Vorbedingung:** Child-Theme aus `../theme/ignitec-child/` aktiv. Alle Widgets nutzen die dort definierten CSS-Variablen.

## Liefer-Übersicht

| Step | Datei | Zweck | Status |
|---|---|---|---|
| 1 | `step-1-header.md` | Globaler Header (Sticky, Off-Canvas, IgniTec-Wordmark) | ✅ |
| 2 | `step-2-footer.md` | Globaler Footer (4 Spalten) | ✅ |
| 3.1 | `step-3-1-hero.md` | Hero (Spark-Canvas + Ringe + Aerosol-Unit + Stat-Micro) | ✅ |
| 3.2 | `step-3-2-usp.md` | USP-Grid 3×2 | ✅ |
| 3.3 | `step-3-3-product-highlights.md` | Produkt-Teaser 4 Karten | ✅ |
| 3.4 | `step-3-4-applications.md` | Anwendungen 6-Spalten Dark (Anchor-Links) | ✅ |
| 3.5 | `step-3-5-reference.md` | Referenz / Quote | ✅ |
| 3.6 | `step-3-6-statbar.md` | Stat Bar 4 Vertrauens-Werte | ✅ |
| 3.7 | `step-3-7-cta.md` | CTA Copper + Glass-Card | ✅ |
| 3.8 | `step-3-8-faq.md` | FAQ (optional) | ✅ |
| Form | `widget-contact-form.md` | Wiederverwendbares Bricks-Code-Formular | ✅ |
| 6 | `step-6-applications.md` | Anwendungen Übersichtsseite mit 6 Anchor-Sections | ✅ |
| 7 | `step-7-contact.md` | Kontakt-Seite (Form + OSM-Map) | ✅ |
| 8 | `step-8-legal.md` | Germanized Pro Wizard für Impressum/DS/AGB/Widerruf | ✅ |
| SEO | `step-rank-math.md` | Rank Math Pro Setup (Schema, Sitemap, Search Console) | ✅ |
| Cookie | `step-borlabs-cookie.md` | Borlabs Cookie Setup im IgniTec-CI | ✅ |
| 4 | _pending_ | Shop-Archiv (Bricks Filter) | 🔜 nach Produktanlage |
| 5 | _pending_ | Produkt-Single mit dynamischer Spec-Table | 🔜 nach Produktanlage |

## Plugin-Stack (aktuell)

| Plugin | Zweck |
|---|---|
| **Bricks Builder** | Page Builder |
| **WooCommerce** | Shop |
| **Germanized Pro** | Rechtstexte + AT/DE-Recht |
| **Rank Math Pro** | SEO + Schema |
| **Borlabs Cookie** | Consent |

**Außen vor (für später):** B2BKing, ACF Pro, Stripe, Fluent Forms, FluentSMTP.

**Aktueller Mailversand:** wp_mail mit optionalem Brevo-SMTP. Newsletter via Brevo-API (siehe `functions.php` §9 + §10).
**Aktuelles Kontaktformular:** Bricks Code-Widget mit eigenem `admin-post.php`-Handler (siehe `widget-contact-form.md`).

## Wichtige Architektur-Regeln

- **Kein Inline-JSON-LD** in Bricks-Widgets. Schema läuft global über **Rank Math Pro**.
- **Anwendungen** haben **eine** Übersichtsseite `/anwendungen/` mit 6 Anchor-Sections — keine Einzelseiten / kein CPT.
- **Hero Claim Exception:** genau ein italic+gradient-Wort pro Hero auf dunklem Carrier. Nirgendwo sonst.
- **Sentence-Case** in allen Headlines, außer JetBrains-Mono-Eyebrows (UPPERCASE +0.22em).
- **Bone ist nicht weiß:** `#F5F2EC`, niemals `#FFFFFF` außer im Druck.
- **Adresse:** Lichtenwörth, Michael-Hainisch-Straße 8, 2493.

## Einbau-Workflow pro Widget

1. Passendes `.md` öffnen — oben in der Datei steht die genaue Platzierung.
2. Bricks-Template oder Seite öffnen, an der Stelle **1 Code-Element** einfügen.
3. **Execute code ✅** aktivieren (für PHP-basierte Widgets).
4. Code aus dem ```` ``` ````-Block per Copy-Paste einfügen.
5. Speichern → Bricks signiert den Code automatisch.
6. Verifikations-Checkliste aus dem `.md` durchgehen.

## Brevo-Setup

Unter **Einstellungen → Ignitec** im WP-Admin:
- Anfrage-Empfänger: `office@ignitec.at`
- Brevo API-Key (optional, nur für Newsletter-Opt-Ins)
- Brevo List-ID

Alternativ via `wp-config.php`:
```php
define( 'IGNITEC_BREVO_API_KEY', 'xkeysib-…' );
define( 'IGNITEC_BREVO_LIST_ID', 3 );
```
