# STEP · Borlabs Cookie Konfiguration

Borlabs Cookie ist das DSGVO-konforme Consent-Management. Der Lizenzschlüssel liegt vor (siehe Auftraggeber). Diese Anleitung führt durch die wichtigsten Schritte für Ignitec — Cookie-Banner im Brand-Look, Content-Blocker für eingebettete Drittanbieter, GA4-Integration nach Consent.

---

## 1 · Installation & Lizenz

- [ ] Borlabs Cookie installieren (Plugins → Hochladen → ZIP) + aktivieren
- [ ] Lizenz aktivieren: **Borlabs Cookie → Dashboard → Lizenz**
- [ ] Auto-Update aktivieren (Updates enthalten DSGVO-/EuGH-Anpassungen)

## 2 · Setup-Wizard

- [ ] **Borlabs Cookie → Setup-Wizard** durchklicken
  - Land: **Österreich** · Sprache: **Deutsch (Sie)**
  - Standort des Betreibers: Lichtenwörth, AT
  - Cookie-Box-Modus: **Cookie-Box** (Bottom Bar oder Box je nach Wunsch)
  - Privacy-Policy-Page: `/datenschutz/` (siehe `step-8-legal.md`)
  - Imprint-Page: `/impressum/`

## 3 · Cookie-Gruppen einrichten

**Borlabs → Cookies → Cookie-Gruppen**

Vier Gruppen anlegen (Borlabs liefert Defaults — anpassen):

| Gruppe | Default | Beschreibung |
|---|---|---|
| **Essenziell** | AN (locked) | WordPress Login, Borlabs selbst, Session — technisch notwendig |
| **Statistik** | AUS | Google Analytics 4, Search Console |
| **Marketing** | AUS | bei Launch leer; später Conversion-Pixel |
| **Externe Medien** | AUS | YouTube, Vimeo, Google Maps (falls eingebettet) |

## 4 · Branding im Ignitec-CI

**Borlabs → Cookie-Box → Layout & Design**

### Farben
- [ ] **Header-Background:** `#152234` (Slateblue)
- [ ] **Body-Background:** `#F5F2EC` (Bone) oder `#FBF9F4` (Bone-50)
- [ ] **Accent-Buttons:** `#793907` (Copper-Solid)
- [ ] **Akzept-Button:** Background `#793907`, Hover `#6A3206`
- [ ] **Decline-Button:** transparent mit `#152234`-Border

### Typografie
- [ ] **Headlines:** Archivo, Weight 600
- [ ] **Body:** IBM Plex Sans, Weight 300, 14 px
- [ ] **Buttons:** Archivo, Weight 700

### Custom-CSS (Borlabs → Cookie-Box → Custom-CSS)

```css
.BorlabsCookie ._brlbs-cookie-banner {
  font-family: "IBM Plex Sans", sans-serif;
  font-weight: 300;
}
.BorlabsCookie ._brlbs-cookie-banner h2,
.BorlabsCookie ._brlbs-cookie-banner h3 {
  font-family: "Archivo", sans-serif;
  font-weight: 600;
  letter-spacing: -0.02em;
}
.BorlabsCookie ._brlbs-btn-accept-all,
.BorlabsCookie ._brlbs-btn-accept {
  background: #793907 !important;
  border-color: #793907 !important;
  font-family: "Archivo", sans-serif;
  font-weight: 700;
  border-radius: 6px;
}
.BorlabsCookie ._brlbs-btn-accept-all:hover {
  background: #6A3206 !important;
}
.BorlabsCookie ._brlbs-btn-refuse {
  border-radius: 6px;
}
```

## 5 · GA4-Cookie konfigurieren

**Borlabs → Cookies → Cookies → Add new** (Gruppe: Statistik):

- Name: `Google Analytics 4`
- Service: `Google LLC`
- Cookies: `_ga`, `_ga_*`, `_gid`
- Cookie-Lifetime: 2 Jahre (`_ga`), 1 Tag (`_gid`)
- **Opt-In Code:**

```html
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', 'G-XXXXXXXXXX', {
  anonymize_ip: true,
  cookie_flags: 'SameSite=None;Secure'
});
</script>
```

- [ ] `G-XXXXXXXXXX` durch echte GA4 Measurement-ID ersetzen
- [ ] **Opt-Out Code:** `gtag('consent', 'update', {'analytics_storage': 'denied'});`

## 6 · Content-Blocker

**Borlabs → Content-Blocker** für eingebettete Inhalte:

| Service | Blocker aktiv? | Anwendungsfall |
|---|---|---|
| YouTube | ja, falls genutzt | Video-Embeds |
| Vimeo | ja, falls genutzt | Video-Embeds |
| Google Maps | nein (wir nutzen OpenStreetMap) | — |
| Google reCAPTCHA | ja, falls Form-Spam-Schutz aktiv | Kontaktformular |

→ Ohne Content-Blocker laden iFrames sofort und setzen Drittanbieter-Cookies vor dem Consent — DSGVO-Verstoß.

## 7 · Datenschutz-Text im Banner

**Borlabs → Cookie-Box → Texte**

Kurz-Vorschlag (Platzhalter für Auftraggeber-Anpassung):

> **Headline:** Cookies bei Ignitec
> **Body:** Wir verwenden Cookies, um die Website funktionsfähig zu halten und Ihre Nutzung anonymisiert auszuwerten. Detailinformationen finden Sie in unserer [Datenschutzerklärung](/datenschutz/). Sie können Ihre Auswahl jederzeit unter "Cookie-Einstellungen" im Footer ändern.

## 8 · Footer-Link "Cookie-Einstellungen"

- [ ] Borlabs liefert einen Shortcode: `[borlabs-cookie type="btn-cookie-preference"]Cookie-Einstellungen[/borlabs-cookie]`
- [ ] Diesen Shortcode im Footer (`step-2-footer.md`) im Service-Menü oder als zusätzlicher Link hinterlegen — neben Impressum, Datenschutz, AGB.

## 9 · Datenschutz-Erklärung ergänzen

In der **Datenschutz-Seite** (Germanized-generiert) den Borlabs-Block einfügen:

> Beispiel-Abschnitt: "Diese Website nutzt zur Verwaltung von Cookies und Drittanbieter-Diensten Borlabs Cookie. Borlabs speichert Ihre Consent-Entscheidung in einem Cookie namens `borlabs-cookie`. Anbieter: Borlabs GmbH, Hamburg."

Borlabs liefert dafür im Plugin selbst einen automatisch aktualisierten Hinweis-Block, der per Shortcode `[borlabs-cookie type="cookie-policy"]` eingefügt wird.

## 10 · Verifikation

- [ ] Erstaufruf der Site (Inkognito-Modus): Banner erscheint unten/zentriert
- [ ] Vor Klick auf "Akzeptieren": **keine** GA-Requests im Browser-DevTools (Network-Tab)
- [ ] Nach "Alle akzeptieren": GA4 lädt, `_ga`-Cookie gesetzt
- [ ] Nach "Nur essenziell": **kein** GA-Cookie gesetzt
- [ ] "Cookie-Einstellungen"-Link im Footer öffnet das Borlabs-Panel zur Nachsteuerung
- [ ] Mobile (375 px): Banner ist lesbar, Buttons mit min-44px Tap-Target
- [ ] DSGVO-konform laut Cookiebot-Test oder Local-Storage-Inspektion

## 11 · Wichtig vor Go-Live

- [ ] Banner-Text vom Auftraggeber freigegeben
- [ ] Datenschutz-Seite enthält Borlabs-Hinweis
- [ ] GA4-Tracking funktioniert nach Consent
- [ ] Lighthouse Accessibility ≥ 95 (Borlabs-Banner darf keine A11y-Fehler erzeugen)

---

**Hinweis:** Borlabs Cookie ist DSGVO-Konformität nach aktuellem Stand. Bei EuGH-Urteilen oder neuen ePrivacy-Vorgaben Plugin updaten und Datenschutz-Texte prüfen lassen.
