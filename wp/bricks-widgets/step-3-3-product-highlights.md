# STEP 3.3 — Homepage · Produkt-Teaser (Serie ST · 8 Größen)

4 Karten mit Copper-Gradient-Tile und SKU-Overlay, gepflegt in WooCommerce. Section-Head links (Eyebrow + H2), rechts ein Outline-Button "Alle Produkte ansehen". Acht Größen insgesamt — die Karten sind die 4 wichtigsten Größen für den Vorschau-Block.

**Quelle:** Mockup `home.html` (Product-Teaser). 4-spaltiges Grid mit `prod-tile`-Pattern aus dem Design-System.

---

## 1 · Vorbedingung · WooCommerce-Produkte anlegen

Für jedes Gerät ein WC-Produkt anlegen. Empfohlene Basis-Daten:

| SKU | Name | Größe | Schutzvolumen | Featured? |
|---|---|---|---|---|
| IGNI-ST030 | Ignitec Mini Plus  | 30 g | 0,4 m³ | aus |
| **IGNI-ST060** | **Ignitec Mini**     | **60 g** | **0,8 m³** | **ein** |
| IGNI-ST100 | Ignitec Small      | 100 g | 1,4 m³ | aus |
| IGNI-ST150 | Ignitec Smart      | 150 g | 2,1 m³ | aus |
| **IGNI-ST250** | **Ignitec Compact**  | **250 g** | **3,4 m³** | **ein** |
| **IGNI-ST500** | **Ignitec Standard** | **500 g** | **6,8 m³** | **ein** |
| **IGNI-ST1000** | **Ignitec Pro**      | **1,0 kg** | **13,6 m³** | **ein** |
| IGNI-ST2000 | Ignitec Pro XL     | 2,0 kg | 27,2 m³ | aus |

Die 4 fett markierten Größen sind im Mockup als Featured ausgewählt. SKU gehört in das WooCommerce-Standard-Feld (Tab "Lagerbestand").

Für jedes Featured-Produkt zusätzlich pflegen:
- `_ignitec_featured = yes`
- `_ignitec_aerosol_masse_g`, `_ignitec_schutzvolumen_m3`, `_ignitec_entladezeit_s`
- WooCommerce-Kurzbeschreibung (1 Satz, wird als `desc` ausgegeben)

## 2 · Platzierung

**Bricks → Pages → Startseite** — **3. Section** unter dem USP-Grid. Container Full-Width, darin **1 Code-Element** (Execute code ✅).

## 3 · Code-Widget-Inhalt

```php
<?php
/**
 * IGNITEC · Produkt-Teaser (4 Featured-Produkte aus WooCommerce)
 * Quelle: Mockup home.html — Section "Acht Größen. Ein System."
 */
$q = new WP_Query( [
	'post_type'      => 'product',
	'posts_per_page' => 4,
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

    <div class="ign-products__head">
      <div>
        <span class="eyebrow">Produktfamilie</span>
        <h2 id="ign-products-head" class="ign-products__h2">
          Acht Größen.<br>
          <strong>Ein System.</strong>
        </h2>
      </div>
      <a class="ign-btn ign-btn--ghost-dark" href="<?php echo esc_url( get_post_type_archive_link( 'product' ) ); ?>">
        Alle Produkte ansehen →
      </a>
    </div>

    <?php if ( $q->have_posts() ) : ?>
      <div class="ign-products__grid">
        <?php while ( $q->have_posts() ) : $q->the_post();
          $pid       = get_the_ID();
          $sku       = get_post_meta( $pid, '_sku', true );
          $masse_g   = get_post_meta( $pid, '_ignitec_aerosol_masse_g', true );
          $volume_m3 = get_post_meta( $pid, '_ignitec_schutzvolumen_m3', true );
          $excerpt   = wp_strip_all_tags( get_the_excerpt() );

          // Größe formatieren (60 → "60 g", 1000 → "1,0 kg")
          if ( $masse_g >= 1000 ) {
            $size_label = number_format( $masse_g / 1000, 1, ',', '' ) . ' kg';
          } else {
            $size_label = (int) $masse_g . ' g';
          }
        ?>
          <a class="ign-prod-card" href="<?php echo esc_url( get_permalink() ); ?>">
            <div class="ign-prod-card__tile">
              <span class="ign-prod-card__size"><?php echo esc_html( $size_label ); ?></span>
              <?php if ( $sku ) : ?>
                <span class="ign-prod-card__sku-overlay"><?php echo esc_html( $sku ); ?></span>
              <?php endif; ?>
              <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'medium', [ 'class' => 'ign-prod-card__img', 'loading' => 'lazy' ] ); ?>
              <?php endif; ?>
            </div>
            <div class="ign-prod-card__meta">
              <?php if ( $volume_m3 !== '' ) : ?>
                <div class="ign-prod-card__sku-txt">Löschvolumen · <?php echo esc_html( str_replace( '.', ',', $volume_m3 ) ); ?> m³</div>
              <?php endif; ?>
              <div class="ign-prod-card__name"><?php echo esc_html( get_the_title() ); ?></div>
              <?php if ( $excerpt ) : ?>
                <div class="ign-prod-card__desc"><?php echo esc_html( $excerpt ); ?></div>
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

  </div>
</section>

<style>
.ign-products {
  background: var(--bone-50);
}
.ign-products__head {
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
  gap: 40px;
  margin-bottom: 48px;
}
.ign-products__h2 {
  font-family: var(--ff-display);
  font-weight: 500;
  font-size: clamp(32px, 3.6vw, 52px);
  line-height: 1.03;
  letter-spacing: -0.035em;
  color: var(--slateblue);
  margin: 10px 0 0;
}
.ign-products__h2 strong { font-weight: 900; }

.ign-products__grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 16px;
}

.ign-prod-card {
  background: var(--bone);
  display: block;
  text-decoration: none;
  color: inherit;
}
.ign-prod-card:hover {
  text-decoration: none;
  color: inherit;
}
.ign-prod-card__tile {
  position: relative;
  aspect-ratio: 1;
  background: var(--gradient-copper);
  border-radius: var(--r-3);
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: transform var(--dur-base) var(--ease-standard),
              box-shadow var(--dur-base) var(--ease-standard);
}
.ign-prod-card:hover .ign-prod-card__tile {
  transform: translateY(-2px);
  box-shadow: var(--shadow-3);
}
.ign-prod-card__img {
  width: 42%;
  height: auto;
  filter: drop-shadow(0 4px 20px rgba(0,0,0,0.25));
}
.ign-prod-card__size {
  position: absolute;
  top: 14px; right: 16px;
  font-family: var(--ff-display);
  font-weight: 900;
  font-size: 20px;
  letter-spacing: -0.01em;
  color: var(--bone);
}
.ign-prod-card__sku-overlay {
  position: absolute;
  bottom: 14px; left: 16px;
  font-family: var(--ff-mono);
  font-weight: 500;
  font-size: 10px;
  letter-spacing: 0.22em;
  text-transform: uppercase;
  color: var(--bone);
  opacity: 0.85;
}
.ign-prod-card__meta {
  padding: 16px 4px 0;
}
.ign-prod-card__sku-txt {
  font-family: var(--ff-mono);
  font-weight: 500;
  font-size: 11px;
  letter-spacing: 0.18em;
  text-transform: uppercase;
  color: var(--fg-3);
}
.ign-prod-card__name {
  font-family: var(--ff-display);
  font-weight: 600;
  font-size: 18px;
  letter-spacing: -0.01em;
  color: var(--slateblue);
  margin-top: 4px;
}
.ign-prod-card__desc {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 13.5px;
  line-height: 1.45;
  color: var(--fg-2);
  margin-top: 4px;
}

.ign-products__empty {
  padding: 32px;
  background: var(--bone);
  border-radius: var(--r-4);
  color: var(--fg-2);
  text-align: center;
}

@media (max-width: 960px) {
  .ign-products__head { flex-direction: column; align-items: flex-start; gap: 16px; }
  .ign-products__grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 560px) {
  .ign-products__grid { grid-template-columns: 1fr; }
}
</style>
```

---

## 4 · Verifikation

- [ ] 4 Karten als 4-spaltiges Grid Desktop, 2 Tablet, 1 Mobile
- [ ] Tiles mit Copper-Gradient + Größen-Overlay rechts oben + SKU-Overlay links unten
- [ ] Falls Beitragsbild gesetzt: zentriertes Produkt-PNG mit Drop-Shadow
- [ ] Hover: Tile hebt sich leicht
- [ ] Karten sind komplett klickbar
- [ ] Bei leerem Zustand: dezenter Hinweis-Text

## 5 · Anpassungspunkte

- **Anzahl der Featured-Karten:** `posts_per_page = 4` → bei Bedarf auf 6/8 ändern
- **Sortierung:** `orderby` aktuell aufsteigend nach Aerosolmasse — kann auf `menu_order` umgestellt werden
- **Größen-Format:** g → "60 g", kg → "1,0 kg" (deutsches Komma) — siehe PHP-Block
