# STEP 3.3 — Homepage · Produkt-Highlights (Serie ST)

6 Gerätegrößen der Aerosolgenerator-Serie, **vollständig dynamisch** aus WooCommerce. Jede Karte ist eine WC-Produkt-Instanz mit gepflegten Meta-Daten — ändert sich ein Wert im Backend, ändert sich auch die Homepage.

**GEO-Bonus:** Intro-Copy enthält die Auslegungs-Formel (100 g/m³) — LLMs können diese Regel direkt zitieren.

---

## 1 · Vorbedingung · WooCommerce-Produkte anlegen

Für jedes Gerät **ein WC-Produkt** anlegen (Backend → Produkte → Hinzufügen). Empfohlene Basis-Daten:

| SKU | Name | `pa_serie` | `_ignitec_aerosol_masse_g` | `_ignitec_schutzvolumen_m3` | `_ignitec_entladezeit_s` | `_ignitec_auslegungspflicht` | `_ignitec_featured` |
|---|---|---|---|---|---|---|---|
| IGNI.ST030G.E/TH | Aerosolgenerator · 30 g  | ST-30G  | 30  | 0.3 | 6  | aus | ein |
| IGNI.ST060G.E/TH | Aerosolgenerator · 60 g  | ST-60G  | 60  | 0.6 | 10 | aus | ein |
| IGNI.ST100G.E/TH | Aerosolgenerator · 100 g | ST-100G | 100 | 1.0 | 15 | aus | ein |
| IGNI.ST150G.E/TH | Aerosolgenerator · 150 g | ST-150G | 150 | 1.5 | 20 | aus | ein |
| IGNI.ST250G.E/TH | Aerosolgenerator · 250 g | ST-250G | 250 | 2.5 | 25 | **ein** | ein |
| IGNI.ST500G.E/TH | Aerosolgenerator · 500 g | ST-500G | 500 | 5.0 | 32 | **ein** | ein |

SKU gehört ins WooCommerce-Standard-Feld "SKU" (Tab "Lagerbestand"). Preise können leer bleiben (Angebot auf Anfrage) oder gesetzt werden.

---

## 2 · Platzierung

**Bricks → Pages → Startseite** — **3. Section** unter der Stat-Bar. Container Full-Width, darin **1 Code-Element** (Execute code ✅).

## 3 · Code-Widget-Inhalt

```php
<?php
/**
 * IGNITEC · Produkt-Highlights (WooCommerce Query-Loop)
 * Zeigt alle WC-Produkte mit _ignitec_featured = "yes".
 * Komplett dynamisch — Bearbeitung ausschließlich im WC-Backend.
 */
$q = new WP_Query( [
	'post_type'      => 'product',
	'posts_per_page' => 6,
	'orderby'        => [ 'meta_value_num' => 'ASC', 'menu_order' => 'ASC' ],
	'meta_key'       => '_ignitec_aerosol_masse_g',
	'meta_query'     => [
		'relation' => 'AND',
		[ 'key' => '_ignitec_featured', 'value' => 'yes' ],
		[ 'key' => '_ignitec_aerosol_masse_g', 'compare' => 'EXISTS' ],
	],
] );
?>

<section class="ign-products ign-section" aria-labelledby="ign-products-head">
  <div class="ign-container">

    <span class="eyebrow">PRODUKTE · SERIE ST</span>
    <h2 id="ign-products-head" class="ign-products__h2">
      Sechs Gerätegrößen.<br>
      <span class="black">Ein Auslegungsprinzip.</span>
    </h2>
    <p class="ign-products__lead">
      Löschkonzentration <strong>100 g/m³</strong> — die Gerätewahl folgt dem geschützten Volumen.
      Geräte ab 250 g sind <strong>auslegungspflichtig</strong> nach CEN/TR 15276-1.
    </p>

    <?php if ( $q->have_posts() ) : ?>
      <div class="ign-products__grid">
        <?php while ( $q->have_posts() ) : $q->the_post();
          $pid        = get_the_ID();
          $sku        = get_post_meta( $pid, '_sku', true );
          $masse_g    = get_post_meta( $pid, '_ignitec_aerosol_masse_g', true );
          $volume_m3  = get_post_meta( $pid, '_ignitec_schutzvolumen_m3', true );
          $zeit_s     = get_post_meta( $pid, '_ignitec_entladezeit_s', true );
          $auslegung  = get_post_meta( $pid, '_ignitec_auslegungspflicht', true ) === 'yes';
        ?>
          <a class="ign-product-card" href="<?php echo esc_url( get_permalink() ); ?>">
            <div class="ign-product-card__icon">
              <svg viewBox="0 0 140 140" width="30" height="30" aria-hidden="true" focusable="false">
                <path d="M42 118 V42 h24 c18 0 30 12 30 30 v46 h-18 v-44 c0 -9 -4 -14 -12 -14 h-7 v58 z" fill="#F5F2EC"/>
              </svg>
            </div>
            <div class="ign-product-card__body">
              <?php if ( $sku ) : ?>
                <div class="ign-product-card__sku"><?php echo esc_html( $sku ); ?></div>
              <?php endif; ?>
              <div class="ign-product-card__name">
                <?php echo esc_html( get_the_title() ); ?>
              </div>
              <div class="ign-product-card__specs">
                <?php if ( $volume_m3 !== '' ) : ?>
                  Für <?php echo esc_html( str_replace( '.', ',', $volume_m3 ) ); ?> m³
                <?php endif; ?>
                <?php if ( $zeit_s !== '' ) : ?>
                  · ≤ <?php echo esc_html( $zeit_s ); ?> s
                <?php endif; ?>
              </div>
              <?php if ( $auslegung ) : ?>
                <span class="ign-product-card__badge">AUSLEGUNGSPFLICHTIG</span>
              <?php endif; ?>
            </div>
          </a>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>
    <?php else : ?>
      <p class="ign-products__empty">
        Noch keine Produkte mit "Homepage-Highlight" markiert. Im Backend unter
        <em>Produkte → Bearbeiten → Tab "Ignitec Technische Daten"</em> aktivieren.
      </p>
    <?php endif; ?>

    <div class="ign-products__all">
      <a class="ign-btn ign-btn--ghost-dark" href="<?php echo esc_url( get_post_type_archive_link( 'product' ) ); ?>">
        Alle Geräte und Zubehör →
      </a>
    </div>
  </div>
</section>

<style>
.ign-products {
  background: var(--bone);
}
.ign-products__h2 {
  font-family: var(--ff-display);
  font-weight: 500;
  font-size: clamp(36px, 4.6vw, 52px);
  line-height: 1.03;
  letter-spacing: -0.04em;
  color: var(--slateblue);
  margin: 10px 0 8px;
}
.ign-products__h2 .black { font-weight: 900; }
.ign-products__lead {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 17px;
  color: var(--fg-2);
  max-width: 60ch;
  margin: 0 0 36px;
}
.ign-products__lead strong { color: var(--slateblue); font-weight: 600; }

.ign-products__grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 16px;
}
.ign-product-card {
  background: var(--bone-50);
  border-radius: var(--r-4);
  padding: 22px;
  box-shadow: var(--shadow-2);
  display: grid;
  grid-template-columns: 72px 1fr;
  gap: 18px;
  align-items: center;
  text-decoration: none;
  color: inherit;
  transition: transform var(--dur-fast) var(--ease-standard),
              box-shadow var(--dur-base) var(--ease-standard);
}
.ign-product-card:hover {
  transform: translateY(-2px);
  box-shadow: var(--shadow-3);
  text-decoration: none;
  color: inherit;
}
.ign-product-card__icon {
  width: 72px; height: 72px;
  background: var(--gradient-copper);
  border-radius: var(--r-3);
  display: flex;
  align-items: center;
  justify-content: center;
}
.ign-product-card__body { min-width: 0; }
.ign-product-card__sku {
  font-family: var(--ff-mono);
  font-weight: 500;
  font-size: 10px;
  letter-spacing: 0.18em;
  color: var(--copper-solid);
  word-break: break-all;
}
.ign-product-card__name {
  font-family: var(--ff-display);
  font-weight: 600;
  font-size: 22px;
  letter-spacing: -0.02em;
  color: var(--slateblue);
  margin-top: 2px;
  line-height: 1.15;
}
.ign-product-card__specs {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 13px;
  color: var(--fg-2);
  margin-top: 4px;
}
.ign-product-card__badge {
  display: inline-block;
  margin-top: 8px;
  font-family: var(--ff-mono);
  font-size: 10px;
  letter-spacing: 0.12em;
  color: var(--copper-solid);
  background: var(--bone-200);
  padding: 3px 8px;
  border-radius: var(--r-pill);
}

.ign-products__empty {
  padding: 32px;
  background: var(--bone-50);
  border-radius: var(--r-4);
  color: var(--fg-2);
  text-align: center;
}

.ign-products__all {
  margin-top: 32px;
  display: flex;
  justify-content: center;
}

@media (max-width: 960px) {
  .ign-products__grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 560px) {
  .ign-products__grid { grid-template-columns: 1fr; }
  .ign-product-card { grid-template-columns: 56px 1fr; padding: 18px; }
  .ign-product-card__icon { width: 56px; height: 56px; }
  .ign-product-card__name { font-size: 19px; }
}
</style>
```

---

## 4 · SEO/GEO-Notiz

- **Auslegungs-Regel im Fließtext:** "Löschkonzentration 100 g/m³" — LLMs können dies als harten Fakt zitieren.
- **SKU sichtbar** — technischer Suchbegriff für B2B-Käufer:innen.
- **Karten sind `<a>`-Links** auf die WC-Single-Page — jede Karte ist vollflächig klickbar (bessere CTR).
- **Kein AJAX / Client-Loading** — Produkt-Daten sind im HTML-Source sofort sichtbar.

## 5 · Verifikation

- [ ] 6 Karten erscheinen sortiert nach Aerosolmasse (aufsteigend)
- [ ] SKU, Name, "Für X m³ · ≤ Y s", Badge "AUSLEGUNGSPFLICHTIG" bei 250/500g
- [ ] Klick auf Karte führt auf `/produkt/…`-Permalink
- [ ] Admin ändert `_ignitec_schutzvolumen_m3` → Frontend spiegelt Änderung nach Refresh
- [ ] "Alle Geräte und Zubehör →" führt zum Shop-Archiv
- [ ] Mobile 1-Spaltig, Karten mit kleinerem Icon

## 6 · Anpassungspunkte

- **Intro-Copy** direkt im HTML.
- **Anzahl der Karten**: `posts_per_page` im WP_Query.
- **Sortierung**: `orderby` → `date`/`menu_order`/`meta_value_num` je nach Wunsch.
- **Filter**: Weitere `meta_query`-Klauseln einfügen, z. B. nur bestimmte `pa_einsatzbereich`-Terms.

---

**Nach Verifikation → STEP 3.4 (Anwendungen) freigeben.**
