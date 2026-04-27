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
		'serie'          => [ 'Serie',          [ 'ST-30','ST-60','ST-100','ST-150','ST-250','ST-500','ST-1000','ST-2000' ] ],
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
		'id'          => '_ignitec_durchmesser_mm',
		'label'       => __( 'Durchmesser Ø (mm)', 'ignitec' ),
		'type'        => 'number',
		'custom_attributes' => [ 'step' => '0.1', 'min' => '0' ],
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_hoehe_mm',
		'label'       => __( 'Höhe (mm)', 'ignitec' ),
		'type'        => 'number',
		'custom_attributes' => [ 'step' => '0.1', 'min' => '0' ],
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_gewicht_kg',
		'label'       => __( 'Bruttogewicht inkl. Gehäuse (kg)', 'ignitec' ),
		'type'        => 'number',
		'custom_attributes' => [ 'step' => '0.01', 'min' => '0' ],
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_temp_bereich',
		'label'       => __( 'Betriebstemperaturbereich', 'ignitec' ),
		'placeholder' => '−40 °C bis +95 °C',
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_temp_lagerung',
		'label'       => __( 'Lagertemperaturbereich', 'ignitec' ),
		'placeholder' => '−54 °C bis +75 °C',
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_feuchte_max',
		'label'       => __( 'Max. relative Luftfeuchte', 'ignitec' ),
		'placeholder' => 'bis 98 % nicht kondensierend',
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_partikelgroesse',
		'label'       => __( 'Aerosolpartikelgröße D50', 'ignitec' ),
		'placeholder' => '≤ 2,5 µm',
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_brandklassen',
		'label'       => __( 'Brandklassen', 'ignitec' ),
		'placeholder' => 'A · B · C · F · E (elektr.)',
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_reaktionszeit',
		'label'       => __( 'Reaktionszeit nach Zündung', 'ignitec' ),
		'placeholder' => '≤ 18 s',
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_ausloesung_elektrisch',
		'label'       => __( 'Elektrische Auslösung', 'ignitec' ),
		'placeholder' => '24 V DC · 1,5 A / 1 s',
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_ausloesung_thermisch',
		'label'       => __( 'Thermische Auslösung', 'ignitec' ),
		'placeholder' => '170 °C (Rückfallebene)',
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_widerstand_zuendkreis',
		'label'       => __( 'Widerstand Zündkreis', 'ignitec' ),
		'placeholder' => '1,8 ± 0,3 Ω',
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_schnittstelle',
		'label'       => __( 'Schnittstelle', 'ignitec' ),
		'placeholder' => '2-adrig · Steckverbinder M12',
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_lagerzeit_jahre',
		'label'       => __( 'Lagerfähigkeit (Jahre)', 'ignitec' ),
		'type'        => 'number',
		'custom_attributes' => [ 'step' => '1', 'min' => '0' ],
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_garantie_jahre',
		'label'       => __( 'Garantie (Jahre)', 'ignitec' ),
		'type'        => 'number',
		'custom_attributes' => [ 'step' => '1', 'min' => '0' ],
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_typpruefung',
		'label'       => __( 'Typprüfung', 'ignitec' ),
		'placeholder' => 'EN 15276 Teil 1 & 2',
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_ce_norm',
		'label'       => __( 'CE-Kennzeichnung / Konformität', 'ignitec' ),
		'placeholder' => '2014/34/EU konform (ATEX II 3G)',
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
		'label'       => __( 'IP-Schutzart Gehäuse', 'ignitec' ),
		'placeholder' => 'IP54',
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_lieferzeit',
		'label'       => __( 'Lieferzeit', 'ignitec' ),
		'placeholder' => '2–3 Wochen ab Werk',
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_mindestbestellung',
		'label'       => __( 'Mindestbestellmenge', 'ignitec' ),
		'placeholder' => '1 Stück (Projekt) · 10 (OEM)',
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_datenblatt_pdf',
		'label'       => __( 'Datenblatt DE (URL)', 'ignitec' ),
		'description' => __( 'URL zur PDF-Datei.', 'ignitec' ),
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_datasheet_en_pdf',
		'label'       => __( 'Datasheet EN (URL)', 'ignitec' ),
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_sdb_pdf',
		'label'       => __( 'Sicherheitsdatenblatt SDB (URL)', 'ignitec' ),
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_cad_zip',
		'label'       => __( 'CAD 3D-Modell (ZIP-URL)', 'ignitec' ),
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_bohrbild_zip',
		'label'       => __( 'Bohrbild 2D (ZIP-URL)', 'ignitec' ),
	] );

	woocommerce_wp_text_input( [
		'id'          => '_ignitec_pruefbericht_pdf',
		'label'       => __( 'Prüfbericht EN 15276 (URL)', 'ignitec' ),
	] );

	echo '</div>';
} );

// 3.3 · Felder speichern
add_action( 'woocommerce_process_product_meta', function ( $post_id ) {

	$fields = [
		'_ignitec_featured'             => 'checkbox',
		'_ignitec_auslegungspflicht'    => 'checkbox',
		'_ignitec_aerosol_masse_g'      => 'float',
		'_ignitec_schutzvolumen_m3'     => 'float',
		'_ignitec_entladezeit_s'        => 'float',
		'_ignitec_abmessungen_mm'       => 'string',
		'_ignitec_durchmesser_mm'       => 'float',
		'_ignitec_hoehe_mm'             => 'float',
		'_ignitec_gewicht_kg'           => 'float',
		'_ignitec_temp_bereich'         => 'string',
		'_ignitec_temp_lagerung'        => 'string',
		'_ignitec_feuchte_max'          => 'string',
		'_ignitec_partikelgroesse'      => 'string',
		'_ignitec_brandklassen'         => 'string',
		'_ignitec_reaktionszeit'        => 'string',
		'_ignitec_ausloesung_elektrisch'=> 'string',
		'_ignitec_ausloesung_thermisch' => 'string',
		'_ignitec_widerstand_zuendkreis'=> 'string',
		'_ignitec_schnittstelle'        => 'string',
		'_ignitec_lagerzeit_jahre'      => 'int',
		'_ignitec_garantie_jahre'       => 'int',
		'_ignitec_typpruefung'          => 'string',
		'_ignitec_ce_norm'              => 'string',
		'_ignitec_gwp'                  => 'int',
		'_ignitec_odp'                  => 'float',
		'_ignitec_ip_schutz'            => 'string',
		'_ignitec_lieferzeit'           => 'string',
		'_ignitec_mindestbestellung'    => 'string',
		'_ignitec_datenblatt_pdf'       => 'url',
		'_ignitec_datasheet_en_pdf'     => 'url',
		'_ignitec_sdb_pdf'              => 'url',
		'_ignitec_cad_zip'              => 'url',
		'_ignitec_bohrbild_zip'         => 'url',
		'_ignitec_pruefbericht_pdf'     => 'url',
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


/* =========================================================
 * 8 · KONTAKT-FORMULAR · HANDLER
 *
 * Verarbeitet POST aus dem Bricks-Code-Widget Kontaktformular.
 * - Nonce + Honeypot + einfache Rate-Limit via Transient
 * - Mail an office@ignitec.at + Auto-Reply an Absender:in
 * - Optional: Brevo-Newsletter-Opt-In
 * - Antwortet mit JSON (fetch) oder Redirect (non-JS-Fallback)
 * ========================================================= */

add_action( 'admin_post_nopriv_ignitec_inquiry', 'ignitec_handle_inquiry' );
add_action( 'admin_post_ignitec_inquiry',        'ignitec_handle_inquiry' );

function ignitec_handle_inquiry() {

	$is_ajax = ! empty( $_SERVER['HTTP_X_REQUESTED_WITH'] )
		&& strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) === 'xmlhttprequest';

	$respond = function ( $ok, $msg, $fields = [] ) use ( $is_ajax ) {
		if ( $is_ajax ) {
			wp_send_json( [
				'ok'      => (bool) $ok,
				'message' => $msg,
				'fields'  => $fields,
			], $ok ? 200 : 422 );
		}
		$redirect = $ok
			? add_query_arg( 'ignitec_inquiry', 'sent', wp_get_referer() ?: home_url( '/kontakt/' ) )
			: add_query_arg( 'ignitec_inquiry', 'error', wp_get_referer() ?: home_url( '/kontakt/' ) );
		wp_safe_redirect( $redirect . '#ign-form' );
		exit;
	};

	// Honeypot
	if ( ! empty( $_POST['ignitec_website'] ) ) {
		$respond( true, '' );
	}

	// Nonce
	if ( ! isset( $_POST['ignitec_nonce'] ) || ! wp_verify_nonce( $_POST['ignitec_nonce'], 'ignitec_inquiry' ) ) {
		$respond( false, __( 'Sicherheits-Token abgelaufen. Bitte Seite neu laden.', 'ignitec' ) );
	}

	// Rate-Limit (1 Submission / 30 s pro IP)
	$ip  = isset( $_SERVER['REMOTE_ADDR'] ) ? preg_replace( '/[^0-9a-fA-F\.:]/', '', $_SERVER['REMOTE_ADDR'] ) : 'anon';
	$key = 'ignitec_rl_' . md5( $ip );
	if ( get_transient( $key ) ) {
		$respond( false, __( 'Bitte einen Moment warten, bevor Sie erneut absenden.', 'ignitec' ) );
	}
	set_transient( $key, 1, 30 );

	// Input sammeln
	$in = [];
	foreach ( [
		'anrede','firma','vorname','nachname','email','telefon',
		'einsatzbereich','schutzvolumen','temp_bereich','ausloesung','zeitrahmen','nachricht',
	] as $f ) {
		$in[ $f ] = isset( $_POST[ $f ] ) ? sanitize_text_field( wp_unslash( $_POST[ $f ] ) ) : '';
	}
	$in['nachricht']  = isset( $_POST['nachricht'] ) ? sanitize_textarea_field( wp_unslash( $_POST['nachricht'] ) ) : '';
	$in['consent']    = ! empty( $_POST['consent'] );
	$in['newsletter'] = ! empty( $_POST['newsletter'] );

	// Pflichtfelder
	$errors = [];
	if ( ! $in['firma'] )                              { $errors[] = 'firma'; }
	if ( ! $in['nachname'] )                           { $errors[] = 'nachname'; }
	if ( ! $in['email'] || ! is_email( $in['email'] ) ){ $errors[] = 'email'; }
	if ( ! $in['consent'] )                            { $errors[] = 'consent'; }
	if ( $errors ) {
		$respond( false, __( 'Bitte Pflichtfelder prüfen.', 'ignitec' ), $errors );
	}

	// Mail an office@ignitec.at
	$to      = get_option( 'ignitec_inquiry_to', 'office@ignitec.at' );
	$site    = wp_parse_url( home_url(), PHP_URL_HOST );
	$subject = sprintf( '[Ignitec] Anfrage von %s (%s)', $in['firma'], $in['nachname'] );

	$lines = [
		sprintf( 'Eingang:    %s', current_time( 'd.m.Y H:i' ) ),
		sprintf( 'Absender:   %s %s %s', $in['anrede'], $in['vorname'], $in['nachname'] ),
		sprintf( 'Firma:      %s', $in['firma'] ),
		sprintf( 'E-Mail:     %s', $in['email'] ),
		sprintf( 'Telefon:    %s', $in['telefon'] ),
		'',
		'--- Projekt ---',
		sprintf( 'Einsatzbereich:   %s', $in['einsatzbereich'] ),
		sprintf( 'Schutzvolumen:    %s m³', $in['schutzvolumen'] ),
		sprintf( 'Temp.-Bereich:    %s', $in['temp_bereich'] ),
		sprintf( 'Auslöse-Art:      %s', $in['ausloesung'] ),
		sprintf( 'Zeitrahmen:       %s', $in['zeitrahmen'] ),
		'',
		'--- Nachricht ---',
		$in['nachricht'],
		'',
		sprintf( 'Newsletter-Opt-In: %s', $in['newsletter'] ? 'Ja' : 'Nein' ),
		sprintf( 'Einwilligung:      %s', $in['consent'] ? 'Ja' : 'Nein' ),
		sprintf( 'Quelle:            %s', home_url( add_query_arg( [], $_SERVER['REQUEST_URI'] ?? '' ) ) ),
	];

	$body    = implode( "\n", $lines );
	$headers = [
		'Content-Type: text/plain; charset=UTF-8',
		sprintf( 'From: Ignitec Web <noreply@%s>', $site ),
		sprintf( 'Reply-To: %s <%s>', trim( $in['vorname'] . ' ' . $in['nachname'] ), $in['email'] ),
	];
	wp_mail( $to, $subject, $body, $headers );

	// Auto-Reply
	$auto_subject = __( 'Ihre Anfrage bei Ignitec — wir haben Sie erhalten', 'ignitec' );
	$auto_body    = sprintf(
		"Guten Tag %s,\n\n"
		. "vielen Dank für Ihre Anfrage. Wir melden uns im Regelfall innerhalb von 4 Stunden zurück und übermitteln Ihnen das Auslegungsdokument binnen 48 h (Werktage).\n\n"
		. "Ignitec GmbH\nMichael-Hainisch-Straße 8\n2493 Lichtenwörth\noffice@ignitec.at\n\n"
		. "— diese Nachricht wurde automatisch erstellt.",
		$in['nachname']
	);
	wp_mail(
		$in['email'],
		$auto_subject,
		$auto_body,
		[
			'Content-Type: text/plain; charset=UTF-8',
			sprintf( 'From: Ignitec <%s>', $to ),
		]
	);

	// Brevo-Opt-In (optional)
	if ( $in['newsletter'] ) {
		ignitec_brevo_subscribe( $in['email'], [
			'VORNAME'  => $in['vorname'],
			'NACHNAME' => $in['nachname'],
			'FIRMA'    => $in['firma'],
		] );
	}

	$respond( true, __( 'Vielen Dank. Wir melden uns innerhalb von 4 Stunden.', 'ignitec' ) );
}


/* =========================================================
 * 9 · BREVO · NEWSLETTER-API (OPTIONAL)
 *
 * Nutzt entweder:
 * - Konstante IGNITEC_BREVO_API_KEY + IGNITEC_BREVO_LIST_ID in wp-config.php
 * - Oder wp_option 'ignitec_brevo_api_key' + 'ignitec_brevo_list_id'
 * Ohne gesetzten API-Key wird silent übersprungen.
 * ========================================================= */

function ignitec_brevo_subscribe( $email, $attrs = [] ) {

	$api_key = defined( 'IGNITEC_BREVO_API_KEY' )
		? IGNITEC_BREVO_API_KEY
		: get_option( 'ignitec_brevo_api_key', '' );
	$list_id = defined( 'IGNITEC_BREVO_LIST_ID' )
		? (int) IGNITEC_BREVO_LIST_ID
		: (int) get_option( 'ignitec_brevo_list_id', 0 );

	if ( ! $api_key || ! $list_id || ! is_email( $email ) ) {
		return false;
	}

	$payload = [
		'email'           => $email,
		'attributes'      => array_filter( $attrs ),
		'listIds'         => [ $list_id ],
		'updateEnabled'   => true,
	];

	$response = wp_remote_post( 'https://api.brevo.com/v3/contacts', [
		'timeout' => 10,
		'headers' => [
			'Accept'       => 'application/json',
			'Content-Type' => 'application/json',
			'api-key'      => $api_key,
		],
		'body'    => wp_json_encode( $payload ),
	] );

	if ( is_wp_error( $response ) ) { return false; }
	$code = (int) wp_remote_retrieve_response_code( $response );
	return $code >= 200 && $code < 300;
}


/* =========================================================
 * 10 · ADMIN-SEITE · IGNITEC-EINSTELLUNGEN
 *
 * Minimales Settings-Panel (ohne Plugin). Hier werden
 * Brevo-API-Key + List-ID gepflegt, falls nicht via wp-config.
 * ========================================================= */

add_action( 'admin_menu', function () {
	add_options_page(
		__( 'Ignitec', 'ignitec' ),
		__( 'Ignitec', 'ignitec' ),
		'manage_options',
		'ignitec-settings',
		'ignitec_settings_page'
	);
} );

add_action( 'admin_init', function () {
	register_setting( 'ignitec_settings', 'ignitec_brevo_api_key',  [ 'sanitize_callback' => 'sanitize_text_field' ] );
	register_setting( 'ignitec_settings', 'ignitec_brevo_list_id',  [ 'sanitize_callback' => 'absint' ] );
	register_setting( 'ignitec_settings', 'ignitec_inquiry_to',     [ 'sanitize_callback' => 'sanitize_email' ] );
} );

function ignitec_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) { return; }
	?>
	<div class="wrap">
		<h1>Ignitec Einstellungen</h1>
		<form method="post" action="options.php">
			<?php settings_fields( 'ignitec_settings' ); ?>
			<table class="form-table">
				<tr>
					<th scope="row"><label for="ignitec_inquiry_to">Anfrage-Empfänger</label></th>
					<td>
						<input type="email" name="ignitec_inquiry_to" id="ignitec_inquiry_to"
							value="<?php echo esc_attr( get_option( 'ignitec_inquiry_to', 'office@ignitec.at' ) ); ?>"
							class="regular-text">
						<p class="description">E-Mail-Adresse für eingehende Anfragen aus dem Kontaktformular.</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="ignitec_brevo_api_key">Brevo API-Key</label></th>
					<td>
						<input type="text" name="ignitec_brevo_api_key" id="ignitec_brevo_api_key"
							value="<?php echo esc_attr( get_option( 'ignitec_brevo_api_key' ) ); ?>"
							class="regular-text code"
							autocomplete="off">
						<p class="description">Aus Brevo → SMTP &amp; API → API Keys. Startet mit <code>xkeysib-…</code></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="ignitec_brevo_list_id">Brevo List-ID</label></th>
					<td>
						<input type="number" name="ignitec_brevo_list_id" id="ignitec_brevo_list_id"
							value="<?php echo esc_attr( get_option( 'ignitec_brevo_list_id' ) ); ?>"
							class="small-text">
						<p class="description">Numerische ID der Brevo-Kontaktliste für Newsletter-Opt-Ins.</p>
					</td>
				</tr>
			</table>
			<?php submit_button(); ?>
		</form>
		<hr>
		<p><strong>Alternativ:</strong> Werte via <code>wp-config.php</code> setzen:</p>
		<pre>define( 'IGNITEC_BREVO_API_KEY', 'xkeysib-…' );
define( 'IGNITEC_BREVO_LIST_ID', 3 );</pre>
	</div>
	<?php
}
