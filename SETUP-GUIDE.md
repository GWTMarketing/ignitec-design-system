# Ignitec · Setup-Checkliste bis STEP 4

**Ausgangslage:** WordPress ist installiert, sonst nichts.
**Ziel:** Website steht vollständig (Header, Footer, Homepage, Anwendungen, Kontakt, Legal). Ab dann geht STEP 4 (Shop).

Jede Box abhaken, wenn erledigt. Zeitangaben sind grobe Richtwerte.

---

## TEIL 1 · Plugins & Theme installieren (30 Min)

- [ ] **Bricks Builder kaufen** (brickbuilder.io) und Lizenzschlüssel erhalten
- [ ] **Bricks-ZIP hochladen:** WP-Admin → Design → Themes → Neues Theme → Hochladen → Datei auswählen → Installieren → **nicht aktivieren**
- [ ] **Bricks-Lizenz aktivieren:** Bricks → License → Key einfügen → Activate
- [ ] **WooCommerce installieren:** Plugins → Installieren → "WooCommerce" suchen → Installieren → Aktivieren
- [ ] **WooCommerce Setup-Wizard** durchklicken (Firma = Ignitec GmbH, Österreich, EUR, B2B)
- [ ] **Brevo-Plugin installieren:** Plugins → Installieren → "Brevo" suchen ("Newsletter, SMTP, Email marketing…") → Installieren → Aktivieren

## TEIL 2 · Child-Theme hochladen (15 Min)

Vor dem Zippen den `ignitec-child/`-Ordner mit den Brand-Assets befüllen:

- [ ] **Ordner `ignitec-child/fonts/`** anlegen und befüllen mit den Archivo-Variablefonts aus dem Design-System (`extracted/fonts/`):
  - `Archivo-VariableFont_wdth_wght.ttf`
  - `Archivo-Italic-VariableFont_wdth_wght.ttf`
- [ ] **Ordner `ignitec-child/assets/`** anlegen und befüllen mit den Logos aus `extracted/assets/`:
  - `logo-full-white.png` (Header + Footer — wird auf dunklem Grund verwendet)
  - `logo-full-official.png` (Reserve für helle Hintergründe)
  - `mark-white.png` (kleine Karten-Icons)
  - `mark-copper-gradient.png` (optional)
- [ ] Komplett-Ordner `ignitec-child/` als **ZIP** packen
- [ ] WP-Admin → Design → Themes → Neues Theme → Hochladen → ZIP wählen → Installieren
- [ ] **"Ignitec Child (Bricks)" aktivieren**
- [ ] Kontrolle: Design → Themes zeigt "Ignitec Child (Bricks)" als aktiv
- [ ] **Logo-Sichtprüfung:** Frontend `/` neu laden → in Header oben links muss die echte "IgniTec"-Wortmarke (Copper-Mark + dunkle/helle Type) erscheinen, kein Platzhalter

## TEIL 3 · WordPress-Grundkonfiguration (10 Min)

- [ ] **Permalinks:** Einstellungen → Permalinks → "Beitragsname" → Speichern (wichtig für CPT-URLs)
- [ ] **Startseite vorbereiten:** Seiten → Neu erstellen → Titel "Start" → Speichern als Entwurf
- [ ] **Startseite setzen:** Einstellungen → Lesen → "Eine statische Seite" → Startseite = "Start" → Speichern
- [ ] **Site-Title + Tagline:** Einstellungen → Allgemein → Titel "Ignitec" · Untertitel "Kondensierte Aerosol-Löschsysteme"
- [ ] **Zeitzone:** Einstellungen → Allgemein → Europe/Vienna

## TEIL 4 · Bricks konfigurieren (15 Min)

- [ ] **Code Execution freischalten:** Bricks → Settings → Builder Access → "Code Execution" für Administrators aktivieren
- [ ] **Theme Style anlegen:** Bricks → Theme Styles → Add New → Name "Ignitec Default"
  - Typography: Body = IBM Plex Sans 300 / 17px · H1–H4 = Archivo (siehe `wp/README.md` für exakte Werte)
  - Colors: Primary `#793907` · Secondary `#152234` · Background `#F5F2EC` · Accent `#E8622A`
  - Section: Container Max 1280 · Padding 28 · Section-Y 96 / 64 mobile
- [ ] **Conditions:** Theme Style → Apply to "Entire Website" → Save

## TEIL 5 · Menüs anlegen (15 Min)

Design → Menüs → Menü erstellen (für jedes Menü einmal):

- [ ] **Menü 1 "Hauptnavigation"** — Einträge: Technologie · Produkte · Anwendungen · Referenzen · Wissen · Über · Kontakt · Position "Hauptnavigation (Header)"
- [ ] **Menü 2 "Footer Produkt"** — Einträge: Serie ST · Zubehör · Konfigurator · Datenblätter · Position "Footer · Produkt"
- [ ] **Menü 3 "Footer Anwendung"** — Einträge: Schaltschrank · BESS · Maschinenraum · Serverraum · Position "Footer · Anwendung"
- [ ] **Menü 4 "Footer Unternehmen"** — Einträge: Über · Referenzen · Presse · Karriere · Position "Footer · Unternehmen"
- [ ] **Menü 5 "Footer Service"** — Einträge: Kontakt · Partner-Portal · Downloads · Impressum · Datenschutz · AGB · Position "Footer · Service"

> Bei Einträgen, deren Zielseite noch nicht existiert: "Individueller Link" mit `#` als URL verwenden, später aktualisieren.

## TEIL 6 · WooCommerce-Attribute prüfen (5 Min)

- [ ] **WooCommerce → Produkte → Attribute** öffnen
- [ ] 5 Attribute müssen erscheinen: `serie`, `einsatzbereich`, `ausloesung`, `montage`, `norm`
- [ ] Falls nicht vorhanden: Einstellungen → Permalinks → Speichern (triggert Re-Seed)
- [ ] Jedes Attribut anklicken → "Terms konfigurieren" → Werte prüfen

## TEIL 7 · Header bauen (STEP 1) · 20 Min

- [ ] **Bricks → Templates → Add New** · Name "Ignitec Main Header" · Type **Header**
- [ ] **Conditions** → "Entire Website" → Save
- [ ] Template öffnen → Edit with Bricks
- [ ] **1 Section** einfügen → darin **1 Code-Element** einfügen
- [ ] Code-Element: **Execute code ✅** + **Render without wrapping tag ✅**
- [ ] Inhalt aus `wp/bricks-widgets/step-1-header.md` (Abschnitt "Code-Widget-Inhalt") kopieren und einfügen
- [ ] Speichern · Vorschau · Desktop + Mobile testen
- [ ] Verifikation: Menü-Einträge der "Hauptnavigation" erscheinen · Hamburger auf Mobil · Off-Canvas geht

## TEIL 8 · Footer bauen (STEP 2) · 15 Min

- [ ] **Bricks → Templates → Add New** · Name "Ignitec Main Footer" · Type **Footer**
- [ ] Conditions → "Entire Website" → Save
- [ ] **1 Code-Element** einfügen (Execute code ✅)
- [ ] Inhalt aus `wp/bricks-widgets/step-2-footer.md` kopieren
- [ ] Speichern → Vorschau → Check: CTA-Strip + 4-Spalten-Grid + Copyright

## TEIL 9 · Homepage bauen (STEP 3.1 bis 3.8) · 75 Min

Die Seite "Start" mit Bricks öffnen. Reihenfolge folgt dem Mockup `home.html`. **In jeder Section 1 Code-Element mit Execute-code ✅**.

- [ ] **Section 1 — Hero** · Inhalt aus `step-3-1-hero.md` (Spark-Canvas, rotierende Ringe, Aerosol-Unit, Stat-Micro)
- [ ] **Section 2 — USP** · Inhalt aus `step-3-2-usp.md` (6 Eigenschaften, 3×2-Grid)
- [ ] **Section 3 — Produkt-Teaser** · Inhalt aus `step-3-3-product-highlights.md` *(zeigt leeren Zustand — OK, füllt sich ab STEP 4)*
- [ ] **Section 4 — Anwendungen** · Inhalt aus `step-3-4-applications.md` (6 Use-Cases dunkel)
- [ ] **Section 5 — Referenz** · Inhalt aus `step-3-5-reference.md` (Quote)
- [ ] **Section 6 — Stat Bar** · Inhalt aus `step-3-6-statbar.md` (4 Werte slate-blue)
- [ ] **Section 7 — CTA** · Inhalt aus `step-3-7-cta.md` (Copper + Glass-Card)
      ⚠ Wenn aktiv: globalen CTA-Strip in STEP 2 (`step-2-footer.md`) entfernen, sonst Doppelung
- [ ] **Section 8 — FAQ** · Inhalt aus `step-3-8-faq.md` (optional, GEO-Bonus)
- [ ] Speichern → Frontend `/` prüfen → Alle Sections sichtbar
- [ ] Responsive-Check: 375 / 768 / 1440 px
- [ ] Hero-Check: Ringe rotieren, Aerosol-Unit zentriert, Spark-Canvas läuft

## TEIL 10 · Anwendungen-CPT (STEP 6) · 30 Min

- [ ] **Permalinks erneut speichern** (Einstellungen → Permalinks → Speichern) — wichtig, damit `/anwendungen/` greift
- [ ] Linkes WP-Menü zeigt jetzt "Anwendungen" → Neu erstellen für jede Branche:

| Titel | Slug | Filter-Term |
|---|---|---|
| Schaltschrank-Brandschutz | schaltschrank | schaltschrank |
| BESS-Brandschutz | bess | bess |
| Maschinenraum-Brandschutz | maschinenraum | maschinenraum |
| Serverraum-Brandschutz | serverraum | serverraum |
| Fahrzeug-Brandschutz | fahrzeug | fahrzeug |

- [ ] Jeweils: Titel · redaktioneller Text im Editor · Beitragsbild · Meta-Box "Ignitec Anwendungs-Daten" ausfüllen
- [ ] **Single-Template anlegen:** Bricks → Templates → Add New · Name "Single Anwendung" · Type **Single** · Conditions: Post Type = Anwendungen · 1 Code-Element aus `step-6-applications.md` (Abschnitt 3)
- [ ] **Archiv-Template anlegen:** Bricks → Templates → Add New · Name "Archiv Anwendungen" · Type **Archive** · Conditions: Post Type Archive = Anwendungen · 1 Code-Element aus `step-6-applications.md` (Abschnitt 4)
- [ ] Test: `/anwendungen/` und `/anwendungen/bess/` funktionieren

## TEIL 11 · Kontakt-Seite (STEP 7) · 25 Min

- [ ] **Seite erstellen:** Seiten → Neu · Titel "Kontakt" · Slug `kontakt`
- [ ] Mit Bricks öffnen → **3 Sections** mit je 1 Code-Element aus `step-7-contact.md`:
  - Section A: Hero-Intro (Abschnitt 3)
  - Section B: Formular + Info-Grid (Abschnitt 4)
  - Section C: Map + LocalBusiness (Abschnitt 5)
- [ ] **Map-Koordinaten:** In Section C die Lat/Lng auf die exakten Ignitec-Koordinaten anpassen (aus Google Maps: Rechtsklick → "Was ist hier?")

## TEIL 12 · Brevo-Integration (15 Min)

- [ ] **Brevo-Account anlegen:** brevo.com → Free-Plan registrieren
- [ ] **API-Key erstellen:** Brevo-Dashboard → SMTP & API → API Keys → Create New Key → Kopieren (beginnt mit `xkeysib-…`)
- [ ] **Newsletter-Liste anlegen:** Brevo → Contacts → Lists → Create → Name "Ignitec Newsletter" → List-ID notieren (Zahl)
- [ ] **SMTP aktivieren:** Brevo-Plugin in WP → Home → API-Key einfügen → Activate
- [ ] **SMTP einschalten:** Brevo-Plugin → Transactional → Enable SMTP (damit ausgehende Mails über Brevo laufen)
- [ ] **Ignitec-Settings:** Einstellungen → Ignitec:
  - Anfrage-Empfänger: `office@ignitec.at`
  - Brevo API-Key: eingefügt
  - Brevo List-ID: Zahl aus Schritt oben
  - Speichern
- [ ] **Testmail:** Auf `/kontakt/` Formular submitten → Mail in office@ignitec.at kontrollieren + Auto-Reply prüfen
- [ ] Mit Newsletter-Haken submitten → Kontakt erscheint in Brevo-Liste

## TEIL 13 · Legal-Seiten (STEP 8) · 20 Min

- [ ] **Legal-Template anlegen:** Bricks → Templates → Add New · Name "Legal Layout" · Type **Page** · Code-Element aus `step-8-legal.md` (Abschnitt 1)
- [ ] **3 Seiten anlegen:**
  - [ ] Seite "Impressum" (Slug `impressum`) → Inhalt aus `step-8-legal.md` Abschnitt 2
  - [ ] Seite "Datenschutz" (Slug `datenschutz`) → Inhalt aus Abschnitt 3
  - [ ] Seite "AGB" (Slug `agb`) → Inhalt aus Abschnitt 4
- [ ] Jeder Seite im Bricks-Page-Setting das Template "Legal Layout" zuweisen
- [ ] **Platzhalter füllen:** Geschäftsführer-Namen im Impressum · Hosting-Anbieter im Datenschutz
- [ ] **⚠ Anwaltliche Prüfung veranlassen** bevor Go-Live

## TEIL 14 · Menüs vervollständigen (10 Min)

- [ ] Design → Menüs → jedes Menü nochmal öffnen → `#`-Platzhalter durch reale Seiten-Links ersetzen (Kontakt, Impressum, Datenschutz, AGB, Anwendungen)

## TEIL 15 · Abnahme-Check vor STEP 4 (10 Min)

- [ ] `/` zeigt alle 8 Homepage-Sections
- [ ] `/kontakt/` funktioniert, Formular-Submit erfolgreich, Mail kommt an
- [ ] `/anwendungen/` und mindestens 1 Single-Anwendung funktionieren
- [ ] `/impressum/` · `/datenschutz/` · `/agb/` erreichbar
- [ ] Header auf jeder Seite, Menü-Einträge funktionieren
- [ ] Footer auf jeder Seite, 4 Spalten gefüllt
- [ ] Google Rich Results Test (`search.google.com/test/rich-results`) zeigt auf Startseite: `Organization`, `FAQPage`, `HowTo` valid
- [ ] Mobile-Test 375 px: kein horizontaler Scroll, Hamburger funktioniert
- [ ] PageSpeed Insights Mobile > 85 (wenn deutlich niedriger: Bilder optimieren)

---

## Bereit für STEP 4

Wenn die 15 Teile alle abgehakt sind, sind wir bereit für:
- **STEP 4** — Shop-Archiv (nach Anlage der ersten echten WC-Produkte)
- **STEP 5** — Produkt-Single

Dafür brauchst du dann **echte Produkte** in WooCommerce. Empfohlene 8 Größen (siehe `step-3-3-product-highlights.md` Abschnitt 1):

| SKU | Name | Größe | Schutzvolumen |
|---|---|---|---|
| IGNI-ST030 | Ignitec Mini Plus  | 30 g | 0,4 m³ |
| IGNI-ST060 | Ignitec Mini      | 60 g | 0,8 m³ |
| IGNI-ST100 | Ignitec Small     | 100 g | 1,4 m³ |
| IGNI-ST150 | Ignitec Smart     | 150 g | 2,1 m³ |
| IGNI-ST250 | Ignitec Compact   | 250 g | 3,4 m³ |
| IGNI-ST500 | Ignitec Standard  | 500 g | 6,8 m³ |
| IGNI-ST1000 | Ignitec Pro      | 1,0 kg | 13,6 m³ |
| IGNI-ST2000 | Ignitec Pro XL   | 2,0 kg | 27,2 m³ |

Pro Produkt:
- Produkt-Name, SKU, Kurzbeschreibung (1 Satz, wird als Karten-Description ausgegeben)
- Beitragsbild (Produkt-Render auf transparentem Hintergrund)
- Attribute (`pa_serie`, `pa_einsatzbereich`, `pa_ausloesung`, `pa_montage`, `pa_norm`) setzen
- Tab "Ignitec Technische Daten": Masse, Volumen, Entladezeit, Abmessungen, Gewicht, Temp.-Bereich
- "Homepage-Highlight" aktivieren bei den 4 Top-Produkten (Mini, Compact, Standard, Pro)
