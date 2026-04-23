# Ignitec WordPress / Bricks Builder / WooCommerce — Build-Plan

> **Status:** genehmigt · Branch `claude/wordpress-bricks-woocommerce-build-5LvAd`
> **Letzte Überarbeitung:** 2026-04-23 — nach Abgleich mit realen Design-Tokens und Produkt-Kontext

---

## 1 · Kontext

Aufbau der kompletten Ignitec-Website auf **WordPress + Bricks Builder + WooCommerce** auf Basis des Design-Systems unter `extracted/` (React/Tailwind-Referenz + Tokens).

**Produkt:** Kondensierte Aerosol-Löschgeneratoren (Serie ST) für Schaltschrank, BESS, Maschinenraum, Serverraum. Normen CEN/TR 15276-1, ISO 15779. Reaktion ≤ 20 s, GWP 0.

**Hersteller:** Ignitec GmbH, Michael-Hainisch-Straße 8, A-2493 Lichtenwörth, FN 651979v · ATU81975427, office@ignitec.at

**Kernanforderungen (abgestimmt):**
- Sukzessive Umsetzung über das **Bricks Code Widget** (PHP + HTML + CSS + JS pro Sektion).
- Design-Tokens global via **Bricks Theme Styles + Child-Theme CSS**.
- Hero-Spark-Canvas **1:1** (Vanilla Canvas-JS, 140 Partikel, Copper-Farbtöne).
- Produkt-Eigenschaften **nativ in WooCommerce** (globale Attribute + Custom Product Meta), **keine kostenpflichtigen Plugins**.
- SEO + GEO-optimierte Texte pro Sektion (semantisches HTML, Schema.org JSON-LD, LLM-freundliche FAQ-/Summary-Blöcke).
- Liefer-Reihenfolge: **STEP 0 → Header → Footer → Startseite → Shop → Produkt-Single → Anwendungen → Kontakt → Legal**.

---

## 2 · Design-Tokens (Quelle: `extracted/colors_and_type.css`)

| Token | Wert | Verwendung |
|---|---|---|
| `--copper-solid` | `#793907` | Primary Accent |
| `--copper-light` | `#D06E3D` | Eyebrow, Highlights |
| `--copper-mid` | `#80401D` | Gradient Mid |
| `--copper-deep` | `#3A1612` | Gradient Deep |
| `--slateblue` | `#152234` | Primary Text, Dark BG |
| `--bone` | `#F5F2EC` | Page Background (NIE #FFF) |
| `--ember` | `#E8622A` | Alarm / Trigger-State |
| `--ink-000..500` | `#0B121C`…`#3D4A5C` | Dark UI Neutral |

**Fonts:** Archivo (Display, lokal), IBM Plex Sans (Body, Google Fonts), JetBrains Mono (Tech), Poppins (Logo).
**Spacing:** 8-pt Grid (`--s-1..10`).
**Radii:** 2, 4, 6, 10, 14 px, Pill.

---

## 3 · Produkt-Datenmodell (WooCommerce-only, gratis)

### Globale Attribute (`WooCommerce → Produkte → Attribute`)
Wiederverwendbare, facettierbare Eigenschaften — ideal für Filter-Facetten im Shop:

| Slug | Label | Werte (Terms) |
|---|---|---|
| `pa_serie` | Serie | ST-50, ST-100, ST-200, ST-400, ST-800, ST-1200, ST-1600 |
| `pa_einsatzbereich` | Einsatzbereich | Schaltschrank, BESS, Maschinenraum, Serverraum, Fahrzeug, Industrie |
| `pa_ausloesung` | Auslösung | Thermisch, Elektrisch, Manuell, Dual |
| `pa_montage` | Montageart | Wand, Decke, Schrankboden, 19-Zoll-Rack |
| `pa_norm` | Norm / Zulassung | CEN/TR 15276-1, ISO 15779, VdS, UL-2775, FM |

### Custom Product Meta (Tab "Ignitec Technische Daten" in der WC-Produkt-Maske)
Numerische / unique Werte, aus `functions.php` registriert, per Bricks Dynamic Data auslesbar als `{post_meta:_ignitec_…}`:

| Meta-Key | Typ | Beispielwert |
|---|---|---|
| `_ignitec_aerosol_masse_g` | float (g) | 120 |
| `_ignitec_schutzvolumen_m3` | float (m³) | 1.8 |
| `_ignitec_entladezeit_s` | float (s) | 12 |
| `_ignitec_abmessungen_mm` | string | 285 × 100 × 100 |
| `_ignitec_gewicht_kg` | float | 1.6 |
| `_ignitec_temp_bereich` | string | −40 °C … +95 °C |
| `_ignitec_lagerzeit_jahre` | int | 15 |
| `_ignitec_gwp` | int | 0 |
| `_ignitec_odp` | float | 0 |
| `_ignitec_ip_schutz` | string | IP40 |
| `_ignitec_datenblatt_pdf` | URL | /wp-content/uploads/… |
| `_ignitec_featured` | bool | true (Homepage-Highlight) |

---

## 4 · Liefer-Reihenfolge (Steps)

| # | Step | Artefakt |
|---|---|---|
| 0 | Theme-Setup | Child-Theme (style.css, functions.php), Theme-Style-Anleitung |
| 1 | Header (global) | 1× Bricks Code Widget + Menu-Registrierung |
| 2 | Footer (global) | 1× Bricks Code Widget (CTA-Strip + Footer) |
| 3.1 | Homepage · Hero | 1× Bricks Code Widget mit Spark-Canvas |
| 3.2 | Homepage · Stat Bar | 1× Bricks Code Widget |
| 3.3 | Homepage · Produkt-Highlights | 1× Bricks Code Widget (WC Query) |
| 3.4 | Homepage · Anwendungen | 1× Bricks Code Widget |
| 3.5 | Homepage · Technologie-USP | 1× Bricks Code Widget |
| 3.6 | Homepage · Prozess / Ablauf | 1× Bricks Code Widget |
| 3.7 | Homepage · FAQ (JSON-LD) | 1× Bricks Code Widget |
| 3.8 | Homepage · Final-CTA | 1× Bricks Code Widget |
| 4 | Shop-Archiv | Bricks-Template + Filter-Konfiguration |
| 5 | Produkt-Single | Bricks-Template + Spec-Table-Widget |
| 6 | Anwendungs-Seiten | CPT **oder** WC-Kategorie (Klärung offen) |
| 7 | Kontakt | Kontakt-Formular (Plugin offen) + OSM-Map |
| 8 | Legal | Impressum, Datenschutz, AGB, Widerruf |

Jede Sektion als abgeschlossener Bricks-Code-Widget-Block — HTML/CSS/JS/PHP inline, keine externen Abhängigkeiten außer den globalen Tokens.

---

## 5 · Verifikation (End-to-End je Sektion)

1. **Visual-Check:** Bricks-Preview ≙ Referenz-Screenshot (Abweichung < 2 %).
2. **Responsive:** 375 / 768 / 1440 px.
3. **Dynamik:** Meta im Backend geändert → Frontend zeigt Update sofort.
4. **Performance:** Lighthouse Mobile > 90, kein Render-Blocking.
5. **SEO:** genau 1× `<h1>`, saubere H2/H3-Hierarchie, JSON-LD valide im Rich-Results-Test.
6. **GEO/LLM:** FAQ + Summary serverseitig gerendert (kein JS-Only-Content).

---

## 6 · Offene Entscheidungen (vor Step 6/7)

1. Kontaktformular: Contact Form 7 (free) oder Fluent Forms Free?
2. Anwendungs-Seiten: Custom Post Type `ignitec_application` **oder** erweiterte WC-Kategorie-Pages?
3. Newsletter? Wenn ja: Brevo / MailPoet (free)?

Diese werden vor dem jeweiligen Step gezielt angefragt.
