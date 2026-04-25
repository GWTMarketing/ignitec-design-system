# STEP 2 — Footer (Global)

Kombiniert den **CTA-Strip** (Copper-Gradient, "Gemeinsam auslegen. Ruhig entscheiden.") und den **Footer** (4 Spalten Menü + Logo + Firma + Claim + Copyright) in einem einzigen Code-Widget.

> **Schema/SEO-Hinweis:** Die Schema.org-Markups (Organization, ContactPoint) werden **nicht inline** generiert, sondern global über **Rank Math Pro** (siehe `step-rank-math.md`). Damit gibt es keine Doppelung im DOM.

---

## 1 · Bricks-Template anlegen

**Bricks → Templates → Add New**
- Name: `Ignitec Main Footer`
- Template Type: **Footer**
- Template Conditions: **Entire Website**

Im Template **1 Code-Element** einfügen (Execute code ✅).

## 2 · Nav-Menüs im WP-Admin anlegen

**Design → Menüs** — 4 separate Menüs, jedes wird einem Footer-Slot zugewiesen:

| Menü-Name | Menü-Position (Slot) | Einträge |
|---|---|---|
| Footer Produkt | `footer_produkt` | Serie ST, Zubehör, Konfigurator, Datenblätter |
| Footer Anwendung | `footer_anwendung` | Schaltschrank, BESS, Maschinenraum, Serverraum |
| Footer Unternehmen | `footer_company` | Über, Referenzen, Presse, Karriere |
| Footer Service | `footer_service` | Kontakt, Partner-Portal, Downloads, Legal |

> Die Slots sind in `functions.php` bereits registriert.

---

## 3 · Code-Widget-Inhalt

```php
<?php
/**
 * IGNITEC · CTA-Strip + Footer (Bricks Code Element)
 * · Rendert CTA-Band + 4-Spalten-Footer
 * · Menüs aus WP-Slots (footer_produkt, footer_anwendung, footer_company, footer_service)
 * · Schema.org-Markup wird über Rank Math Pro generiert, nicht inline
 */

$company = [
	'name'    => 'Ignitec GmbH',
	'street'  => 'Michael-Hainisch-Straße 8',
	'zip'     => '2493',
	'city'    => 'Lichtenwörth',
	'country' => 'AT',
	'email'   => 'office@ignitec.at',
	'fn'      => 'FN 651979v',
	'uid'     => 'ATU81975427',
	'url'     => home_url( '/' ),
];

$render_menu = function ( $location ) {
	$locations = get_nav_menu_locations();
	if ( empty( $locations[ $location ] ) ) { return []; }
	$items = wp_get_nav_menu_items( $locations[ $location ] );
	return $items ?: [];
};

$menus = [
	[ 'heading' => 'Produkt',     'items' => $render_menu( 'footer_produkt' ) ],
	[ 'heading' => 'Anwendung',   'items' => $render_menu( 'footer_anwendung' ) ],
	[ 'heading' => 'Unternehmen', 'items' => $render_menu( 'footer_company' ) ],
	[ 'heading' => 'Service',     'items' => $render_menu( 'footer_service' ) ],
];
?>

<section class="ign-cta-strip">
  <div class="ign-cta-strip__inner">
    <div class="ign-cta-strip__copy">
      <span class="eyebrow" style="color:var(--bone);opacity:.85;">PARTNER · PLANER · ENDKUNDE</span>
      <h2 class="ign-cta-strip__h2">
        Gemeinsam auslegen.<br>
        <span class="black">Ruhig entscheiden.</span>
      </h2>
      <p class="ign-cta-strip__p">
        Wir legen das Schutzkonzept gemeinsam mit Ihnen aus — normenkonform nach CEN/TR 15276-1,
        im Regelfall innerhalb von 48 Stunden.
      </p>
    </div>
    <div class="ign-cta-strip__actions">
      <a class="ign-btn ign-btn--bone-on-copper" href="/konfigurator/">Konfigurator starten →</a>
      <a class="ign-btn ign-btn--ghost" href="/partner/">Partner werden</a>
    </div>
  </div>
</section>

<footer class="ign-footer" role="contentinfo">
  <div class="ign-footer__inner">

    <div class="ign-footer__grid">
      <div class="ign-footer__brand">
        <a class="ign-footer__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Ignitec — Startseite">
          <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/logo-full-white.png' ); ?>"
               alt="Ignitec" width="148" height="36" decoding="async">
        </a>
        <address class="ign-footer__address">
          <?php echo esc_html( $company['name'] ); ?><br>
          <?php echo esc_html( $company['street'] ); ?><br>
          A-<?php echo esc_html( $company['zip'] ); ?> <?php echo esc_html( $company['city'] ); ?><br>
          <?php echo esc_html( $company['fn'] . ' · ' . $company['uid'] ); ?>
        </address>
      </div>

      <?php foreach ( $menus as $col ) : ?>
        <div class="ign-footer__col">
          <div class="ign-footer__colhead"><?php echo esc_html( $col['heading'] ); ?></div>
          <ul class="ign-footer__collist">
            <?php foreach ( $col['items'] as $item ) : ?>
              <li>
                <a href="<?php echo esc_url( $item->url ); ?>">
                  <?php echo esc_html( $item->title ); ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="ign-footer__bottom">
      <span class="ign-footer__claim">REACTION · PROTECTION · SOLUTION</span>
      <span class="ign-footer__copy">
        © <?php echo esc_html( date( 'Y' ) ); ?> <?php echo esc_html( $company['name'] ); ?> ·
        <a href="mailto:<?php echo esc_attr( $company['email'] ); ?>"><?php echo esc_html( $company['email'] ); ?></a>
      </span>
    </div>
  </div>
</footer>

<style>
/* ============ CTA STRIP ============ */
.ign-cta-strip {
  background: var(--gradient-copper);
  color: var(--bone);
  padding: 88px 28px;
}
.ign-cta-strip__inner {
  max-width: var(--container-max);
  margin: 0 auto;
  display: grid;
  grid-template-columns: 1.4fr auto;
  gap: 48px;
  align-items: center;
}
.ign-cta-strip__h2 {
  font-family: var(--ff-display);
  font-weight: 600;
  font-size: clamp(36px, 5vw, 56px);
  line-height: 0.98;
  letter-spacing: -0.045em;
  color: var(--bone);
  margin: 12px 0 14px;
}
.ign-cta-strip__h2 .black { font-weight: 900; }
.ign-cta-strip__p {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 17px;
  color: rgba(245,242,236,0.9);
  max-width: 52ch;
  margin: 0;
}
.ign-cta-strip__actions {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.ign-cta-strip__actions .ign-btn { min-width: 240px; }

/* ============ FOOTER ============ */
.ign-footer {
  background: var(--ink-000);
  color: var(--fg-on-dark-2);
  padding: 56px 28px 28px;
}
.ign-footer__inner {
  max-width: var(--container-max);
  margin: 0 auto;
}
.ign-footer__grid {
  display: grid;
  grid-template-columns: 1.4fr 1fr 1fr 1fr 1fr;
  gap: 32px;
}
.ign-footer__logo {
  display: inline-block;
  margin-bottom: 14px;
  text-decoration: none;
}
.ign-footer__logo img {
  display: block;
  height: 30px;
  width: auto;
}
.ign-footer__address {
  font-family: var(--ff-body);
  font-size: 13px;
  line-height: 1.6;
  color: var(--fg-on-dark-3);
  font-style: normal;
}
.ign-footer__colhead {
  font-family: var(--ff-mono);
  font-weight: 500;
  font-size: 10px;
  letter-spacing: 0.26em;
  text-transform: uppercase;
  color: var(--copper-light);
  margin-bottom: 12px;
}
.ign-footer__collist {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.ign-footer__collist a {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 14px;
  color: var(--fg-on-dark-2);
  text-decoration: none;
}
.ign-footer__collist a:hover { color: var(--bone); text-decoration: none; }

.ign-footer__bottom {
  margin-top: 44px;
  padding-top: 20px;
  border-top: 1px solid rgba(245,242,236,0.08);
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 12px;
}
.ign-footer__claim {
  font-family: var(--ff-mono);
  font-size: 11px;
  letter-spacing: 0.2em;
  text-transform: uppercase;
  color: var(--copper-light);
}
.ign-footer__copy {
  font-family: var(--ff-body);
  font-size: 12px;
  color: var(--fg-on-dark-3);
}
.ign-footer__copy a { color: inherit; text-decoration: underline; text-underline-offset: 2px; }
.ign-footer__copy a:hover { color: var(--bone); }

/* ============ RESPONSIVE ============ */
@media (max-width: 960px) {
  .ign-cta-strip__inner { grid-template-columns: 1fr; gap: 32px; }
  .ign-cta-strip__actions { flex-direction: row; flex-wrap: wrap; }
  .ign-cta-strip__actions .ign-btn { min-width: 200px; flex: 1 1 auto; }

  .ign-footer__grid { grid-template-columns: 1fr 1fr; gap: 32px; }
  .ign-footer__brand { grid-column: 1 / -1; }
}
@media (max-width: 560px) {
  .ign-cta-strip { padding: 64px 20px; }
  .ign-footer__grid { grid-template-columns: 1fr; }
  .ign-footer__bottom { flex-direction: column; align-items: flex-start; }
}
</style>
```

---

## 4 · SEO / GEO Notizen

- **Organization-Schema** wird über **Rank Math Pro** zentral generiert, nicht inline (siehe `step-rank-math.md`).
- **Claim-Zeile** ist für LLM-Crawler ideal (kurz, einzigartig, semantisch sichtbar).
- **Adresse** als `<address>`-Tag — zusätzliches Semantik-Signal für Crawler.

## 5 · Verifikation

- [ ] CTA-Strip zeigt Copper-Gradient
- [ ] 2 Buttons: "Konfigurator starten →" (Bone auf Copper) und "Partner werden" (Ghost)
- [ ] Footer dunkel, 4 Spalten + Brand-Spalte
- [ ] Menü-Einträge kommen aus den 4 WP-Menü-Slots
- [ ] Copyright-Jahr dynamisch
- [ ] Mobile: Single-Column, CTA-Actions nebeneinander, Button-Min-Width respektiert
- [ ] Schema-Validierung erfolgt nach Rank-Math-Konfiguration (siehe `step-rank-math.md`)

## 6 · Anpassungspunkte

- **Firmendaten**: Im `$company`-Array am Anfang des Blocks zentral pflegen.
- **CTA-URLs**: `/konfigurator/` und `/partner/` im HTML.
- **Menüs**: Jederzeit über **Design → Menüs** erweiterbar — keine Codeänderung nötig.

---

**Nach Verifikation → STEP 3.1 (Homepage Hero) freigeben.**
