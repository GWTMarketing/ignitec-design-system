# STEP 1 — Header (Global)

Ein komplettes Code-Widget, das den globalen Header rendert. Pull-in via WordPress Nav-Menu (Slot `primary`), Sticky-Verhalten mit zwei Zuständen (transparent über Hero / solide auf Scroll), Mobile-Hamburger mit Off-Canvas.

---

## 1 · Bricks-Template anlegen

**Bricks → Templates → Add New**
- Name: `Ignitec Main Header`
- Template Type: **Header**
- Template Conditions: **Entire Website**

Im Template genau **1 Section** → darin **1 Code-Element** einfügen.

## 2 · Code-Element konfigurieren

Im Code-Element:
- **Execute code**: ✅ aktivieren (damit PHP läuft — Bricks 1.9.8+ erfordert zusätzlich die Signatur; speichere einmal, damit die Signatur gesetzt wird)
- **Render without wrapping tag**: ✅ aktivieren

## 3 · Nav-Menü "Hauptnavigation" im WP-Admin anlegen

**Design → Menüs → Menü erstellen**
- Name: `Hauptnavigation`
- Einträge: Technologie · Produkte · Anwendungen · Referenzen · Wissen · Über · Kontakt
- Menü-Position: `Hauptnavigation (Header)` setzen

---

## 4 · Code-Widget-Inhalt

**Komplett in das Bricks Code-Element einfügen:**

```php
<?php
/**
 * IGNITEC · Header (Bricks Code Element)
 * SEO: <header> semantisch, Logo als H1 auf Startseite vermeiden (Bricks-Page-Header übernimmt das).
 * A11y: nav[aria-label], Skip-Link, aria-expanded für Mobile-Toggle.
 */
$menu_locations = get_nav_menu_locations();
$menu_obj       = isset( $menu_locations['primary'] ) ? wp_get_nav_menu_object( $menu_locations['primary'] ) : null;
$menu_items     = $menu_obj ? wp_get_nav_menu_items( $menu_obj->term_id ) : [];
$logo_url       = get_stylesheet_directory_uri() . '/assets/logo-full-white.png';
$cta_url        = '/kontakt/';
$cta_label      = 'Angebot anfordern';
?>

<a class="ign-skiplink" href="#content">Zum Hauptinhalt springen</a>

<header class="ign-header" id="ign-header" data-state="top">
  <div class="ign-header__inner">

    <a class="ign-header__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Ignitec — Startseite">
      <img src="<?php echo esc_url( $logo_url ); ?>" alt="Ignitec" width="148" height="36" decoding="async">
    </a>

    <nav class="ign-header__nav" aria-label="Hauptnavigation">
      <ul class="ign-header__menu">
        <?php if ( $menu_items ) : foreach ( $menu_items as $item ) : ?>
          <li class="ign-header__menu-item">
            <a href="<?php echo esc_url( $item->url ); ?>"
               class="ign-header__link<?php echo in_array( 'current-menu-item', (array) $item->classes, true ) ? ' is-active' : ''; ?>">
              <?php echo esc_html( $item->title ); ?>
            </a>
          </li>
        <?php endforeach; endif; ?>
      </ul>
    </nav>

    <span class="ign-header__region" aria-label="Region">DE · AT</span>

    <a class="ign-btn ign-btn--primary ign-header__cta" href="<?php echo esc_url( $cta_url ); ?>">
      <?php echo esc_html( $cta_label ); ?>
    </a>

    <button class="ign-header__burger"
            aria-expanded="false"
            aria-controls="ign-offcanvas"
            aria-label="Menü öffnen">
      <span></span><span></span><span></span>
    </button>
  </div>
</header>

<aside class="ign-offcanvas" id="ign-offcanvas" aria-hidden="true">
  <div class="ign-offcanvas__scrim" data-close></div>
  <div class="ign-offcanvas__panel" role="dialog" aria-modal="true" aria-label="Navigation">
    <button class="ign-offcanvas__close" aria-label="Menü schließen" data-close>×</button>
    <nav aria-label="Mobile Navigation">
      <ul class="ign-offcanvas__menu">
        <?php if ( $menu_items ) : foreach ( $menu_items as $item ) : ?>
          <li>
            <a href="<?php echo esc_url( $item->url ); ?>">
              <?php echo esc_html( $item->title ); ?>
            </a>
          </li>
        <?php endforeach; endif; ?>
      </ul>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ign-offcanvas__logo" aria-label="Ignitec — Startseite">
        <img src="<?php echo esc_url( $logo_url ); ?>" alt="Ignitec" width="120" height="29" decoding="async">
      </a>
    </nav>
    <a class="ign-btn ign-btn--primary ign-offcanvas__cta" href="<?php echo esc_url( $cta_url ); ?>">
      <?php echo esc_html( $cta_label ); ?>
    </a>
    <div class="ign-offcanvas__meta">
      <span class="claim">REACTION · PROTECTION · SOLUTION</span><br>
      <small>office@ignitec.at</small>
    </div>
  </div>
</aside>

<style>
/* ============ HEADER ============ */
.ign-skiplink {
  position: absolute; left: -9999px; top: 0; z-index: 9999;
  background: var(--slateblue); color: var(--bone);
  padding: 10px 16px; border-radius: var(--r-3);
}
.ign-skiplink:focus { left: 12px; top: 12px; }

.ign-header {
  position: sticky; top: 0; left: 0; right: 0; z-index: 50;
  padding: 18px 28px;
  background: linear-gradient(180deg, rgba(10,11,13,.92) 0%, rgba(10,11,13,.6) 70%, transparent 100%);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border-bottom: 1px solid rgba(200,105,30,.08);
  transition: background var(--dur-base) var(--ease-standard),
              padding var(--dur-base) var(--ease-standard),
              border-color var(--dur-base) var(--ease-standard);
}
.ign-header[data-state="scrolled"] {
  background: rgba(11,18,28,0.96);
  padding: 12px 28px;
  border-bottom-color: rgba(200,105,30,.20);
}
.ign-header__inner {
  max-width: var(--container-max);
  margin: 0 auto;
  display: flex; align-items: center; gap: 32px;
}
.ign-header__logo {
  display: flex; align-items: center; gap: 10px;
  color: var(--bone); text-decoration: none;
}
.ign-header__logo:hover { color: var(--bone); text-decoration: none; }
.ign-header__logo img {
  display: block;
  height: 30px;
  width: auto;
}
.ign-header[data-state="scrolled"] .ign-header__logo img { height: 26px; }
.ign-offcanvas__logo {
  margin-top: auto;
  display: inline-block;
}
.ign-offcanvas__logo img {
  display: block;
  height: 26px;
  width: auto;
  filter: none;
}
.ign-header__nav { flex: 1; }
.ign-header__menu {
  display: flex; gap: 22px;
  list-style: none; padding: 0; margin: 0;
}
.ign-header__link {
  font-family: var(--ff-body);
  font-weight: 500; font-size: 14px;
  color: rgba(245,242,236,0.82);
  text-decoration: none;
  padding: 6px 2px;
  border-bottom: 2px solid transparent;
  transition: color var(--dur-fast) var(--ease-standard),
              border-color var(--dur-fast) var(--ease-standard);
}
.ign-header__link:hover { color: #F4A962; border-bottom-color: transparent; text-decoration: none; }
.ign-header__link.is-active { color: #F4A962; border-bottom-color: #C8691E; }
.ign-header__region {
  font-family: var(--ff-mono);
  font-size: 11px; letter-spacing: 0.2em;
  text-transform: uppercase;
  color: rgba(245,242,236,0.55);
}
.ign-header__cta {
  font-size: 13px; padding: 10px 18px;
}
.ign-header__burger {
  display: none;
  width: 42px; height: 42px;
  background: transparent;
  border: 1px solid rgba(245,242,236,0.28);
  border-radius: var(--r-3);
  cursor: pointer;
  padding: 0;
  flex-direction: column; align-items: center; justify-content: center;
  gap: 5px;
}
.ign-header__burger span {
  display: block; width: 18px; height: 2px;
  background: var(--bone); border-radius: 2px;
  transition: transform var(--dur-base) var(--ease-standard),
              opacity var(--dur-fast) var(--ease-standard);
}

/* ============ OFF-CANVAS (Mobile) ============ */
.ign-offcanvas {
  position: fixed; inset: 0; z-index: 60;
  pointer-events: none;
  visibility: hidden;
}
.ign-offcanvas[data-open="true"] {
  pointer-events: auto;
  visibility: visible;
}
.ign-offcanvas__scrim {
  position: absolute; inset: 0;
  background: rgba(11,18,28,0);
  transition: background var(--dur-base) var(--ease-standard);
}
.ign-offcanvas[data-open="true"] .ign-offcanvas__scrim {
  background: rgba(11,18,28,0.72);
}
.ign-offcanvas__panel {
  position: absolute; top: 0; right: 0; bottom: 0;
  width: min(88vw, 420px);
  background: var(--ink-100);
  color: var(--bone);
  padding: 72px 32px 32px;
  display: flex; flex-direction: column; gap: 24px;
  transform: translateX(100%);
  transition: transform var(--dur-base) var(--ease-standard);
  box-shadow: var(--shadow-4);
  overflow-y: auto;
}
.ign-offcanvas[data-open="true"] .ign-offcanvas__panel {
  transform: translateX(0);
}
.ign-offcanvas__close {
  position: absolute; top: 18px; right: 18px;
  width: 40px; height: 40px;
  background: transparent;
  border: 1px solid rgba(245,242,236,0.28);
  border-radius: var(--r-3);
  color: var(--bone);
  font-size: 24px; line-height: 1;
  cursor: pointer;
}
.ign-offcanvas__menu {
  list-style: none; padding: 0; margin: 0;
  display: flex; flex-direction: column; gap: 4px;
}
.ign-offcanvas__menu a {
  display: block;
  font-family: var(--ff-display);
  font-weight: 500; font-size: 22px;
  color: var(--bone);
  padding: 12px 0;
  border-bottom: 1px solid rgba(245,242,236,0.08);
  text-decoration: none;
}
.ign-offcanvas__menu a:hover { color: #F4A962; text-decoration: none; }
.ign-offcanvas__cta { align-self: flex-start; }
.ign-offcanvas__meta {
  margin-top: auto;
  color: rgba(245,242,236,0.55);
  font-size: 13px;
}

/* ============ RESPONSIVE ============ */
@media (max-width: 960px) {
  .ign-header__nav,
  .ign-header__region,
  .ign-header__cta { display: none; }
  .ign-header__burger { display: inline-flex; }
}
</style>

<script>
(function () {
  const header    = document.getElementById('ign-header');
  const burger    = document.querySelector('.ign-header__burger');
  const offcanvas = document.getElementById('ign-offcanvas');
  const closers   = offcanvas ? offcanvas.querySelectorAll('[data-close]') : [];

  // Scroll-State
  if (header) {
    const onScroll = () => {
      header.dataset.state = window.scrollY > 32 ? 'scrolled' : 'top';
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  // Off-Canvas Toggle
  const open = () => {
    offcanvas.dataset.open = 'true';
    offcanvas.setAttribute('aria-hidden', 'false');
    burger.setAttribute('aria-expanded', 'true');
    document.body.style.overflow = 'hidden';
  };
  const close = () => {
    offcanvas.dataset.open = 'false';
    offcanvas.setAttribute('aria-hidden', 'true');
    burger.setAttribute('aria-expanded', 'false');
    document.body.style.overflow = '';
  };
  if (burger) burger.addEventListener('click', open);
  closers.forEach(el => el.addEventListener('click', close));
  document.addEventListener('keydown', e => { if (e.key === 'Escape') close(); });
})();
</script>
```

---

## 5 · Verifikation

- [ ] Header zeigt sich über Hero mit Transparenz/Blur
- [ ] Nach 32 px Scrollen wechselt er auf solide `--ink-100`-Farbe
- [ ] Menü-Einträge kommen aus WP-Menü `primary`
- [ ] Mobil < 960 px: Hamburger sichtbar, Off-Canvas funktioniert
- [ ] ESC schließt Off-Canvas, Tab-Focus bleibt sauber (Skip-Link funktioniert)
- [ ] Keine CLS-Verschiebung beim Laden (Layout stabil)

## 6 · Anpassungspunkte (im Code)

- **Logo-Datei:** Erwartet wird `wp-content/themes/ignitec-child/assets/logo-full-white.png` (aus dem Design-System unter `extracted/assets/logo-full-white.png` kopieren). Bei Bedarf in `$logo_url` auf einen anderen Pfad zeigen.
- **CTA-URL**: `$cta_url` am Anfang des Blocks umstellen (derzeit `/kontakt/`).
- **Region-Label**: String `DE · AT` im HTML direkt anpassen oder via Bricks Options auslagern.
- **Farbe "aktiv"**: `#F4A962` in `.ign-header__link.is-active` — bei Bedarf austauschen.

---

**Nach Verifikation → STEP 2 (Footer) freigeben.**
