# Widget · Kontaktformular (B2B-Anfrage)

Eigenständiges, wiederverwendbares Bricks-Code-Widget. Sendet eine strukturierte Anfrage via `admin-post.php` → WordPress-Mail an `office@ignitec.at` + Auto-Reply + optionale Brevo-Newsletter-Opt-Ins.

**Wird verwendet in:**
- STEP 3.8 (Homepage Kontakt-Teaser — kompakte Variante)
- STEP 7 (Kontakt-Seite — volle Variante mit allen Feldern)

Die Aufrufvariante wird über die CSS-Klasse `.ign-form--compact` gesteuert (gleicher Code, unterschiedliche Sichtbarkeit).

---

## 1 · Backend ist bereits vorbereitet

In `functions.php` sind bereits registriert:
- Handler `admin_post_ignitec_inquiry` (Abschnitt 9)
- Brevo-API-Helper `ignitec_brevo_subscribe()` (Abschnitt 10)
- Admin-Settings unter **Einstellungen → Ignitec** (Abschnitt 11)

Vor Go-Live:
1. **Einstellungen → Ignitec** öffnen
2. Anfrage-Empfänger prüfen (Default: `office@ignitec.at`)
3. Brevo-API-Key + List-ID eintragen (aus Brevo → SMTP & API)

## 2 · Code-Widget-Inhalt

```php
<?php
/**
 * IGNITEC · Kontaktformular (Bricks Code Element)
 * Vollständig serverseitig validiert via functions.php Handler.
 * JS ist optional — Non-JS-Fallback via Redirect + Query-Param funktioniert.
 */

$action_url = esc_url( admin_url( 'admin-post.php' ) );
$nonce      = wp_create_nonce( 'ignitec_inquiry' );

$select = function ( $name, $label, $options, $required = false ) {
	$req = $required ? ' required' : '';
	$out = sprintf( '<div class="ign-form__field"><label for="ign-%1$s">%2$s%3$s</label><select name="%1$s" id="ign-%1$s"%4$s>',
		esc_attr( $name ), esc_html( $label ), $required ? ' <span aria-hidden="true">*</span>' : '', $req );
	foreach ( $options as $val => $lbl ) {
		$out .= sprintf( '<option value="%s">%s</option>', esc_attr( $val ), esc_html( $lbl ) );
	}
	$out .= '</select></div>';
	return $out;
};

// Benachrichtigungsbanner nach Non-JS-Fallback
$notice = '';
if ( isset( $_GET['ignitec_inquiry'] ) ) {
	if ( $_GET['ignitec_inquiry'] === 'sent' ) {
		$notice = '<div class="ign-form__notice ign-form__notice--ok" role="status">Vielen Dank. Wir melden uns innerhalb von 4 Stunden.</div>';
	} elseif ( $_GET['ignitec_inquiry'] === 'error' ) {
		$notice = '<div class="ign-form__notice ign-form__notice--err" role="alert">Leider gab es einen Fehler. Bitte Pflichtfelder prüfen oder Seite neu laden.</div>';
	}
}
?>

<form class="ign-form" id="ign-form" method="post" action="<?php echo $action_url; ?>" novalidate>

  <?php echo $notice; ?>

  <input type="hidden" name="action" value="ignitec_inquiry">
  <input type="hidden" name="ignitec_nonce" value="<?php echo esc_attr( $nonce ); ?>">

  <!-- Honeypot (unsichtbar, Bots füllen das aus) -->
  <div aria-hidden="true" style="position:absolute;left:-10000px;top:auto;width:1px;height:1px;overflow:hidden;">
    <label>Website<input type="text" name="ignitec_website" tabindex="-1" autocomplete="off"></label>
  </div>

  <fieldset class="ign-form__group">
    <legend>Kontakt</legend>

    <div class="ign-form__row">
      <div class="ign-form__field ign-form__field--inline">
        <label for="ign-anrede">Anrede</label>
        <select name="anrede" id="ign-anrede">
          <option value="">—</option>
          <option value="Frau">Frau</option>
          <option value="Herr">Herr</option>
          <option value="divers">divers</option>
        </select>
      </div>
      <div class="ign-form__field ign-form__field--required">
        <label for="ign-firma">Firma <span aria-hidden="true">*</span></label>
        <input type="text" name="firma" id="ign-firma" autocomplete="organization" required>
      </div>
    </div>

    <div class="ign-form__row">
      <div class="ign-form__field">
        <label for="ign-vorname">Vorname</label>
        <input type="text" name="vorname" id="ign-vorname" autocomplete="given-name">
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
  </fieldset>

  <fieldset class="ign-form__group ign-form__group--project">
    <legend>Projekt</legend>

    <div class="ign-form__row">
      <?php echo $select( 'einsatzbereich', 'Einsatzbereich', [
        ''               => '— wählen —',
        'Schaltschrank'  => 'Schaltschrank',
        'BESS'           => 'BESS / Battery Rack',
        'Maschinenraum'  => 'Maschinenraum',
        'Serverraum'     => 'Serverraum',
        'Fahrzeug'       => 'Fahrzeug',
        'Industrie'      => 'Industrie / Sonstiges',
      ] ); ?>
      <div class="ign-form__field">
        <label for="ign-schutzvolumen">Schutzvolumen (m³)</label>
        <input type="number" name="schutzvolumen" id="ign-schutzvolumen" min="0" step="0.1" inputmode="decimal">
      </div>
    </div>

    <div class="ign-form__row">
      <div class="ign-form__field">
        <label for="ign-temp">Temperaturbereich</label>
        <input type="text" name="temp_bereich" id="ign-temp" placeholder="z. B. −20 … +50 °C">
      </div>
      <?php echo $select( 'ausloesung', 'Auslöse-Art', [
        ''            => '— wählen —',
        'Thermisch'   => 'Thermisch',
        'Elektrisch'  => 'Elektrisch',
        'Dual'        => 'Dual (Thermisch + Elektrisch)',
        'Beratung'    => 'Noch unklar — Beratung gewünscht',
      ] ); ?>
    </div>

    <div class="ign-form__row">
      <?php echo $select( 'zeitrahmen', 'Zeitrahmen', [
        ''             => '— wählen —',
        'sofort'       => 'Sofort',
        '1-3-monate'   => '1–3 Monate',
        '3-6-monate'   => '3–6 Monate',
        'laenger'      => 'Länger als 6 Monate',
        'unbestimmt'   => 'Noch unbestimmt',
      ] ); ?>
      <div class="ign-form__field"></div>
    </div>

    <div class="ign-form__field">
      <label for="ign-nachricht">Nachricht</label>
      <textarea name="nachricht" id="ign-nachricht" rows="5"
        placeholder="Objekt, Anforderungen, offene Fragen…"></textarea>
    </div>
  </fieldset>

  <div class="ign-form__consent">
    <label class="ign-form__checkbox">
      <input type="checkbox" name="consent" value="yes" required>
      <span>Ich habe die <a href="/datenschutz/">Datenschutzerklärung</a> gelesen und willige in die Verarbeitung meiner Daten zur Bearbeitung der Anfrage ein. <span aria-hidden="true">*</span></span>
    </label>
    <label class="ign-form__checkbox">
      <input type="checkbox" name="newsletter" value="yes">
      <span>Ja, ich möchte den Ignitec-Newsletter mit Fachartikeln zu Brandschutz &amp; Normen erhalten. Jederzeit abbestellbar.</span>
    </label>
  </div>

  <div class="ign-form__actions">
    <button type="submit" class="ign-btn ign-btn--primary">Anfrage senden →</button>
    <span class="ign-form__hint">Antwort binnen 4 h (werktags) · Auslegungsdokument binnen 48 h.</span>
  </div>

</form>

<style>
.ign-form {
  display: flex;
  flex-direction: column;
  gap: 28px;
  font-family: var(--ff-body);
  color: var(--fg-1);
}
.ign-form__group {
  border: 1px solid rgba(21,34,52,0.08);
  border-radius: var(--r-4);
  padding: 24px;
  background: var(--bone-50);
  display: flex;
  flex-direction: column;
  gap: 16px;
}
.ign-form__group legend {
  font-family: var(--ff-mono);
  font-weight: 500;
  font-size: 11px;
  letter-spacing: 0.22em;
  text-transform: uppercase;
  color: var(--copper-solid);
  padding: 0 8px;
}
.ign-form__row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
}
.ign-form__field {
  display: flex;
  flex-direction: column;
  gap: 6px;
  min-width: 0;
}
.ign-form__field label {
  font-family: var(--ff-mono);
  font-weight: 500;
  font-size: 11px;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: var(--fg-2);
}
.ign-form__field label span[aria-hidden] { color: var(--copper-solid); }
.ign-form__field input,
.ign-form__field select,
.ign-form__field textarea {
  font-family: var(--ff-body);
  font-weight: 400;
  font-size: 15px;
  line-height: 1.5;
  color: var(--slateblue);
  background: var(--bone);
  border: 1px solid rgba(21,34,52,0.16);
  border-radius: var(--r-3);
  padding: 12px 14px;
  transition: border-color var(--dur-fast) var(--ease-standard),
              box-shadow var(--dur-base) var(--ease-standard);
  width: 100%;
  box-sizing: border-box;
  min-width: 0;
}
.ign-form__field textarea { resize: vertical; }
.ign-form__field input:focus,
.ign-form__field select:focus,
.ign-form__field textarea:focus {
  outline: none;
  border-color: var(--copper-solid);
  box-shadow: var(--shadow-focus);
}
.ign-form__field.ign-form__field--error input,
.ign-form__field.ign-form__field--error select,
.ign-form__field.ign-form__field--error textarea {
  border-color: var(--ember);
  box-shadow: var(--shadow-ember);
}

.ign-form__consent {
  display: flex;
  flex-direction: column;
  gap: 12px;
}
.ign-form__checkbox {
  display: grid;
  grid-template-columns: 20px 1fr;
  gap: 12px;
  align-items: flex-start;
  font-size: 14px;
  line-height: 1.55;
  color: var(--fg-2);
  cursor: pointer;
}
.ign-form__checkbox input {
  width: 18px; height: 18px;
  margin-top: 3px;
  accent-color: var(--copper-solid);
}
.ign-form__checkbox a { color: var(--copper-solid); text-decoration: underline; text-underline-offset: 3px; }

.ign-form__actions {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 16px 20px;
}
.ign-form__actions .ign-btn { min-width: 220px; }
.ign-form__hint {
  font-family: var(--ff-mono);
  font-size: 11px;
  letter-spacing: 0.12em;
  color: var(--fg-3);
}

.ign-form__notice {
  padding: 14px 18px;
  border-radius: var(--r-3);
  font-size: 14px;
  font-weight: 500;
}
.ign-form__notice--ok  { background: #E6F0EA; color: #175132; border: 1px solid #BFDBCC; }
.ign-form__notice--err { background: #FBE6DA; color: #7A2A05; border: 1px solid #F0B898; }

.ign-form.is-submitting { opacity: 0.6; pointer-events: none; }

/* ===== COMPACT-VARIANTE (für Homepage Kontakt-Teaser) ===== */
.ign-form--compact .ign-form__group--project { display: none; }
.ign-form--compact fieldset.ign-form__group legend { display: none; }
.ign-form--compact .ign-form__group { padding: 0; background: transparent; border: 0; }

@media (max-width: 720px) {
  .ign-form__row { grid-template-columns: 1fr; }
}
</style>

<script>
(function () {
  const form = document.getElementById('ign-form');
  if (!form) return;

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
    // Client-seitige Minimal-Validierung (HTML5 required reicht für den Rest)
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

## 3 · SEO/GEO-Notiz

- **Non-JS-Fallback:** Bei deaktiviertem JavaScript funktioniert das Formular trotzdem — Server-Side Redirect mit `?ignitec_inquiry=sent/error`-Query-Param.
- **Server-Side Validation:** Pflichtfelder + Email-Validität + Nonce + Honeypot + Rate-Limit (30 s pro IP).
- **Auto-Reply** stärkt Vertrauen und setzt die 4-h-/48-h-Zusage durch.
- **Keine externen Abhängigkeiten** außer Brevo-API (und die nur, wenn Key konfiguriert ist).

## 4 · Verifikation

- [ ] Mit gesetzter Brevo-Konfig: Opt-In-Haken → Kontakt erscheint in Brevo-Liste
- [ ] Mail an `office@ignitec.at` kommt an, Reply-To ist die Absender-E-Mail
- [ ] Auto-Reply landet in der Inbox des Absenders
- [ ] Nonce-Failure nach 24 h zeigt freundliche Fehlermeldung
- [ ] Honeypot-Bots bekommen "Vielen Dank" (ohne tatsächlichen Mail-Versand)
- [ ] 2×-Submit innerhalb 30 s → Rate-Limit-Hinweis
- [ ] Without JS: POST → Redirect → Banner sichtbar

## 5 · Anpassungspunkte

- **Felder hinzufügen/entfernen:** Im HTML-Form + im `$in = []`-Array in `functions.php` (Abschnitt 9) parallel erweitern.
- **Mail-Format:** In `functions.php` Abschnitt 9 im `$lines`-Array anpassen.
- **Compact-Variante:** Form-Tag bekommt zusätzlich Klasse `ign-form--compact` → Projekt-Fieldset wird ausgeblendet, Fieldset-Wrappers werden unsichtbar.

---

**Wird in STEP 3.8 (Homepage) und STEP 7 (Kontakt-Seite) eingebunden.**
