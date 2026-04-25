# STEP · Rank Math Pro Konfiguration

Rank Math Pro übernimmt **alles SEO-relevante**: Meta-Titles, Meta-Descriptions, Schema.org-Markup, XML-Sitemaps, Search-Console-Anbindung. Im Repo wurde bewusst **kein Inline-JSON-LD** in Bricks-Widgets eingebaut — es würde mit Rank Math doppeln und die Daten in der Pflege verteilen.

---

## 1 · Installation & Lizenz

- [ ] Rank Math Pro installieren (Plugins → Hochladen → ZIP) + aktivieren
- [ ] Lizenz aktivieren (Lizenzkey aus rankmath.com Account)
- [ ] **Rank Math → Setup-Wizard** durchlaufen:
  - Site-Type: **Business / Local Business**
  - Site-Name: `Ignitec`
  - Logo: `logo-full-official.png` (aus Mediathek)
  - Standard-Bild: ein Brand-Hero (für Social-Sharing)
  - Connect Google: Search Console + Analytics 4 verknüpfen

## 2 · Globale Schema-Defaults

**Rank Math → Titles & Meta → Local SEO**

- [ ] **Business Type:** Organization (zusätzlich LocalBusiness optional, siehe unten)
- [ ] **Address:** Michael-Hainisch-Straße 8 · 2493 Lichtenwörth · AT
- [ ] **Country:** Austria
- [ ] **Email:** office@ignitec.at
- [ ] **Phone:** _(vom Auftraggeber)_
- [ ] **Logo:** auswählen
- [ ] **Opening Hours:**
  - Monday–Friday: 08:00–17:00
  - Saturday/Sunday: closed
- [ ] **GeoCoordinates:** Lat/Lng aus Google Maps eintragen (Rechtsklick auf Standort → Koordinaten kopieren)
- [ ] **Same-As-Profile:** LinkedIn-URL, ggf. weitere Brand-Profile

→ Rank Math gibt damit auf jeder Seite ein `Organization`-Schema im Head aus. Das **deckt den Footer** komplett ab — kein Inline-Code nötig.

## 3 · Page-Schema (LocalBusiness auf Kontakt-Seite)

Auf der Kontakt-Seite zusätzlich ein detaillierteres Schema setzen:

- [ ] WP-Admin → Seiten → Kontakt → bearbeiten
- [ ] Rechts im Rank-Math-Sidebar-Panel: **Schema → Schema Generator → Local Business**
- [ ] Felder vorausfüllen lassen (zieht aus Local-SEO-Defaults)
- [ ] Fehlende Werte ergänzen: Telefon, ggf. Bewertungen
- [ ] **Save** → das Local-Business-Schema wird im Page-Head gerendert

## 4 · FAQ-Schema (Homepage FAQ-Sektion)

Variante A — **Rank Math FAQ-Block** (empfohlen):

- [ ] Auf der Startseite eine kleine, **versteckte** FAQ-Sektion mit dem Rank-Math-eigenen FAQ-Block hinzufügen (Gutenberg `Schema → FAQ`).
- [ ] Inhalte 1:1 von der Bricks-FAQ-Sektion übernehmen.
- [ ] Block sichtbar ausblenden via Bricks-Container: `display: none;`
- → Schema läuft, Look bleibt 100% Bricks-Design.

Variante B — **Schema Custom Code** (alternativ):

- [ ] Rank Math → Schema → Add Schema → Custom Code
- [ ] FAQPage-JSON wie unter https://schema.org/FAQPage einfügen
- [ ] Conditions: nur Startseite

## 5 · Product-Schema (für STEP 5 Produkt-Single)

Rank Math erkennt WooCommerce-Produkte automatisch und erzeugt das **Product-Schema** inklusive:
- name, sku, description
- offers (preis, currency, availability)
- brand: Ignitec
- category: aus WC-Kategorie

→ **Keine Konfiguration nötig** — sobald Produkte angelegt sind, läuft das Schema automatisch.

Empfohlen pro Produkt:
- Beitragsbild gepflegt
- Kurzbeschreibung gepflegt
- Preis gesetzt (auch wenn vorerst nur Anfrage-Button)

## 6 · Meta-Titles & Descriptions

Rank Math → Titles & Meta:

- [ ] **Homepage:** Title `Ignitec — Kondensierte Aerosol-Löschsysteme · Serie ST` · Description: 150–160 Zeichen mit "Reaktion ≤ 20 s, GWP 0, EN 15276"
- [ ] **Product Archive (`/shop/` bzw. `/produkte/`):** Title `Aerosol-Löschgeneratoren · Serie ST | Ignitec`
- [ ] **Single Products:** Template `%title% · %sep% · Aerosol-Generator | Ignitec`
- [ ] **Pages:** Template `%title% · %sep% · Ignitec`
- [ ] **Anwendungen-Seite:** manuell Title + Description ausfüllen

## 7 · XML-Sitemap

- [ ] Rank Math → Sitemap → General Settings → AN
- [ ] Posts, Pages, Products in Sitemap aufnehmen
- [ ] Bilder-Sitemap aktivieren
- [ ] Sitemap-URL `https://ignitec.at/sitemap_index.xml` notieren
- [ ] **Search Console** → Sitemap einreichen

## 8 · Search Console & Analytics

- [ ] Rank Math → Analytics → Search Console verknüpfen (OAuth)
- [ ] Property `ignitec.at` verifizieren (geht meist automatisch nach OAuth)
- [ ] GA4-Property verknüpfen (Measurement-ID oder OAuth)

## 9 · Robots.txt + .htaccess

- [ ] Rank Math → Tools → Database Tools → robots.txt
- [ ] Default-Inhalt ist OK; Staging-Domain (vor Go-Live) zusätzlich `Disallow: /` setzen
- [ ] **Reading-Settings „Discourage search engines" muss vor Go-Live AUS** sein

## 10 · Content-Analyse für Top-Pages

Rank Math zeigt pro Seite einen SEO-Score (1–100) basierend auf Focus-Keyword. Empfohlene Focus-Keywords:

| Seite | Focus-Keyword |
|---|---|
| Homepage | `kondensierte Aerosol-Löschsysteme` |
| /produkte/ | `Aerosol-Löschgenerator` |
| /anwendungen/ | `Brandschutz Schaltschrank BESS` |
| /anwendungen/#bess | `BESS Brandschutz` |
| /anwendungen/#schaltanlagen | `Schaltschrank Brandschutz` |
| /kontakt/ | `Brandschutz Lichtenwörth` |

Pro Seite SEO-Score auf ≥ 80 bringen (bessere Title-Description, mehr Keyword-Density im Body, alt-Texte für Bilder).

## 11 · Verifikation

- [ ] `view-source:ignitec.at` zeigt im Head: `<script type="application/ld+json">…Organization…</script>` (1× pro Seite, NICHT mehrfach)
- [ ] Google Rich Results Test (`search.google.com/test/rich-results`) zeigt:
  - Homepage → Organization, optional FAQPage
  - Kontakt → LocalBusiness valid
  - Product-Single → Product valid (sobald Produkte angelegt)
- [ ] Sitemap erreichbar unter `/sitemap_index.xml`
- [ ] Search-Console: Eingereichte Sitemap = "Erfolgreich gelesen"
- [ ] Lighthouse SEO-Score ≥ 95

---

**Hinweis:** Die Bricks-Widgets im Repo enthalten **keinen** Inline-JSON-LD-Code mehr. Wenn du beim Build trotzdem inline Schema setzen willst (z. B. für Tests vor Rank Math), kannst du temporär ein `<script type="application/ld+json">…</script>` in das Code-Widget einfügen — vor Go-Live aber wieder entfernen, sonst Doppelung.
