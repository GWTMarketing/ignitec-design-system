<?php
/**
 * Ignitec Child Theme · functions.php
 *
 * Enthält:
 *   · Enqueue Parent/Child-Styles + Google-Fonts
 *   · WooCommerce Global-Attribute (programmatisch, idempotent)
 *   · Custom-Meta-Tab "Ignitec Technische Daten" in der Produktmaske
 *   · Hilfsfunktionen für dynamisches Rendering der Spec-Table
 *   · Bricks-Dynamic-Data-Tags (optional)
 *
 * Keine kostenpflichtigen Plugins. Alles WooCommerce-native.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/* =========================================================
 * 1 · ENQUEUE STYLES + FONTS
 * ========================================================= */

add_action( 'wp_enqueue_scripts', function () {

	// Google Fonts (IBM Plex Sans, JetBrains Mono, Poppins)
	wp_enqueue_style(
		'ignitec-google-fonts',
		'https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@300;400;500;600&family=JetBrains+Mono:wght@400;500&family=Poppins:wght@600&display=swap',
		[],
		null
	);

	// Parent-Theme (Bricks)
	wp_enqueue_style( 'bricks-parent', get_template_directory_uri() . '/style.css', [], wp_get_theme()->parent()->get( 'Version' ) );

	// Child-Theme (Tokens + Base-Styles)
	wp_enqueue_style(
		'ignitec-child',
		get_stylesheet_directory_uri() . '/style.css',
		[ 'bricks-parent', 'ignitec-google-fonts' ],
		wp_get_theme()->get( 'Version' )
	);
}, 20 );


/* =========================================================
 * 2 · WOOCOMMERCE · GLOBAL ATTRIBUTES
 *
 * Wird einmalig beim Theme-Setup ausgeführt. Idempotent —
 * existierende Attribute werden NICHT überschrieben, nur
 * fehlende angelegt.
 * ========================================================= */

add_action( 'after_switch_theme', 'ignitec_register_global_attributes' );
add_action( 'admin_init', function () {
	if ( get_option( 'ignitec_attributes_seeded' ) !== '1' ) {
		ignitec_register_global_attributes();
		update_option( 'ignitec_attributes_seeded', '1' );
	}
} );

function ignitec_register_global_attributes() {

	if ( ! function_exists( 'wc_create_attribute' ) ) { return; }

	$attributes = [
		'serie'          => [ 'Serie',          [ 'ST-30G','ST-60G','ST-100G','ST-150G','ST-250G','ST-500G' ] ],
		'einsatzbereich' => [ 'Einsatzbereich', [ 'Schaltschrank','BESS','Maschinenraum','Serverraum','Fahrzeug','Industrie' ] ],
		'ausloesung'     => [ 'Auslösung',      [ 'Thermisch','Elektrisch','Manuell','Dual' ] ],
		'montage'        => [ 'Montageart',     [ 'Wand','Decke','Schrankboden','19-Zoll-Rack' ] ],
		'norm'           => [ 'Norm',           [ 'CEN/TR 15276-1','ISO 15779','VdS','UL-2775','FM' ] ],
	];

	foreach ( $attributes as $slug => [ $label, $terms ] ) {

		$taxonomy = 'pa_' . $slug;
		$exists   = taxonomy_exists( $taxonomy );

		if ( ! $exists ) {
			$result = wc_create_attribute( [
				'name'         => $label,
				'slug'         => $slug,
				'type'         => 'select',
				'order_by'     => 'menu_order',
				'has_archives' => true,
			] );
			if ( is_wp_error( $result ) ) { continue; }
			// Taxonomie für Term-Insert registrieren
			register_taxonomy( $taxonomy, 'product', [ 'hierarchical' => false, 'public' => true ] );
		}

		foreach ( $terms as $term ) {
			if ( ! term_exists( $term, $taxonomy ) ) {
				wp_insert_term( $term, $taxonomy );
			}
		}
	}

	// Rewrite-Rules flushen, damit Archiv-URLs greifen
	delete_option( 'rewrite_rules' );
}


/* =========================================================
 * 3 · CUSTOM PRODUCT META — TAB "IGNITEC TECHNISCHE DATEN"
 *
 * Fügt in der WooCommerce-Produkt-Edit-Maske einen neuen Tab
 * mit allen technischen Feldern hinzu. Werte sind per
 * Bricks Dynamic Data als {post_meta:_ignitec_…} auslesbar.
 * ========================================================= */

// 3.1 · Tab registrieren
add_filter( 'woocommerce_product_data_tabs', function ( $tabs ) {
	$tabs['ignitec_specs'] = [
		'label'    => __( 'Ignitec Technische Daten', 'ignitec' ),
		'target'   => 'ignitec_specs_data',
		'class'    => [],
		'priority' => 21,
	];
	return $tabs;
} );

// 3.2 · Felder rendern
add_action( 'woocommerce_product_data_panels', function () {
	echo '<div id="ignitec_specs_data" class="panel woocommerce_options_panel">';

	woocommerce_wp_checkbox( [
		'id'          => '_ignitec_featured',
		'label'       => __( 'Homepage-Highlight', 'ignitec' ),
		'description' => __( 'Wenn aktiv, erscheint das Produkt in der Homepage-Sektion "Produkt-Highlights".', 'ignitec' ),
	] );

	woocommerce_wp_checkbox( [
		'id'          => '_ignitec_auslegungspflicht',
		'label'       => __( 'Auslegungspflichtig', 'ignitec' ),
		'description' => __( 'Geräte ab 250 g sind auslegungspflichtig nach CEN/TR 15276-1.', 'ignitec' ),
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_aerosol_masse_g',
		'label'       => __( 'Aerosolmasse (g)', 'ignitec' ),
		'type'        => 'number',
		'custom_attributes' => [ 'step' => '1', 'min' => '0' ],
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_schutzvolumen_m3',
		'label'       => __( 'Schutzvolumen (m³)', 'ignitec' ),
		'type'        => 'number',
		'custom_attributes' => [ 'step' => '0.1', 'min' => '0' ],
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_entladezeit_s',
		'label'       => __( 'Entladezeit (s)', 'ignitec' ),
		'type'        => 'number',
		'custom_attributes' => [ 'step' => '0.1', 'min' => '0' ],
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_abmessungen_mm',
		'label'       => __( 'Abmessungen (mm)', 'ignitec' ),
		'placeholder' => '285 × 100 × 100',
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_gewicht_kg',
		'label'       => __( 'Gewicht (kg)', 'ignitec' ),
		'type'        => 'number',
		'custom_attributes' => [ 'step' => '0.01', 'min' => '0' ],
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_temp_bereich',
		'label'       => __( 'Temperaturbereich', 'ignitec' ),
		'placeholder' => '−40 °C … +95 °C',
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_lagerzeit_jahre',
		'label'       => __( 'Lagerzeit (Jahre)', 'ignitec' ),
		'type'        => 'number',
		'custom_attributes' => [ 'step' => '1', 'min' => '0' ],
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_gwp',
		'label'       => __( 'GWP-Wert', 'ignitec' ),
		'type'        => 'number',
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_odp',
		'label'       => __( 'ODP-Wert', 'ignitec' ),
		'type'        => 'number',
		'custom_attributes' => [ 'step' => '0.001' ],
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_ip_schutz',
		'label'       => __( 'IP-Schutzart', 'ignitec' ),
		'placeholder' => 'IP40',
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_datenblatt_pdf',
		'label'       => __( 'Datenblatt-PDF (URL)', 'ignitec' ),
		'description' => __( 'URL zur hochgeladenen PDF-Datei in der Mediathek.', 'ignitec' ),
	] );

	echo '</div>';
} );

// 3.3 · Felder speichern
add_action( 'woocommerce_process_product_meta', function ( $post_id ) {

	$fields = [
		'_ignitec_featured'          => 'checkbox',
		'_ignitec_auslegungspflicht' => 'checkbox',
		'_ignitec_aerosol_masse_g'   => 'float',
		'_ignitec_schutzvolumen_m3'  => 'float',
		'_ignitec_entladezeit_s'     => 'float',
		'_ignitec_abmessungen_mm'    => 'string',
		'_ignitec_gewicht_kg'        => 'float',
		'_ignitec_temp_bereich'      => 'string',
		'_ignitec_lagerzeit_jahre'   => 'int',
		'_ignitec_gwp'               => 'int',
		'_ignitec_odp'               => 'float',
		'_ignitec_ip_schutz'         => 'string',
		'_ignitec_datenblatt_pdf'    => 'url',
	];

	foreach ( $fields as $key => $type ) {
		$raw = isset( $_POST[ $key ] ) ? wp_unslash( $_POST[ $key ] ) : '';
		switch ( $type ) {
			case 'checkbox':
				update_post_meta( $post_id, $key, $raw === 'yes' ? 'yes' : 'no' );
				break;
			case 'float':
				update_post_meta( $post_id, $key, $raw === '' ? '' : (float) $raw );
				break;
			case 'int':
				update_post_meta( $post_id, $key, $raw === '' ? '' : (int) $raw );
				break;
			case 'url':
				update_post_meta( $post_id, $key, esc_url_raw( $raw ) );
				break;
			default:
				update_post_meta( $post_id, $key, sanitize_text_field( $raw ) );
		}
	}
} );


/* =========================================================
 * 4 · HILFSFUNKTION · SPEC-TABLE DYNAMISCH RENDERN
 *
 * Wird in der Produkt-Single-Bricks-Sektion (STEP 5) per
 * PHP-Code-Widget aufgerufen. Gibt saubere <dl>-Liste zurück,
 * lässt leere Felder weg.
 * ========================================================= */

function ignitec_render_spec_table( $product_id = null ) {
	$product_id = $product_id ?: get_the_ID();
	if ( ! $product_id ) { return ''; }

	$rows = [
		'_ignitec_aerosol_masse_g'  => [ 'Aerosolmasse',  'g' ],
		'_ignitec_schutzvolumen_m3' => [ 'Schutzvolumen', 'm³' ],
		'_ignitec_entladezeit_s'    => [ 'Entladezeit',   's' ],
		'_ignitec_abmessungen_mm'   => [ 'Abmessungen',   'mm' ],
		'_ignitec_gewicht_kg'       => [ 'Gewicht',       'kg' ],
		'_ignitec_temp_bereich'     => [ 'Temp.-Bereich', '' ],
		'_ignitec_lagerzeit_jahre'  => [ 'Lagerzeit',     'Jahre' ],
		'_ignitec_gwp'              => [ 'GWP-Wert',      '' ],
		'_ignitec_odp'              => [ 'ODP-Wert',      '' ],
		'_ignitec_ip_schutz'        => [ 'IP-Schutzart',  '' ],
	];

	$out = '<dl class="ign-spec-table">';
	foreach ( $rows as $meta => [ $label, $unit ] ) {
		$val = get_post_meta( $product_id, $meta, true );
		if ( $val === '' || $val === null ) { continue; }
		$unit_html = $unit ? ' <span class="ign-spec-unit">' . esc_html( $unit ) . '</span>' : '';
		$out .= sprintf(
			'<div class="ign-spec-row"><dt>%s</dt><dd>%s%s</dd></div>',
			esc_html( $label ),
			esc_html( $val ),
			$unit_html
		);
	}

	// Attribute (Taxonomien) ergänzen
	$taxonomies = [
		'pa_serie'          => 'Serie',
		'pa_einsatzbereich' => 'Einsatzbereich',
		'pa_ausloesung'     => 'Auslösung',
		'pa_montage'        => 'Montageart',
		'pa_norm'           => 'Normen',
	];
	foreach ( $taxonomies as $tax => $label ) {
		$terms = wp_get_post_terms( $product_id, $tax, [ 'fields' => 'names' ] );
		if ( is_wp_error( $terms ) || empty( $terms ) ) { continue; }
		$out .= sprintf(
			'<div class="ign-spec-row"><dt>%s</dt><dd>%s</dd></div>',
			esc_html( $label ),
			esc_html( implode( ', ', $terms ) )
		);
	}

	$out .= '</dl>';
	return $out;
}


/* =========================================================
 * 5 · NAV-MENÜS REGISTRIEREN
 * ========================================================= */

add_action( 'after_setup_theme', function () {
	register_nav_menus( [
		'primary'          => __( 'Hauptnavigation (Header)', 'ignitec' ),
		'footer_produkt'   => __( 'Footer · Produkt', 'ignitec' ),
		'footer_anwendung' => __( 'Footer · Anwendung', 'ignitec' ),
		'footer_company'   => __( 'Footer · Unternehmen', 'ignitec' ),
		'footer_service'   => __( 'Footer · Service', 'ignitec' ),
	] );
} );


/* =========================================================
 * 6 · BRICKS · CODE-EXECUTION FREISCHALTEN
 *
 * Bricks sperrt PHP-Ausführung in Code-Elementen standardmäßig.
 * Für Admin-Benutzer erlauben wir das Signing der Code-Snippets.
 * (User-seitig weiter in Bricks → Settings → Builder Access
 * den "Code Execution"-Toggle für Admins aktivieren.)
 * ========================================================= */

add_filter( 'bricks/code/allow_execution', '__return_true' );


/* =========================================================
 * 7 · PERFORMANCE · EMOJI + EMBED AUFRÄUMEN
 * ========================================================= */

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
