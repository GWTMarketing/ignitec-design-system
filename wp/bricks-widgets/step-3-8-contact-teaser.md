# STEP 3.8 — Homepage · Kontakt-Teaser (Final CTA)

Kompakter Konversions-Block direkt vor der globalen CTA-Strip (aus STEP 2). Konkreter Unterschied zum globalen CTA: **dieser Block ist praktisch**, mit kompaktem Kontaktformular (Compact-Variante aus `widget-contact-form.md`) — der globale CTA ist emotionaler/brand-orientierter.

Das Formular zeigt hier nur die Kontakt-Grunddaten (Firma, Name, E-Mail, Telefon + Nachricht) und verzichtet auf den Projekt-Block — für die volle Variante leitet ein Link auf `/kontakt/` weiter.

**Hinweis:** Falls die globale CTA-Strip als ausreichend empfunden wird, kann dieser Step übersprungen werden.

---

## 1 · Platzierung

**Bricks → Pages → Startseite** — **8. Section** (letzte Section der Homepage, direkt vor dem globalen Footer). Container Full-Width, darin **1 Code-Element**.

## 2 · Code-Widget-Inhalt

**Hinweis:** Der PHP-Block `<?php … ?>` für das Formular im unteren Abschnitt ist identisch mit dem in `widget-contact-form.md` — hier nur mit zusätzlicher Klasse `ign-form--compact`, damit das Projekt-Fieldset ausgeblendet wird.

```php
<?php
$action_url = esc_url( admin_url( 'admin-post.php' ) );
$nonce      = wp_create_nonce( 'ignitec_inquiry' );
?>

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
          <li><span>1</span> Formular ausfüllen — 2 Minuten</li>
          <li><span>2</span> Rückmeldung &amp; Klärung binnen 4 h</li>
          <li><span>3</span> Auslegungsdokument &amp; Angebot binnen 48 h</li>
        </ul>

        <div class="ign-contact-teaser__direct">
          <div class="label">ODER DIREKT</div>
          <a class="ign-contact-teaser__email" href="mailto:office@ignitec.at?subject=Anfrage%20Aerosol-Auslegung">
            office@ignitec.at
          </a>
        </div>
      </div>

      <div class="ign-contact-teaser__right">
        <form class="ign-form ign-form--compact" id="ign-form" method="post" action="<?php echo $action_url; ?>" novalidate>

          <input type="hidden" name="action" value="ignitec_inquiry">
          <input type="hidden" name="ignitec_nonce" value="<?php echo esc_attr( $nonce ); ?>">
          <div aria-hidden="true" style="position:absolute;left:-10000px;top:auto;width:1px;height:1px;overflow:hidden;">
            <label>Website<input type="text" name="ignitec_website" tabindex="-1" autocomplete="off"></label>
          </div>

          <fieldset class="ign-form__group">
            <legend>Kontakt</legend>
            <div class="ign-form__row">
              <div class="ign-form__field ign-form__field--required">
                <label for="ign-firma">Firma <span aria-hidden="true">*</span></label>
                <input type="text" name="firma" id="ign-firma" autocomplete="organization" required>
              </div>
              <div class="ign-form__field ign-form__field--required">
                <label for="ign-nachname">Nachname <span aria-hidden="true">*</span></label>
                <input type="text" name="nachname" id="ign-nachname" autocomplete="family-name" required>
              </div>
            </div>
            <div class="ign-form__row">
              <div class="ign-form__field ign-form__field--required">
                <label for="ign-email">E-Mail <span aria-hidden="true">*</span></label>
                <input type="email" name="email" id="ign-email" autocomplete="email" required>
              </div>
              <div class="ign-form__field">
                <label for="ign-telefon">Telefon</label>
                <input type="tel" name="telefon" id="ign-telefon" autocomplete="tel">
              </div>
            </div>
            <div class="ign-form__field">
              <label for="ign-nachricht">Kurz zum Vorhaben</label>
              <textarea name="nachricht" id="ign-nachricht" rows="3"
                placeholder="Objekt, Schutzvolumen, offene Fragen…"></textarea>
            </div>
          </fieldset>

          <div class="ign-form__consent">
            <label class="ign-form__checkbox">
              <input type="checkbox" name="consent" value="yes" required>
              <span>Ich habe die <a href="/datenschutz/">Datenschutzerklärung</a> gelesen und willige ein. <span aria-hidden="true">*</span></span>
            </label>
            <label class="ign-form__checkbox">
              <input type="checkbox" name="newsletter" value="yes">
              <span>Fachartikel-Newsletter gelegentlich erhalten. Jederzeit abbestellbar.</span>
            </label>
          </div>

          <div class="ign-form__actions">
            <button type="submit" class="ign-btn ign-btn--primary">Anfrage senden →</button>
            <a class="ign-btn ign-btn--ghost-dark" href="/kontakt/">Volles Formular</a>
          </div>
        </form>
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
  grid-template-columns: 1fr 1.1fr;
  gap: 56px;
  align-items: flex-start;
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

.ign-contact-teaser__direct {
  margin-top: 32px;
  padding-top: 24px;
  border-top: 1px solid rgba(21,34,52,0.08);
}
.ign-contact-teaser__direct .label {
  color: var(--fg-3);
  margin-bottom: 8px;
  display: block;
}
.ign-contact-teaser__email {
  font-family: var(--ff-display);
  font-weight: 600;
  font-size: 22px;
  letter-spacing: -0.02em;
  color: var(--copper-solid);
  text-decoration: none;
}
.ign-contact-teaser__email:hover {
  color: var(--accent-hover);
  text-decoration: none;
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
- **Form-Handler** ist bereits in `functions.php` registriert (Abschnitt 9), inklusive Nonce + Honeypot + Rate-Limit.

## 4 · Verifikation

- [ ] Split-Layout Copy links, Formular rechts
- [ ] E-Mail-Link als Fallback unter den Steps
- [ ] Projekt-Fieldset ist ausgeblendet (Compact-Variante via `ign-form--compact`)
- [ ] Submit → Erfolgs-Banner ersetzt Formular
- [ ] Link "Volles Formular" führt auf `/kontakt/` (STEP 7)
- [ ] Mobile: Single-Column

## 5 · Anpassungspunkte

- **Form-Styles** stammen aus `widget-contact-form.md` — hier nicht erneut abgedruckt. Einbau einmalig im Child-Theme-CSS oder im Homepage-Hero-Code ergänzen.
- **48-h-Versprechen**: Im HTML direkt editierbar, konsistent mit CTA-Strip-Text in STEP 2 halten.
- **Felder:** Um ein weiteres Feld in der Compact-Variante zu zeigen, einfach im HTML hinzufügen — der Handler akzeptiert bereits alle Projektfelder (werden leer gelassen, wenn nicht submittet).

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
