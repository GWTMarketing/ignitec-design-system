# STEP 3.8 — Homepage · Direktkontakt-Formular

Aktive Konversions-Sektion direkt nach dem CTA: links Eyebrow + H2 + Lead, rechts ein **kompaktes Kontaktformular**. Verwendet den bereits in `functions.php` §8 registrierten `admin-post.php`-Handler — kein zusätzliches Plugin.

**Position:** Nach `step-3-7-cta.md`, vor `step-3-9-faq.md` auf der Startseite.

**Unterschied zur CTA-Section (3.7):** 3.7 ist Marketing-Closing mit Direktkontakt-Daten als Glass-Card. 3.8 ist die **handelnde** Sektion — User trägt Daten ein, klickt absenden, bekommt Auto-Reply.

---

## 1 · Voraussetzung

In `functions.php` müssen folgende Abschnitte aktiv sein:
- §8 Kontakt-Formular-Handler (`admin_post_ignitec_inquiry`)
- §9 Brevo (optional, für Newsletter-Opt-In)
- §10 Admin-Settings (Anfrage-Empfänger pflegen)

Die globalen Form-Styles `.ign-form*` aus `widget-contact-form.md` müssen einmalig im Theme oder im ersten Form-Widget eingebaut sein. Wenn die Kontakt-Seite (STEP 7) noch nicht live ist, sind die Styles unten im Block noch einmal komplett hinterlegt.

## 2 · Platzierung

**Bricks → Pages → Startseite** — **8. Section** unter dem CTA. Container Full-Width, **1 Code-Element** (Execute code ✅).

## 3 · Code-Widget-Inhalt

```php
<?php
$action_url = esc_url( admin_url( 'admin-post.php' ) );
$nonce      = wp_create_nonce( 'ignitec_inquiry' );
?>

<section class="ign-home-contact ign-section" aria-labelledby="ign-home-contact-head">
  <div class="ign-container ign-home-contact__inner">

    <div class="ign-home-contact__copy">
      <span class="eyebrow">Schneller Draht</span>
      <h2 id="ign-home-contact-head" class="ign-home-contact__h2">
        Schreiben Sie uns —<br>
        <em class="ign-home-contact__h2-accent">wir antworten.</em>
      </h2>
      <p class="ign-home-contact__lead">
        Schicken Sie uns Schutzvolumen, Einsatzfeld und Auslöseart.
        Wir empfehlen die passende Generatorgröße und liefern Datenblatt
        plus Erstangebot innerhalb von zwei Werktagen.
      </p>

      <ul class="ign-home-contact__bullets">
        <li><strong>≤ 4 h</strong> Erstantwort werktags</li>
        <li><strong>≤ 48 h</strong> Datenblatt &amp; Angebot</li>
        <li><strong>0 €</strong> Erstberatung</li>
      </ul>

      <div class="ign-home-contact__alt">
        Lieber direkt? <a href="mailto:office@ignitec.at?subject=Anfrage%20Aerosol-Auslegung">office@ignitec.at</a>
      </div>
    </div>

    <form class="ign-form ign-form--compact" id="ign-form-home" method="post" action="<?php echo $action_url; ?>" novalidate>

      <input type="hidden" name="action" value="ignitec_inquiry">
      <input type="hidden" name="ignitec_nonce" value="<?php echo esc_attr( $nonce ); ?>">
      <div aria-hidden="true" style="position:absolute;left:-10000px;top:auto;width:1px;height:1px;overflow:hidden;">
        <label>Website<input type="text" name="ignitec_website" tabindex="-1" autocomplete="off"></label>
      </div>

      <fieldset class="ign-form__group">
        <legend>Anfrage</legend>

        <div class="ign-form__row">
          <div class="ign-form__field ign-form__field--required">
            <label for="ign-h-firma">Firma <span aria-hidden="true">*</span></label>
            <input type="text" name="firma" id="ign-h-firma" autocomplete="organization" required>
          </div>
          <div class="ign-form__field ign-form__field--required">
            <label for="ign-h-nachname">Nachname <span aria-hidden="true">*</span></label>
            <input type="text" name="nachname" id="ign-h-nachname" autocomplete="family-name" required>
          </div>
        </div>

        <div class="ign-form__row">
          <div class="ign-form__field ign-form__field--required">
            <label for="ign-h-email">E-Mail <span aria-hidden="true">*</span></label>
            <input type="email" name="email" id="ign-h-email" autocomplete="email" required>
          </div>
          <div class="ign-form__field">
            <label for="ign-h-telefon">Telefon</label>
            <input type="tel" name="telefon" id="ign-h-telefon" autocomplete="tel">
          </div>
        </div>

        <div class="ign-form__row">
          <div class="ign-form__field">
            <label for="ign-h-einsatzbereich">Einsatzbereich</label>
            <select name="einsatzbereich" id="ign-h-einsatzbereich">
              <option value="">— wählen —</option>
              <option>Schaltschrank</option>
              <option>BESS</option>
              <option>Maschinenraum</option>
              <option>Serverraum</option>
              <option>Fahrzeug</option>
              <option>Industrie</option>
            </select>
          </div>
          <div class="ign-form__field">
            <label for="ign-h-schutzvolumen">Schutzvolumen (m³)</label>
            <input type="number" name="schutzvolumen" id="ign-h-schutzvolumen" min="0" step="0.1" inputmode="decimal">
          </div>
        </div>

        <div class="ign-form__field">
          <label for="ign-h-nachricht">Kurz zum Vorhaben</label>
          <textarea name="nachricht" id="ign-h-nachricht" rows="3"
            placeholder="Objekt, Auslöseart, offene Fragen…"></textarea>
        </div>
      </fieldset>

      <div class="ign-form__consent">
        <label class="ign-form__checkbox">
          <input type="checkbox" name="consent" value="yes" required>
          <span>Ich habe die <a href="/datenschutz/">Datenschutzerklärung</a> gelesen und willige ein. <span aria-hidden="true">*</span></span>
        </label>
      </div>

      <div class="ign-form__actions">
        <button type="submit" class="ign-btn ign-btn--primary">Anfrage senden →</button>
        <a class="ign-btn ign-btn--ghost-dark" href="/kontakt/">Volles Formular &amp; Adresse</a>
      </div>
    </form>

  </div>
</section>

<style>
.ign-home-contact {
  background: var(--bone);
  border-top: 1px solid rgba(21,34,52,0.08);
}
.ign-home-contact__inner {
  display: grid;
  grid-template-columns: 1fr 1.2fr;
  gap: 64px;
  align-items: start;
}

.ign-home-contact__h2 {
  font-family: var(--ff-display);
  font-weight: 500;
  font-size: clamp(32px, 4vw, 48px);
  line-height: 1.03;
  letter-spacing: -0.04em;
  color: var(--slateblue);
  margin: 12px 0 18px;
}
.ign-home-contact__h2-accent {
  font-family: var(--ff-display);
  font-style: italic;
  font-weight: 500;
  background: linear-gradient(92deg, #793907 0%, #C8691E 100%);
  -webkit-background-clip: text;
  background-clip: text;
  -webkit-text-fill-color: transparent;
  color: transparent;
}
.ign-home-contact__lead {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 17px;
  line-height: 1.55;
  color: var(--fg-2);
  max-width: 48ch;
  margin: 0 0 28px;
}
.ign-home-contact__bullets {
  list-style: none;
  padding: 0;
  margin: 0 0 28px;
  display: flex;
  flex-direction: column;
  gap: 10px;
  font-family: var(--ff-body);
  font-size: 15px;
  color: var(--fg-2);
}
.ign-home-contact__bullets li {
  padding-left: 22px;
  position: relative;
}
.ign-home-contact__bullets li::before {
  content: "→";
  position: absolute;
  left: 0;
  color: var(--copper-solid);
  font-family: var(--ff-display);
  font-weight: 600;
}
.ign-home-contact__bullets strong {
  color: var(--slateblue);
  font-family: var(--ff-display);
  font-weight: 700;
  margin-right: 8px;
}
.ign-home-contact__alt {
  font-family: var(--ff-body);
  font-size: 14px;
  color: var(--fg-3);
  padding-top: 20px;
  border-top: 1px solid rgba(21,34,52,0.08);
}
.ign-home-contact__alt a {
  color: var(--copper-solid);
  font-family: var(--ff-display);
  font-weight: 600;
  text-decoration: none;
}
.ign-home-contact__alt a:hover { color: var(--accent-hover); text-decoration: underline; }

@media (max-width: 960px) {
  .ign-home-contact__inner { grid-template-columns: 1fr; gap: 32px; }
}
</style>

<style>
/* ============= GLOBALE FORM-STYLES =============
   Wenn bereits über widget-contact-form.md oder step-7-contact.md
   im DOM, kann dieser Block ohne Folgen bleiben (CSS dedupliziert).
   ============================================== */
.ign-form { display: flex; flex-direction: column; gap: 22px; font-family: var(--ff-body); color: var(--fg-1); }
.ign-form__group { border: 1px solid rgba(21,34,52,0.08); border-radius: var(--r-4); padding: 24px; background: var(--bone-50); display: flex; flex-direction: column; gap: 14px; }
.ign-form__group legend { font-family: var(--ff-mono); font-weight: 500; font-size: 11px; letter-spacing: 0.22em; text-transform: uppercase; color: var(--copper-solid); padding: 0 8px; }
.ign-form__row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
.ign-form__field { display: flex; flex-direction: column; gap: 6px; min-width: 0; }
.ign-form__field label { font-family: var(--ff-mono); font-weight: 500; font-size: 11px; letter-spacing: 0.14em; text-transform: uppercase; color: var(--fg-2); }
.ign-form__field label span[aria-hidden] { color: var(--copper-solid); }
.ign-form__field input,
.ign-form__field select,
.ign-form__field textarea {
  font-family: var(--ff-body); font-weight: 400; font-size: 15px; line-height: 1.5;
  color: var(--slateblue); background: var(--bone);
  border: 1px solid rgba(21,34,52,0.16); border-radius: var(--r-3); padding: 12px 14px;
  transition: border-color var(--dur-fast) var(--ease-standard), box-shadow var(--dur-base) var(--ease-standard);
  width: 100%; box-sizing: border-box; min-width: 0;
}
.ign-form__field textarea { resize: vertical; }
.ign-form__field input:focus,
.ign-form__field select:focus,
.ign-form__field textarea:focus { outline: none; border-color: var(--copper-solid); box-shadow: var(--shadow-focus); }
.ign-form__field--error input,
.ign-form__field--error select,
.ign-form__field--error textarea { border-color: var(--ember); box-shadow: var(--shadow-ember); }

.ign-form__consent { display: flex; flex-direction: column; gap: 10px; }
.ign-form__checkbox { display: grid; grid-template-columns: 20px 1fr; gap: 12px; align-items: flex-start; font-size: 14px; line-height: 1.55; color: var(--fg-2); cursor: pointer; }
.ign-form__checkbox input { width: 18px; height: 18px; margin-top: 3px; accent-color: var(--copper-solid); }
.ign-form__checkbox a { color: var(--copper-solid); text-decoration: underline; text-underline-offset: 3px; }

.ign-form__actions { display: flex; flex-wrap: wrap; align-items: center; gap: 12px; }

.ign-form__notice { padding: 14px 18px; border-radius: var(--r-3); font-size: 14px; font-weight: 500; }
.ign-form__notice--ok  { background: #E6F0EA; color: #175132; border: 1px solid #BFDBCC; }
.ign-form__notice--err { background: #FBE6DA; color: #7A2A05; border: 1px solid #F0B898; }
.ign-form.is-submitting { opacity: 0.6; pointer-events: none; }

@media (max-width: 720px) {
  .ign-form__row { grid-template-columns: 1fr; }
}
</style>

<script>
(function () {
  const form = document.getElementById('ign-form-home');
  if (!form) return;
  if (form.dataset.bound) return;
  form.dataset.bound = '1';

  const notice = () => {
    let n = form.querySelector('.ign-form__notice');
    if (!n) {
      n = document.createElement('div');
      n.className = 'ign-form__notice';
      n.setAttribute('role', 'status');
      form.prepend(n);
    }
    return n;
  };
  const setErr = (names) => {
    form.querySelectorAll('.ign-form__field--error').forEach(el => el.classList.remove('ign-form__field--error'));
    (names || []).forEach(n => {
      const input = form.querySelector(`[name="${n}"]`);
      if (input) input.closest('.ign-form__field')?.classList.add('ign-form__field--error');
    });
  };
  form.addEventListener('submit', async (e) => {
    if (!form.checkValidity()) return;
    e.preventDefault();
    form.classList.add('is-submitting');
    const n = notice();
    n.textContent = 'Wird gesendet…';
    n.className = 'ign-form__notice';
    try {
      const res = await fetch(form.action, {
        method: 'POST',
        body: new FormData(form),
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        credentials: 'same-origin',
      });
      const data = await res.json();
      if (data.ok) {
        form.innerHTML = `
          <div class="ign-form__notice ign-form__notice--ok" role="status">
            <strong>${data.message || 'Vielen Dank.'}</strong><br>
            Ihre Nachricht liegt bei uns. Sie erhalten eine Bestätigung per E-Mail.
          </div>`;
        form.scrollIntoView({ behavior: 'smooth', block: 'center' });
      } else {
        setErr(data.fields);
        n.className = 'ign-form__notice ign-form__notice--err';
        n.textContent = data.message || 'Bitte Pflichtfelder prüfen.';
      }
    } catch (err) {
      n.className = 'ign-form__notice ign-form__notice--err';
      n.textContent = 'Netzwerk-Fehler. Bitte später erneut versuchen.';
    } finally {
      form.classList.remove('is-submitting');
    }
  });
})();
</script>
```

---

## 4 · Verifikation

- [ ] Section sitzt nach CTA-Sektion und vor FAQ (oder vor Footer, wenn FAQ ausgespart)
- [ ] Submit funktioniert → Mail kommt an `office@ignitec.at` an
- [ ] Auto-Reply landet bei der Absender:in
- [ ] Bei Fehler: Pflichtfelder werden rot markiert
- [ ] Mobile: Single-Column, Bullets bleiben links angeordnet
- [ ] "Volles Formular & Adresse" linkt auf `/kontakt/`

## 5 · Anpassungspunkte

- **Headline und Bullets** im HTML editierbar
- **Form-Felder** identisch mit `widget-contact-form.md` Compact-Variante — bei Bedarf weitere Pflichtfelder
- **`mailto:office@ignitec.at?subject=…`** Subject anpassbar
