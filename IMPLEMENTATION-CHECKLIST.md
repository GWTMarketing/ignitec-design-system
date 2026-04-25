# IgniTec Website · Umsetzungs-Checkliste

**Stack:** Raidboxes · WordPress · Bricks Builder · WooCommerce · Germanized Pro · ACF Pro (optional, später) · Rank Math Pro · Borlabs Cookie
**Projektrahmen (Angebot AN-2026-001):** ~66 h Setup · 4–6 Wochen · Pauschale € 3.493 netto
**Start-Status:** WordPress installiert, sonst nichts

> **Dies ist die autoritative Checkliste vom Auftraggeber.** Sie gilt vor allen technischen Detail-Anleitungen unter `wp/bricks-widgets/`.

---

## Scope

**Drin:**
- Basiswebsite: Home, Anwendungsbereiche (Overview, kein CPT), Über Uns, Kontakt, Impressum, Datenschutz, AGB, Widerruf
- Produktübersicht + 5–10 Produktdetailseiten (= Shopseiten mit „In den Warenkorb")
- Dynamischer Produktaufbau mit strukturierten Custom Fields (für späteres Vergleichstool — Custom-Meta jetzt, ACF-Migration später möglich)
- Zubehör-Seite (strukturell vorbereitet)
- DSGVO: Borlabs Cookie, Rechtstexte (Germanized), Schema (Rank Math), Google Search Console

**Aktuell außen vor (nachgeschoben in Phase 2):**
- B2B-Loginbereich · Zahlungsarten · PDF-Rechnungen
- Konfigurator, Projektkalkulation, Vergleichstool, Academy

---

## Plugin-Stack (aktualisiert)

| Plugin | Zweck | Lizenz Jahr 1 |
|---|---|---|
| **Bricks Builder** | Page Builder | ~249 € Lifetime |
| **WooCommerce** | Shop-Engine | 0 € |
| **Germanized Pro** | AT/DE-Recht + Rechtstexte | ~99 € |
| **Rank Math Pro** | SEO + Schema.org | ~79 € |
| **Borlabs Cookie** | Consent-Management | bereits vorhanden |

**Außen vor (für später):** B2BKing, ACF Pro, Stripe Gateway, FluentSMTP, Fluent Forms.

> **Aktueller Mailversand:** wp_mail mit optionalem Brevo-SMTP (siehe `wp/theme/ignitec-child/functions.php` §9 + §10). Newsletter-Opt-In über Brevo-API, falls API-Key gesetzt.
>
> **Aktuelles Kontaktformular:** Bricks Code-Widget mit eigenem `admin-post.php`-Handler (siehe `wp/bricks-widgets/widget-contact-form.md`). Kein Plugin nötig.

> **Raidboxes** macht Caching, Backup und Basis-Security serverseitig → kein WP Rocket / UpdraftPlus / Solid Security.

---

## Phase 0 · Zugänge & Lizenzen (~2 h)

- [ ] WordPress Admin-Login verifizieren, eigenen Admin-User anlegen
- [ ] Raidboxes-Zugang einholen (Dashboard + SFTP + DB-Zugriff)
- [ ] PHP-Version auf ≥ 8.2 setzen (Raidboxes → Box Settings)
- [ ] DNS-Verwaltung klären (MX/TXT für office@ und Brevo SPF/DKIM)
- [ ] Lizenzen kaufen
  - [ ] Bricks Builder (Lifetime)
  - [ ] Germanized Pro
  - [ ] Rank Math Pro
- [ ] Google-Account anlegen + Search Console + Analytics 4

---

## Phase 1 · WordPress Basiskonfiguration (~1 h)

- [ ] Site Title `IgniTec` · Tagline `Reaction. Protection. Solution.`
- [ ] Timezone Europe/Vienna · Date Format `j. F Y`
- [ ] Permalinks → **Post name**
- [ ] Kommentare deaktivieren
- [ ] Reading → „Discourage search engines" **AN** (bis Go-Live)
- [ ] User-Rollen: Freelancer-Admin, Auftraggeber-Admin, Editor

---

## Phase 2 · Plugin-Installation (~1,5 h)

- [ ] Bricks Builder als Theme hochladen · noch nicht aktivieren
- [ ] WooCommerce installieren + aktivieren
- [ ] Germanized Pro installieren + Lizenz · Wizard (Rechtstexte) → siehe `wp/bricks-widgets/step-8-legal.md`
- [ ] Rank Math Pro installieren + Lizenz · Setup-Wizard → siehe `wp/bricks-widgets/step-rank-math.md`
- [ ] Borlabs Cookie installieren + Lizenz → siehe `wp/bricks-widgets/step-borlabs-cookie.md`

---

## Phase 3 · Child-Theme + Bricks Setup (~3 h)

- [ ] Child-Theme `ignitec-child/` aus dem Repo zippen + hochladen + aktivieren
  - vorher: `assets/` mit Logos befüllen (logo-full-white, mark-white …)
  - vorher: `fonts/` mit Archivo-Variablefonts befüllen
- [ ] Bricks-Theme aktivieren, Lizenz eintragen
- [ ] Bricks → Settings → Code Execution für Administratoren AN
- [ ] Bricks → Theme Styles → "IgniTec Default" anlegen (siehe `wp/README.md` für Werte)
- [ ] Globale Farben & Typografie verifizieren

---

## Phase 4 · Header & Footer (~2 h)

- [ ] Bricks-Template "Header" (Condition: Entire Website) → 1 Code-Element aus `wp/bricks-widgets/step-1-header.md`
- [ ] WordPress-Menü "Hauptnavigation": Home · Anwendungen · Produkte · Zubehör · Über uns · Kontakt
- [ ] Bricks-Template "Footer" (Condition: Entire Website) → 1 Code-Element aus `wp/bricks-widgets/step-2-footer.md`
- [ ] 4 Footer-Menüs anlegen (Produkt, Anwendung, Unternehmen, Service)

---

## Phase 5 · Home + Funken-Hero (~4 h)

Reihenfolge entspricht dem Mockup `extracted/mockups/home.html`:

- [ ] Page „Home" anlegen · Reading → Homepage = Home
- [ ] Section 1 Hero · Inhalt aus `step-3-1-hero.md` (Spark-Canvas, rotierende Ringe, Aerosol-Unit, Stat-Micro)
- [ ] Section 2 USP · `step-3-2-usp.md` (3×2-Grid, 6 Eigenschaften)
- [ ] Section 3 Produkt-Teaser · `step-3-3-product-highlights.md`
- [ ] Section 4 Anwendungen · `step-3-4-applications.md` (Anchor-Links auf `/anwendungen/#bess` etc.)
- [ ] Section 5 Referenz · `step-3-5-reference.md`
- [ ] Section 6 Stat Bar · `step-3-6-statbar.md`
- [ ] Section 7 CTA · `step-3-7-cta.md` *(globalen CTA-Strip aus `step-2-footer.md` entfernen, sonst Doppelung)*
- [ ] Section 8 FAQ · `step-3-8-faq.md` (optional)

---

## Phase 6 · Statische Seiten (~4 h)

- [ ] `/anwendungen/` · siehe `step-6-applications.md` (1 Hero + 6 Anchor-Sections)
- [ ] `/ueber-uns/` · Kurzprofil, Standort Lichtenwörth (manuell, kein Code-Widget nötig)
- [ ] `/zubehoer/` · Platzhalter "In Vorbereitung"
- [ ] `/kontakt/` · siehe `step-7-contact.md` (Hero + Kontaktformular + Info + OSM-Map)

---

## Phase 7 · WooCommerce + dynamische Produktstruktur (~8 h)

### Grundkonfiguration
- [ ] Setup-Wizard: Store AT · EUR · physisch · 20 % USt
- [ ] Versandzonen: AT (Standard) · EU (Premium)
- [ ] Versandklassen: Gefahrgut UN 3268 Klasse 9 (Aufpreis vom Auftraggeber)
- [ ] Zahlungen: **vorerst nur "Anfrage / Angebot"-Modus**, kein Stripe/Rechnung im aktuellen Scope

### Globale Produkt-Attribute
- [ ] Bei aktiver Child-Theme automatisch geseedet (siehe `functions.php` §2). Verifizieren unter **WooCommerce → Produkte → Attribute**:
  - `pa_serie` (ST-30…ST-2000)
  - `pa_einsatzbereich` · `pa_ausloesung` · `pa_montage` · `pa_norm`

### Produkt-Custom-Meta (jetzt: Custom Tab)
Aktuell über Custom-Meta-Tab in `functions.php` §3. **Spätere Migration auf ACF Pro** möglich, falls für Vergleichstool nötig.

Felder im Tab "Ignitec Technische Daten":
- Aerosolmasse (g) · Schutzvolumen (m³) · Entladezeit (s) · Abmessungen · Gewicht
- Temperaturbereich · Lagerzeit · GWP · ODP · IP-Schutz
- Datenblatt-PDF (URL) · Homepage-Highlight · Auslegungspflichtig

### Produktanlage
- [ ] 8 Standardprodukte anlegen (siehe `step-3-3-product-highlights.md`)
- [ ] Bilder, Texte (vom Auftraggeber), Attribute, Custom-Meta pflegen
- [ ] **STEP 4** (Shop-Archiv) und **STEP 5** (Produkt-Single) aktivieren — sobald Produkte da

---

## Phase 8 · Rechtliches (Germanized Pro) (~3 h)

Komplette Anleitung: `wp/bricks-widgets/step-8-legal.md`

- [ ] Germanized Wizard · Rechtstextegenerator durchlaufen
- [ ] Pflichtseiten erstellen lassen: Impressum, Datenschutz, AGB, Widerrufsbelehrung
- [ ] Bricks-Template "Legal Layout" anlegen
- [ ] Footer-Menü "Service" mit Pflichtseiten verlinken

---

## Phase 9 · Borlabs Cookie (~1 h)

Komplette Anleitung: `wp/bricks-widgets/step-borlabs-cookie.md`

- [ ] Borlabs Setup-Wizard
- [ ] Cookie-Gruppen (Essenziell, Statistik, Marketing, Externe Medien)
- [ ] Branding im Ignitec-CI (Slateblue-Header, Copper-Buttons)
- [ ] GA4-Cookie konfigurieren
- [ ] Footer-Link "Cookie-Einstellungen" einbinden

---

## Phase 10 · SEO (Rank Math Pro) (~2 h)

Komplette Anleitung: `wp/bricks-widgets/step-rank-math.md`

- [ ] Setup-Wizard durchklicken (Business-Type Local Business)
- [ ] Local-SEO Block ausfüllen (Adresse, Öffnungszeiten, GeoCoordinates)
- [ ] Pro Page Meta-Title + Description
- [ ] XML-Sitemap aktivieren + in Search Console einreichen
- [ ] Schema-Validierung (Rich Results Test) für Home, Kontakt, Produkt-Single

---

## Phase 11 · QA & Launch (~2 h)

### Testing
- [ ] Cross-Browser: Chrome, Firefox, Safari, Edge
- [ ] Mobile: 375 · 768 · 1024
- [ ] Funken-Hero auf Lowend-Android testen (Performance)
- [ ] Kontaktformular: Mail an `office@ignitec.at` kommt an, Auto-Reply funktioniert
- [ ] Lighthouse Mobile: Performance ≥ 85, Best Practices ≥ 95, SEO ≥ 95

### Launch
- [ ] Reading → „Discourage search engines" **AUS**
- [ ] Raidboxes → Staging auf Live pushen
- [ ] DNS-Check ignitec.at → Raidboxes-IP
- [ ] Search Console: Sitemap einreichen
- [ ] Monitoring 48 h nach Launch

---

## Hinweise & Risiken

- **Texte vom Auftraggeber** spätestens Ende Woche 2 — sonst Launch-Verschiebung
- **Rechtstexte-Prüfung** durch IT-Recht-Kanzlei empfohlen (~150–400 €, nicht im Freelancer-Scope)
- **Gefahrgut-Versand** UN 3268 / Klasse 9 — ADR-Vertrag mit Paketdienst muss vom Auftraggeber organisiert werden
- **Vergleichstool später** — Custom-Meta ist SQL-queryable über `wp_postmeta` (`meta_key='_ignitec_*'`)

---

## Offene Punkte vom Auftraggeber

1. Preise pro Produkt
2. Versandkosten-Aufpreis für Gefahrgut
3. ADR-Versandpartner (DHL/DPD)
4. Welche 5–10 Produkte zum Launch
5. Produktbilder / Renderings finalisiert?
6. Website-Texte (Home, Anwendungsbereiche, Über uns, Produktbeschreibungen)
7. Notfall-Hotline-Nummer für Footer
8. Rechtstexte-Prüfung durch Jurist beauftragt?
