# STEP 3.8 — Homepage · Kontakt-Teaser (Final CTA)

Kompakter Konversions-Block direkt vor der globalen CTA-Strip (aus STEP 2). Konkreter Unterschied zum globalen CTA: **dieser Block ist praktisch**, mit direkter Kontaktzeile + Email + 48-h-Versprechen — der globale CTA ist emotionaler/brand-orientierter.

Kein Formular in diesem Step — wir warten auf die Plugin-Entscheidung (Contact Form 7 / Fluent Forms Free). Sobald entschieden, lässt sich der Shortcode einfach austauschen.

**Hinweis:** Falls die globale CTA-Strip als ausreichend empfunden wird, kann dieser Step übersprungen werden.

---

## 1 · Platzierung

**Bricks → Pages → Startseite** — **8. Section** (letzte Section der Homepage, direkt vor dem globalen Footer). Container Full-Width, darin **1 Code-Element**.

## 2 · Code-Widget-Inhalt

```html
<section class="ign-contact-teaser ign-section" aria-labelledby="ign-contact-teaser-head">
  <div class="ign-container">
    <div class="ign-contact-teaser__box">

      <div class="ign-contact-teaser__left">
        <span class="eyebrow">ANGEBOT · 48 H</span>
        <h2 id="ign-contact-teaser-head" class="ign-contact-teaser__h2">
          Schutzkonzept an Ihrem Objekt — <span class="black">innerhalb von zwei Tagen.</span>
        </h2>
        <p class="ign-contact-teaser__p">
          Wir benötigen Schutzvolumen, Betriebstemperatur und Auslöse-Art.
          Den Rest machen wir. Normenkonform nach CEN/TR 15276-1.
        </p>

        <ul class="ign-contact-teaser__steps">
          <li><span>1</span> Anfrage formlos per E-Mail oder Konfigurator</li>
          <li><span>2</span> Rückmeldung &amp; Klärung offener Punkte binnen 4 h</li>
          <li><span>3</span> Auslegungsdokument &amp; Angebot binnen 48 h</li>
        </ul>
      </div>

      <div class="ign-contact-teaser__right">
        <div class="ign-contact-teaser__card">
          <div class="ign-contact-teaser__direct">
            <div class="label">DIREKT</div>
            <a class="ign-contact-teaser__email" href="mailto:office@ignitec.at?subject=Anfrage%20Aerosol-Auslegung">
              office@ignitec.at
            </a>
            <div class="ign-contact-teaser__addr">
              Ignitec GmbH · Michael-Hainisch-Straße 8 · 2493 Lichtenwörth
            </div>
          </div>

          <div class="ign-contact-teaser__actions">
            <a class="ign-btn ign-btn--primary" href="/konfigurator/">Konfigurator starten →</a>
            <a class="ign-btn ign-btn--ghost-dark" href="/kontakt/">Zum Kontaktformular</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<style>
.ign-contact-teaser {
  background: var(--bone-100);
}
.ign-contact-teaser__box {
  display: grid;
  grid-template-columns: 1.2fr 1fr;
  gap: 56px;
  align-items: center;
  background: var(--bone);
  border-radius: var(--r-5);
  padding: 56px;
  box-shadow: var(--shadow-3);
  border: 1px solid rgba(21,34,52,0.05);
}
.ign-contact-teaser__h2 {
  font-family: var(--ff-display);
  font-weight: 500;
  font-size: clamp(28px, 3.4vw, 40px);
  line-height: 1.05;
  letter-spacing: -0.035em;
  color: var(--slateblue);
  margin: 10px 0 14px;
}
.ign-contact-teaser__h2 .black { font-weight: 900; }
.ign-contact-teaser__p {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 17px;
  line-height: 1.55;
  color: var(--fg-2);
  max-width: 54ch;
  margin: 0 0 24px;
}

.ign-contact-teaser__steps {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.ign-contact-teaser__steps li {
  display: grid;
  grid-template-columns: 28px 1fr;
  gap: 14px;
  align-items: center;
  font-family: var(--ff-body);
  font-weight: 400;
  font-size: 15px;
  color: var(--slateblue);
}
.ign-contact-teaser__steps li span {
  width: 28px; height: 28px;
  border-radius: 50%;
  background: var(--slateblue);
  color: var(--bone);
  font-family: var(--ff-mono);
  font-weight: 500;
  font-size: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.ign-contact-teaser__card {
  background: var(--ink-000);
  color: var(--bone);
  border-radius: var(--r-4);
  padding: 32px;
  position: relative;
  overflow: hidden;
}
.ign-contact-teaser__card::before {
  content: "";
  position: absolute;
  top: -80px; right: -80px;
  width: 220px; height: 220px;
  background: radial-gradient(circle, rgba(208,110,61,0.24) 0%, rgba(208,110,61,0) 70%);
  pointer-events: none;
}
.ign-contact-teaser__direct { margin-bottom: 26px; position: relative; z-index: 1; }
.ign-contact-teaser__direct .label { color: var(--copper-light); margin-bottom: 10px; }
.ign-contact-teaser__email {
  display: block;
  font-family: var(--ff-display);
  font-weight: 600;
  font-size: 26px;
  letter-spacing: -0.02em;
  color: var(--bone);
  text-decoration: none;
  margin-bottom: 12px;
}
.ign-contact-teaser__email:hover {
  color: var(--copper-light);
  text-decoration: none;
}
.ign-contact-teaser__addr {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 13px;
  color: var(--fg-on-dark-3);
  line-height: 1.55;
}
.ign-contact-teaser__actions {
  display: flex;
  flex-direction: column;
  gap: 10px;
  position: relative;
  z-index: 1;
}
.ign-contact-teaser__actions .ign-btn--ghost-dark {
  color: var(--bone);
  border-color: rgba(245,242,236,0.35);
}
.ign-contact-teaser__actions .ign-btn--ghost-dark:hover {
  background: rgba(245,242,236,0.08);
  color: var(--bone);
  border-color: var(--bone);
}

@media (max-width: 960px) {
  .ign-contact-teaser__box {
    grid-template-columns: 1fr;
    padding: 36px;
    gap: 36px;
  }
}
@media (max-width: 560px) {
  .ign-contact-teaser__box { padding: 28px; }
}
</style>
```

---

## 3 · SEO/GEO-Notiz

- **Email-Link** mit vorbefülltem Subject (`mailto:?subject=…`) senkt die Einstiegshürde.
- **3-Step-Prozess** wiederholt die wichtigsten Zahlen ("binnen 4 h", "48 h") — LLMs nehmen konkrete Zeitangaben gern auf.
- **Strukturierte Adresse** bleibt im Footer-JSON-LD referenziert (aus STEP 2).

## 4 · Verifikation

- [ ] Split-Layout Copy links, dunkle Kontaktkarte rechts
- [ ] E-Mail-Link öffnet Mail-Client mit vorbefülltem Subject
- [ ] Konfigurator-CTA als Primary, Kontaktformular-CTA als Ghost (auf dunklem Grund)
- [ ] 3 Steps mit Slate-Blue-Nummern-Kreisen
- [ ] Mobile: Single-Column mit kleinerem Padding

## 5 · Anpassungspunkte

- **Wenn Kontaktformular-Plugin gewählt (Contact Form 7 / Fluent Forms)**, kann die dunkle Kontaktkarte ersetzt werden durch den jeweiligen Shortcode, z. B.:
  ```html
  <?php echo do_shortcode( '[contact-form-7 id="12" title="Anfrage"]' ); ?>
  ```
- **48-h-Versprechen**: Im HTML direkt editierbar, konsistent mit CTA-Strip-Text in STEP 2 halten.
- **Direkt-Email-Subject**: `subject=Anfrage%20Aerosol-Auslegung` jederzeit änderbar.

---

## 6 · Homepage-Bau abgeschlossen

Damit sind alle 8 Homepage-Sektionen ausgeliefert:

1. ✅ Hero · Spark-Canvas
2. ✅ Stat Bar · 5 Kennzahlen
3. ✅ Produkt-Highlights · WooCommerce-dynamisch
4. ✅ Anwendungen · 4 Use-Cases
5. ✅ Technologie-USP · 4 Argumente + Visual
6. ✅ Prozess · 4-Step Timeline + HowTo-JSON-LD
7. ✅ FAQ · 6 Q&A + FAQPage-JSON-LD
8. ✅ Kontakt-Teaser · 48-h-Versprechen

**Nächster freigabefähiger Step: STEP 4 (Shop-Archiv) oder STEP 5 (Produkt-Single).**
