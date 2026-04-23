# Ignitec · WordPress / Bricks / WooCommerce — STEP 0

Theme-Fundament. Muss **vor allen anderen Steps** installiert sein — alle Code-Widgets referenzieren die hier gesetzten CSS-Variablen.

## Inhalt

```
wp/
├── theme/
│   └── ignitec-child/
│       ├── style.css                 ← alle Design-Tokens + Typo + Base-Buttons
│       ├── functions.php             ← Enqueue, WC-Attribute, Meta-Tab, Spec-Render
│       └── fonts/                    ← Archivo-Variablefont hier ablegen
└── README.md                         ← dieses Dokument
```

## 1 · Child-Theme installieren

1. In deiner WordPress-Installation unter `wp-content/themes/` den Ordner `ignitec-child/` anlegen.
2. `wp/theme/ignitec-child/style.css` und `wp/theme/ignitec-child/functions.php` aus diesem Repo dorthin kopieren.
3. Aus dem Design-System die beiden Archivo-Variable-Fonts in `wp-content/themes/ignitec-child/fonts/` ablegen:
   - `Archivo-VariableFont_wdth_wght.ttf`
   - `Archivo-Italic-VariableFont_wdth_wght.ttf`
4. In WordPress: **Design → Themes → Ignitec Child (Bricks) aktivieren**. Bricks muss als Parent installiert und lizenziert sein.

## 2 · WooCommerce-Attribute prüfen

Beim ersten Admin-Aufruf nach Theme-Aktivierung werden die globalen Produkt-Attribute automatisch angelegt (idempotent). Prüfen unter:

**WooCommerce → Produkte → Attribute**

Erwartet:

| Slug | Name | Terms |
|---|---|---|
| `pa_serie` | Serie | ST-50, ST-100, ST-200, ST-400, ST-800, ST-1200, ST-1600 |
| `pa_einsatzbereich` | Einsatzbereich | Schaltschrank, BESS, Maschinenraum, Serverraum, Fahrzeug, Industrie |
| `pa_ausloesung` | Auslösung | Thermisch, Elektrisch, Manuell, Dual |
| `pa_montage` | Montageart | Wand, Decke, Schrankboden, 19-Zoll-Rack |
| `pa_norm` | Norm | CEN/TR 15276-1, ISO 15779, VdS, UL-2775, FM |

Falls die Attribute nicht erscheinen: einmal zu einer Admin-Seite navigieren (der Seed läuft per `admin_init`), oder manuell **Einstellungen → Permalinks → Speichern** aufrufen (flusht Rewrite-Rules).

## 3 · Custom-Tab "Ignitec Technische Daten"

In der Produkt-Edit-Maske erscheint ein neuer Tab neben "Allgemein / Lagerbestand / Versand":

**Ignitec Technische Daten** → 12 Felder:
- Homepage-Highlight (Checkbox)
- Aerosolmasse (g), Schutzvolumen (m³), Entladezeit (s)
- Abmessungen (mm), Gewicht (kg), Temperatur-Bereich
- Lagerzeit (Jahre), GWP, ODP, IP-Schutzart
- Datenblatt-PDF (URL)

Alle Werte sind per Bricks **Dynamic Data** auslesbar:

```
{post_meta:_ignitec_aerosol_masse_g}
{post_meta:_ignitec_schutzvolumen_m3}
…
```

## 4 · Bricks Theme Style anlegen

Bricks → **Settings → Theme Styles → Add Theme Style → "Ignitec Default"**.

Einstellungen (kann 1:1 getippt werden — alles ist auch über CSS-Variablen verfügbar, das Theme-Style spiegelt nur die Defaults):

### Typography
- **Body**: Font `IBM Plex Sans`, Weight `300`, Size `17px`, Line-Height `1.65`, Color `var(--fg-1)` = `#152234`
- **H1**: Font `Archivo`, Weight `600`, Size `clamp(44px, 5.4vw, 78px)`, Line-Height `0.98`, Letter-Spacing `-0.045em`
- **H2**: Font `Archivo`, Weight `500`, Size `clamp(32px, 3.4vw, 52px)`, Line-Height `1.03`, Letter-Spacing `-0.04em`
- **H3**: Font `Archivo`, Weight `500`, Size `clamp(22px, 2.0vw, 32px)`
- **Links**: Color `#793907`, Hover `#6A3206`

### Colors
- **Primary** `#793907` (Copper Solid)
- **Secondary** `#152234` (Slate-Blue)
- **Background** `#F5F2EC` (Bone — NIE reines Weiß)
- **Text** `#152234`
- **Muted** `#6F7A8A`
- **Accent** `#E8622A` (Ember — nur Alarm/Trigger)

### Section
- **Container Max-Width**: `1280px`
- **Container Padding**: `28px`
- **Section Padding Y**: `96px` Desktop / `64px` Mobile

### Button (Primary)
- Background: `linear-gradient(135deg,#6B3410 0%,#C8691E 40%,#F4A962 75%,#FFD8A6 100%)`
- Color: `#F5F2EC`
- Font: Archivo 700 · 15px
- Padding: `14px 22px`
- Radius: `6px`

**Wichtig:** Apply "Ignitec Default" unter **Bricks → Theme Styles → Conditions → Entire Website**.

## 5 · Bricks Code-Execution freischalten

`functions.php` aktiviert den Filter `bricks/code/allow_execution` — zusätzlich muss der Admin-Benutzer unter:

**Bricks → Settings → Builder Access → Code Execution: Administrators** gesetzt sein.

Für produktive Umgebungen empfehle ich, Code-Execution **nur auf Admin-User** zu begrenzen (Standard).

## 6 · Nav-Menüs anlegen

Unter **Design → Menüs** werden 5 Menü-Slots registriert:

- Hauptnavigation (Header)
- Footer · Produkt
- Footer · Anwendung
- Footer · Unternehmen
- Footer · Service

Diese werden in Step 1 (Header) und Step 2 (Footer) referenziert.

## 7 · Verifikation

- [ ] Child-Theme aktiv · keine PHP-Errors (`wp-content/debug.log`)
- [ ] Google Fonts laden im `<head>` (IBM Plex Sans, JetBrains Mono, Poppins)
- [ ] Archivo-Font lädt via Browser-DevTools Network-Tab
- [ ] WooCommerce-Attribute vorhanden (5 Stück, s. Tabelle)
- [ ] Neues Produkt anlegen → Tab "Ignitec Technische Daten" erscheint
- [ ] Bricks Theme Style "Ignitec Default" aktiv auf Entire Website

---

**Nach erfolgreicher Verifikation → STEP 1 (Header) freigeben.**
