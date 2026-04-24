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

- [ ] Im Repo den Ordner `wp/theme/ignitec-child/` als **ZIP packen** (style.css + functions.php)
- [ ] Archivo-Fonts aus dem Design-System in den ZIP-Ordner `ignitec-child/fonts/` legen:
  - `Archivo-VariableFont_wdth_wght.ttf`
  - `Archivo-Italic-VariableFont_wdth_wght.ttf`
- [ ] WP-Admin → Design → Themes → Neues Theme → Hochladen → ZIP wählen → Installieren
- [ ] **"Ignitec Child (Bricks)" aktivieren**
- [ ] Kontrolle: Design → Themes zeigt "Ignitec Child (Bricks)" als aktiv

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

## TEIL 9 · Homepage bauen (STEP 3.1 bis 3.8) · 60 Min

Die Seite "Start" mit Bricks öffnen. **8 Sections** sequenziell einfügen, in jeder 1 Code-Element mit Execute-code.

- [ ] **Section 1 — Hero** · Inhalt aus `step-3-1-hero.md`
- [ ] **Section 2 — Stat Bar** · Inhalt aus `step-3-2-statbar.md`
- [ ] **Section 3 — Produkt-Highlights** · Inhalt aus `step-3-3-product-highlights.md`
      *(zeigt leeren Zustand — OK, füllt sich ab STEP 4)*
- [ ] **Section 4 — Anwendungen** · Inhalt aus `step-3-4-applications.md`
- [ ] **Section 5 — Technologie-USP** · Inhalt aus `step-3-5-technology-usp.md`
- [ ] **Section 6 — Prozess** · Inhalt aus `step-3-6-process.md`
- [ ] **Section 7 — FAQ** · Inhalt aus `step-3-7-faq.md`
- [ ] **Section 8 — Kontakt-Teaser** · Inhalt aus `step-3-8-contact-teaser.md`
- [ ] Speichern → Frontend `/` prüfen → Alle 8 Sections sichtbar
- [ ] Responsive-Check: 375 / 768 / 1440 px

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

Dafür brauchst du dann mindestens ein paar **echte Produkte** in WooCommerce:
- Produkt-Name, SKU, Kurzbeschreibung
- Beitragsbild
- Attribute (serie, einsatzbereich, ausloesung, montage, norm) setzen
- Tab "Ignitec Technische Daten" ausfüllen (Masse, Volumen, Entladezeit, etc.)
- Homepage-Highlight aktivieren bei 6 Top-Produkten
