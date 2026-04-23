# STEP 3.4 — Homepage · Anwendungen

4 Use-Case-Kacheln: Schaltschrank, BESS / Battery Rack, Maschinenraum, Serverraum. Jede Kachel verlinkt auf die Shop-Archivseite gefiltert nach `pa_einsatzbereich` — dynamisch mit den Attribut-Terms aus STEP 0.

**SEO-Nutzen:** Deep-Linking in das Produkt-Archiv mit vorausgewähltem Filter → bessere interne Verlinkung, thematische Relevanz-Cluster für Google.

---

## 1 · Platzierung

**Bricks → Pages → Startseite** — **4. Section** unter Produkt-Highlights. Container Full-Width, darin **1 Code-Element** (Execute code ✅).

## 2 · Code-Widget-Inhalt

```php
<?php
/**
 * IGNITEC · Anwendungen (Application Strip)
 * 4 Use-Case-Kacheln → verlinkt auf Shop-Archiv mit pa_einsatzbereich-Filter.
 */

$apps = [
	[
		'term' => 'Schaltschrank',
		'slug' => 'schaltschrank',
		'desc' => '0,3 – 2,5 m³ · thermisch oder elektrisch ausgelöst',
	],
	[
		'term' => 'BESS',
		'slug' => 'bess',
		'desc' => 'Thermal Runaway im Battery-Rack früh unterdrücken',
	],
	[
		'term' => 'Maschinenraum',
		'slug' => 'maschinenraum',
		'desc' => 'CNC, Hydraulik, Blockheizkraftwerk',
	],
	[
		'term' => 'Serverraum',
		'slug' => 'serverraum',
		'desc' => 'Rückstandsarm, keine Ausgasung',
	],
];

$archive_base = get_post_type_archive_link( 'product' );
?>

<section class="ign-apps ign-section" aria-labelledby="ign-apps-head">
  <div class="ign-container">
    <span class="eyebrow">ANWENDUNGEN</span>
    <h2 id="ign-apps-head" class="ign-apps__h2">
      Wo Aerosol die richtige Antwort ist.
    </h2>
    <p class="ign-apps__lead">
      Kondensiertes Aerosol schützt geschlossene oder weitgehend geschlossene Volumina —
      dort, wo Gas, Pulver oder Wasser Sekundärschäden verursachen würden.
    </p>

    <div class="ign-apps__grid">
      <?php foreach ( $apps as $app ) :
        $url = add_query_arg( 'filter_einsatzbereich', $app['slug'], $archive_base );
      ?>
        <a class="ign-app-card" href="<?php echo esc_url( $url ); ?>">
          <div class="ign-app-card__mark" aria-hidden="true"></div>
          <div class="ign-app-card__body">
            <div class="ign-app-card__title"><?php echo esc_html( $app['term'] ); ?></div>
            <div class="ign-app-card__desc"><?php echo esc_html( $app['desc'] ); ?></div>
          </div>
          <div class="ign-app-card__arrow" aria-hidden="true">→</div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<style>
.ign-apps {
  background: var(--bone-200);
}
.ign-apps__h2 {
  font-family: var(--ff-display);
  font-weight: 500;
  font-size: clamp(32px, 3.6vw, 40px);
  line-height: 1.03;
  letter-spacing: -0.04em;
  color: var(--slateblue);
  margin: 10px 0 12px;
}
.ign-apps__lead {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 17px;
  color: var(--fg-2);
  max-width: 62ch;
  margin: 0 0 32px;
}

.ign-apps__grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 14px;
}
.ign-app-card {
  background: var(--bone);
  border-radius: var(--r-4);
  padding: 22px;
  min-height: 180px;
  border: 1px solid rgba(21,34,52,0.06);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  color: inherit;
  text-decoration: none;
  position: relative;
  transition: transform var(--dur-fast) var(--ease-standard),
              box-shadow var(--dur-base) var(--ease-standard),
              border-color var(--dur-base) var(--ease-standard);
}
.ign-app-card:hover {
  transform: translateY(-2px);
  box-shadow: var(--shadow-3);
  border-color: rgba(121,57,7,0.20);
  text-decoration: none;
  color: inherit;
}
.ign-app-card__mark {
  width: 32px; height: 32px;
  border-radius: var(--r-2);
  background: var(--gradient-copper);
}
.ign-app-card__title {
  font-family: var(--ff-display);
  font-weight: 600;
  font-size: 19px;
  letter-spacing: -0.02em;
  color: var(--slateblue);
}
.ign-app-card__desc {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 13px;
  line-height: 1.55;
  color: var(--fg-2);
  margin-top: 6px;
}
.ign-app-card__arrow {
  position: absolute;
  right: 18px; top: 18px;
  font-family: var(--ff-display);
  font-size: 18px;
  color: var(--copper-solid);
  opacity: 0;
  transform: translateX(-4px);
  transition: opacity var(--dur-base) var(--ease-standard),
              transform var(--dur-base) var(--ease-standard);
}
.ign-app-card:hover .ign-app-card__arrow {
  opacity: 1;
  transform: translateX(0);
}

@media (max-width: 960px) {
  .ign-apps__grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 560px) {
  .ign-apps__grid { grid-template-columns: 1fr; }
}
</style>
```

---

## 3 · SEO/GEO-Notiz

- **Interne Verlinkung:** Jede Karte verlinkt auf den gefilterten Shop-Archiv (`?filter_einsatzbereich=bess` etc.). Perfekt für Topic-Cluster.
- **Filter-Parameter** greift, sobald STEP 4 (Shop-Archiv mit Bricks-Filter-Elementen) live ist — bis dahin zeigt der Link die volle Produktliste.
- **GEO-freundlich:** Kurze, konkrete Use-Case-Beschreibungen — LLMs können sie direkt in "Für welche Bereiche eignet sich ein Aerosol-Löschsystem?"-Antworten nutzen.

## 4 · Verifikation

- [ ] 4 Kacheln Desktop, 2 Tablet, 1 Mobile
- [ ] Copper-Gradient-Quadrat oben links
- [ ] Hover: Karte hebt sich leicht, Pfeil → erscheint rechts oben
- [ ] Klick geht auf `/produkt-kategorie/` mit Query-String `?filter_einsatzbereich=…`

## 5 · Anpassungspunkte

- **Use-Cases bearbeiten**: Im `$apps`-Array am Anfang des Blocks. Slug muss einem Term-Slug aus `pa_einsatzbereich` entsprechen.
- **Alternative Routen**: Wenn STEP 6 als CPT `ignitec_application` umgesetzt wird, kann `$url` auf `get_permalink()` des jeweiligen CPT-Eintrags umgestellt werden.

---

**Nach Verifikation → STEP 3.5 (Technologie-USP) freigeben.**
