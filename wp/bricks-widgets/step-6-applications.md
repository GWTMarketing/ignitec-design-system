# STEP 6 — Anwendungs-Seiten (CPT `ignitec_application`)

Custom Post Type für redaktionelle Anwendungs-Seiten (BESS, Schaltschrank, Maschinenraum, Serverraum, …). URL-Struktur: `/anwendungen/<slug>/`. Archiv: `/anwendungen/`.

**Architektur:**
- Ein CPT-Eintrag = eine Anwendungs-Seite mit Hero, redaktionellem Text, Use-Case-Beschreibung.
- Produkte werden dynamisch per `pa_einsatzbereich`-Filter-Term unten angezeigt — kein doppeltes Pflegen.
- Meta-Felder (Lead-Text, Volumen-Range, Risiko-Text, Filter-Term) sind in der CPT-Edit-Maske verfügbar.

**Voraussetzung:** CPT ist in `functions.php` (Abschnitt 8) bereits registriert. Nach erstem Laden der Admin-Seite einmal **Einstellungen → Permalinks → Speichern** für Rewrite-Rules.

---

## 1 · Anwendungs-Einträge anlegen

**WP-Admin → Anwendungen → Neu erstellen** für jede Branche/Use-Case. Empfohlen für Go-Live:

| Titel | Slug | Filter-Term (`_ignitec_app_filter_term`) | Volume-Range |
|---|---|---|---|
| Schaltschrank-Brandschutz | schaltschrank | schaltschrank | 0,3 – 2,5 m³ |
| BESS-Brandschutz | bess | bess | 1 – 5 m³ pro Rack |
| Maschinenraum-Brandschutz | maschinenraum | maschinenraum | 2 – 5 m³ |
| Serverraum-Brandschutz | serverraum | serverraum | 1 – 5 m³ |
| Fahrzeug-Brandschutz | fahrzeug | fahrzeug | 0,3 – 1,5 m³ |

In jedem Eintrag:
- **Titel** = H1 der Single-Seite (SEO-optimiert: "BESS-Brandschutz — Aerosol-Löschanlage für Battery Storage")
- **Editor-Inhalt** = redaktioneller Haupttext (wird in der Mitte ausgegeben)
- **Beitragsbild** = Hero-Image rechts
- **Auszug** = Meta-Description für SEO
- **Meta-Box "Ignitec Anwendungs-Daten"**: Lead, Volume-Range, Risiko, Filter-Term

## 2 · Bricks-Single-Template anlegen

**Bricks → Templates → Add New**
- Name: `Single Anwendung`
- Template Type: **Single**
- Conditions: **Post Type: Anwendungen**

Im Template **1 Section Full-Width** → darin **1 Code-Element** (Execute code ✅).

## 3 · Code-Widget-Inhalt (Single Anwendungs-Seite)

```php
<?php
/**
 * IGNITEC · Single Anwendung (CPT ignitec_application)
 * Hero → Lead → Editor-Content → Risiken → Passende Produkte (Query-Loop) → CTA
 */
if ( ! have_posts() ) { return; }
the_post();

$pid          = get_the_ID();
$lead         = get_post_meta( $pid, '_ignitec_app_lead', true );
$volume_range = get_post_meta( $pid, '_ignitec_app_volume_range', true );
$risk_text    = get_post_meta( $pid, '_ignitec_app_risk', true );
$filter_term  = get_post_meta( $pid, '_ignitec_app_filter_term', true );
$thumb        = get_the_post_thumbnail_url( $pid, 'large' );
?>

<section class="ign-app-hero">
  <div class="ign-container ign-app-hero__inner">
    <div class="ign-app-hero__copy">
      <nav class="ign-app-hero__crumbs" aria-label="Breadcrumb">
        <a href="/">Start</a> <span>/</span> <a href="/anwendungen/">Anwendungen</a>
      </nav>
      <span class="eyebrow">ANWENDUNG</span>
      <h1 class="ign-app-hero__h1"><?php the_title(); ?></h1>
      <?php if ( $lead ) : ?>
        <p class="ign-app-hero__lead"><?php echo esc_html( $lead ); ?></p>
      <?php endif; ?>

      <?php if ( $volume_range ) : ?>
        <dl class="ign-app-hero__facts">
          <div>
            <dt>Typisches Volumen</dt>
            <dd><?php echo esc_html( $volume_range ); ?></dd>
          </div>
          <div>
            <dt>Reaktionszeit</dt>
            <dd>≤ 20 s</dd>
          </div>
          <div>
            <dt>GWP · ODP</dt>
            <dd>0 · 0</dd>
          </div>
          <div>
            <dt>Norm</dt>
            <dd>CEN/TR 15276-1</dd>
          </div>
        </dl>
      <?php endif; ?>
    </div>

    <?php if ( $thumb ) : ?>
      <div class="ign-app-hero__visual" style="background-image: url('<?php echo esc_url( $thumb ); ?>');" role="img" aria-label="<?php echo esc_attr( get_the_title() ); ?>"></div>
    <?php else : ?>
      <div class="ign-app-hero__visual ign-app-hero__visual--placeholder" aria-hidden="true">
        <div class="ign-app-hero__mark"></div>
      </div>
    <?php endif; ?>
  </div>
</section>

<section class="ign-app-body ign-section">
  <div class="ign-container ign-app-body__inner">
    <article class="ign-app-body__prose">
      <?php the_content(); ?>
    </article>

    <?php if ( $risk_text ) : ?>
      <aside class="ign-app-body__risk">
        <span class="eyebrow">TYPISCHE RISIKEN</span>
        <p><?php echo esc_html( $risk_text ); ?></p>
      </aside>
    <?php endif; ?>
  </div>
</section>

<?php
// Passende Produkte (Query nach pa_einsatzbereich-Term-Slug)
$products = [];
if ( $filter_term ) {
	$q = new WP_Query( [
		'post_type'      => 'product',
		'posts_per_page' => 6,
		'orderby'        => [ 'meta_value_num' => 'ASC', 'menu_order' => 'ASC' ],
		'meta_key'       => '_ignitec_aerosol_masse_g',
		'tax_query'      => [
			[
				'taxonomy' => 'pa_einsatzbereich',
				'field'    => 'slug',
				'terms'    => $filter_term,
			],
		],
	] );
	if ( $q->have_posts() ) { $products = $q->posts; }
	wp_reset_postdata();
}
?>

<?php if ( $products ) : ?>
<section class="ign-app-products ign-section">
  <div class="ign-container">
    <span class="eyebrow">PASSENDE GERÄTE</span>
    <h2 class="ign-app-products__h2">Für <?php echo esc_html( get_the_title() ); ?> empfohlen.</h2>

    <div class="ign-app-products__grid">
      <?php foreach ( $products as $p ) :
        $masse = get_post_meta( $p->ID, '_ignitec_aerosol_masse_g', true );
        $vol   = get_post_meta( $p->ID, '_ignitec_schutzvolumen_m3', true );
        $zeit  = get_post_meta( $p->ID, '_ignitec_entladezeit_s', true );
      ?>
        <a class="ign-product-card" href="<?php echo esc_url( get_permalink( $p ) ); ?>">
          <div class="ign-product-card__icon">
            <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/mark-white.png' ); ?>"
                 alt="" width="30" height="30" loading="lazy" decoding="async">
          </div>
          <div class="ign-product-card__body">
            <?php if ( $p->_sku ) : ?>
              <div class="ign-product-card__sku"><?php echo esc_html( get_post_meta( $p->ID, '_sku', true ) ); ?></div>
            <?php endif; ?>
            <div class="ign-product-card__name"><?php echo esc_html( $p->post_title ); ?></div>
            <div class="ign-product-card__specs">
              <?php if ( $vol !== '' )  : ?>Für <?php echo esc_html( str_replace( '.', ',', $vol ) ); ?> m³<?php endif; ?>
              <?php if ( $zeit !== '' ) : ?> · ≤ <?php echo esc_html( $zeit ); ?> s<?php endif; ?>
            </div>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<style>
/* ===== APP HERO ===== */
.ign-app-hero { background: var(--bone); padding: 140px 0 72px; }
.ign-app-hero__inner { display: grid; grid-template-columns: 1.2fr 1fr; gap: 56px; align-items: center; }
.ign-app-hero__crumbs {
  font-family: var(--ff-mono);
  font-size: 12px; letter-spacing: 0.12em;
  color: var(--fg-3);
  margin-bottom: 20px;
}
.ign-app-hero__crumbs a { color: var(--fg-3); text-decoration: none; }
.ign-app-hero__crumbs a:hover { color: var(--copper-solid); }
.ign-app-hero__crumbs span { margin: 0 8px; opacity: 0.5; }

.ign-app-hero__h1 {
  font-family: var(--ff-display);
  font-weight: 600;
  font-size: clamp(40px, 5vw, 64px);
  line-height: 1.02;
  letter-spacing: -0.04em;
  color: var(--slateblue);
  margin: 10px 0 20px;
}
.ign-app-hero__lead {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 19px;
  line-height: 1.55;
  color: var(--fg-2);
  max-width: 54ch;
  margin: 0 0 32px;
}
.ign-app-hero__facts {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 18px 32px;
  margin: 0;
  padding: 24px 0;
  border-top: 1px solid rgba(21,34,52,0.1);
  border-bottom: 1px solid rgba(21,34,52,0.1);
}
.ign-app-hero__facts div { margin: 0; }
.ign-app-hero__facts dt {
  font-family: var(--ff-mono);
  font-size: 11px;
  letter-spacing: 0.18em;
  text-transform: uppercase;
  color: var(--fg-3);
  margin-bottom: 4px;
}
.ign-app-hero__facts dd {
  font-family: var(--ff-display);
  font-weight: 600;
  font-size: 20px;
  letter-spacing: -0.02em;
  color: var(--slateblue);
  margin: 0;
}

.ign-app-hero__visual {
  aspect-ratio: 4/3;
  border-radius: var(--r-5);
  background-size: cover;
  background-position: center;
  box-shadow: var(--shadow-3);
}
.ign-app-hero__visual--placeholder {
  background: var(--gradient-copper);
  display: flex; align-items: center; justify-content: center;
}
.ign-app-hero__mark {
  width: 80px; height: 80px;
  border-radius: var(--r-4);
  background: rgba(245,242,236,0.18);
}

/* ===== APP BODY ===== */
.ign-app-body { background: var(--bone); }
.ign-app-body__inner {
  display: grid;
  grid-template-columns: 2fr 1fr;
  gap: 56px;
  align-items: start;
}
.ign-app-body__prose {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 17px;
  line-height: 1.7;
  color: var(--fg-1);
}
.ign-app-body__prose h2 {
  font-family: var(--ff-display);
  font-weight: 600;
  font-size: clamp(24px, 2.6vw, 32px);
  letter-spacing: -0.025em;
  color: var(--slateblue);
  margin: 36px 0 14px;
}
.ign-app-body__prose h3 {
  font-family: var(--ff-display);
  font-weight: 600;
  font-size: 21px;
  letter-spacing: -0.02em;
  color: var(--slateblue);
  margin: 28px 0 10px;
}
.ign-app-body__prose p { margin: 0 0 1em; }
.ign-app-body__prose ul, .ign-app-body__prose ol { margin: 0 0 1em; padding-left: 24px; }
.ign-app-body__prose ul li { margin-bottom: 6px; }

.ign-app-body__risk {
  background: var(--bone-200);
  border-left: 3px solid var(--copper-solid);
  border-radius: var(--r-3);
  padding: 24px 28px;
  position: sticky;
  top: 120px;
}
.ign-app-body__risk .eyebrow { display: block; margin-bottom: 10px; }
.ign-app-body__risk p {
  font-family: var(--ff-body);
  font-weight: 400;
  font-size: 15px;
  line-height: 1.6;
  color: var(--fg-1);
  margin: 0;
}

/* ===== APP PRODUCTS ===== */
.ign-app-products { background: var(--bone-100); }
.ign-app-products__h2 {
  font-family: var(--ff-display);
  font-weight: 500;
  font-size: clamp(28px, 3.4vw, 40px);
  letter-spacing: -0.03em;
  color: var(--slateblue);
  margin: 10px 0 32px;
}
.ign-app-products__grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 16px;
}

/* Product-Card Klassen werden aus STEP 3.3 geteilt — falls nicht vorhanden, kopieren. */

@media (max-width: 960px) {
  .ign-app-hero__inner { grid-template-columns: 1fr; }
  .ign-app-body__inner { grid-template-columns: 1fr; }
  .ign-app-body__risk { position: static; }
  .ign-app-products__grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 560px) {
  .ign-app-products__grid { grid-template-columns: 1fr; }
  .ign-app-hero { padding: 120px 0 56px; }
}
</style>
```

---

## 4 · Bricks-Archiv-Template (optional: `/anwendungen/`)

**Bricks → Templates → Add New**
- Name: `Archiv Anwendungen`
- Template Type: **Archive**
- Conditions: **Post Type Archive: Anwendungen**

Im Template **1 Code-Element** mit diesem Inhalt:

```php
<section class="ign-app-archive ign-section">
  <div class="ign-container">
    <span class="eyebrow">ÜBERSICHT</span>
    <h1 class="ign-app-archive__h1">Anwendungen für kondensierte Aerosol-Löschung.</h1>
    <p class="ign-app-archive__lead">
      Jede Branche hat eigene Risiken. Diese Übersicht zeigt, wo die Serie ST sinnvoll eingesetzt wird — mit typischen Volumina und Normenbezug.
    </p>

    <div class="ign-app-archive__grid">
      <?php while ( have_posts() ) : the_post();
        $lead  = get_post_meta( get_the_ID(), '_ignitec_app_lead', true );
        $thumb = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
      ?>
        <a class="ign-app-archive__card" href="<?php the_permalink(); ?>">
          <div class="ign-app-archive__thumb" style="<?php echo $thumb ? 'background-image:url(' . esc_url( $thumb ) . ');' : ''; ?>"></div>
          <div class="ign-app-archive__body">
            <h2 class="ign-app-archive__title"><?php the_title(); ?></h2>
            <?php if ( $lead ) : ?>
              <p class="ign-app-archive__desc"><?php echo esc_html( wp_trim_words( $lead, 22 ) ); ?></p>
            <?php endif; ?>
            <span class="ign-app-archive__more">Details →</span>
          </div>
        </a>
      <?php endwhile; ?>
    </div>
  </div>
</section>

<style>
.ign-app-archive { padding-top: 140px; background: var(--bone); }
.ign-app-archive__h1 {
  font-family: var(--ff-display);
  font-weight: 600;
  font-size: clamp(36px, 4.6vw, 56px);
  letter-spacing: -0.04em;
  color: var(--slateblue);
  margin: 10px 0 14px;
}
.ign-app-archive__lead {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 18px;
  line-height: 1.55;
  color: var(--fg-2);
  max-width: 60ch;
  margin: 0 0 40px;
}
.ign-app-archive__grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
}
.ign-app-archive__card {
  background: var(--bone-50);
  border-radius: var(--r-4);
  overflow: hidden;
  box-shadow: var(--shadow-2);
  text-decoration: none;
  color: inherit;
  display: flex;
  flex-direction: column;
  transition: transform var(--dur-fast) var(--ease-standard),
              box-shadow var(--dur-base) var(--ease-standard);
}
.ign-app-archive__card:hover {
  transform: translateY(-3px);
  box-shadow: var(--shadow-3);
  color: inherit;
  text-decoration: none;
}
.ign-app-archive__thumb {
  aspect-ratio: 3/2;
  background: var(--gradient-copper);
  background-size: cover;
  background-position: center;
}
.ign-app-archive__body { padding: 24px; }
.ign-app-archive__title {
  font-family: var(--ff-display);
  font-weight: 600;
  font-size: 22px;
  letter-spacing: -0.02em;
  color: var(--slateblue);
  margin: 0 0 10px;
}
.ign-app-archive__desc {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 14px;
  line-height: 1.55;
  color: var(--fg-2);
  margin: 0 0 16px;
}
.ign-app-archive__more {
  font-family: var(--ff-mono);
  font-weight: 500;
  font-size: 11px;
  letter-spacing: 0.18em;
  color: var(--copper-solid);
}

@media (max-width: 960px) { .ign-app-archive__grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 560px) { .ign-app-archive__grid { grid-template-columns: 1fr; } }
</style>
```

---

## 5 · SEO/GEO-Notiz

- **Eigene URL-Struktur `/anwendungen/<slug>/`** — thematische Cluster für Google.
- **Breadcrumbs** im Single-Template verbessern interne Navigation + UX.
- **Produkt-Block** unten sorgt für konsistente interne Verlinkung (Anwendung → passendes Produkt → Single-Produkt).
- **Editor-Content** kann per Gutenberg-Editor mit H2/H3/Listen gepflegt werden — volle SEO-Kontrolle.

## 6 · Verifikation

- [ ] `/anwendungen/` zeigt alle CPT-Einträge als Grid
- [ ] `/anwendungen/bess/` zeigt Hero + Content + Risk-Box + passende Produkte
- [ ] Produkte erscheinen gefiltert nach `_ignitec_app_filter_term`
- [ ] Breadcrumbs funktionieren
- [ ] Responsive: Hero und Body ab 960px single-column
- [ ] Wenn kein Beitragsbild gesetzt: Copper-Gradient-Platzhalter

## 7 · Anpassungspunkte

- **Weitere Meta-Felder** können in `functions.php` (Abschnitt 8, Meta-Box) ergänzt werden.
- **Facts-Liste im Hero** ist statisch — bei Bedarf zusätzliche Meta-Felder einführen.
- **Default-Produkt-Anzahl**: `posts_per_page = 6` anpassbar.

---

**Nach Verifikation → STEP 7 (Kontakt-Seite) freigeben.**
