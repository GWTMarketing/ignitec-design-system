# STEP 3.1 — Homepage · Hero mit Spark-Canvas

Dunkler Vollbild-Hero mit animiertem Spark-Canvas (140 Partikel, Copper-Töne), editorialer Claim-Zeile und zwei CTAs. Rechter 45%-Slot für ein Key-Visual (PNG).

**SEO-Rolle:** H1 der Startseite. Meta-Title + Description werden unten als Vorschlag geliefert.

---

## 1 · Platzierung

**Bricks → Pages → Startseite (Front-Page) editieren** — oben als **erste Section** einen **Container (Full-Width)** einfügen mit Inhalt: **1 Code-Element**.

- Code-Element: Execute code ✅, Render without wrapping tag ✅
- Container: `padding: 0`, `max-width: none` (Hero ist full-bleed)

## 2 · Meta / SEO Vorschläge (Startseite)

```
Meta-Title:       Ignitec — Kondensierte Aerosol-Löschsysteme · Serie ST
Meta-Description: Kondensierte Aerosol-Löschgeneratoren für Schaltschrank, BESS und Objektschutz. Reaktion ≤ 20 s, rückstandsarm, GWP 0. Auslegung nach CEN/TR 15276-1 innerhalb von 48 h.
Primary Keyword:  Aerosol-Löschgenerator
Secondary:        Aerosol-Löschanlage, BESS-Brandschutz, Schaltschrank-Brandschutz
```

---

## 3 · Code-Widget-Inhalt

```html
<section class="ign-hero" aria-label="Ignitec Hero">

  <canvas class="ign-hero__canvas" id="ign-hero-canvas" aria-hidden="true"></canvas>

  <div class="ign-hero__heatglow" aria-hidden="true"></div>
  <div class="ign-hero__keyvisual" aria-hidden="true"></div>

  <div class="ign-hero__content">
    <div class="ign-hero__copy">
      <div class="ign-hero__eyebrow">
        <span class="ign-hero__rule"></span>
        REACTION · PROTECTION · SOLUTION
      </div>

      <h1 class="ign-hero__headline">
        Wenn ein Funke<br>
        über Millionen<br>
        <span class="ign-hero__headline-accent">entscheidet.</span>
      </h1>

      <p class="ign-hero__lead">
        Kondensierte Aerosol-Löschgeneratoren für Schaltschrank, BESS und Objektschutz.
        Reagiert in ≤ 20 s, rückstandsarm, <strong>GWP 0</strong>.
      </p>

      <div class="ign-hero__ctas">
        <a class="ign-btn ign-btn--primary" href="/konfigurator/">Konfigurator starten</a>
        <a class="ign-btn ign-btn--ghost" href="/downloads/datenblaetter/">Datenblätter ansehen</a>
      </div>

      <ul class="ign-hero__trust" aria-label="Zertifizierungen und Standards">
        <li>CEN/TR 15276-1</li>
        <li>ISO 15779</li>
        <li>VdS</li>
        <li>GWP 0</li>
        <li>ODP 0</li>
      </ul>
    </div>
  </div>
</section>

<style>
.ign-hero {
  position: relative;
  min-height: 100vh;
  background: #0A0B0D;
  overflow: hidden;
  isolation: isolate;
  color: var(--bone);
}
.ign-hero__canvas {
  position: absolute; inset: 0;
  width: 100%; height: 100%;
  z-index: 0;
  pointer-events: none;
}
.ign-hero__heatglow {
  position: absolute;
  left: 0; right: 0; bottom: -200px;
  height: 500px;
  background: radial-gradient(ellipse at center, rgba(200,105,30,.28) 0%, rgba(200,105,30,0) 60%);
  filter: blur(30px);
  pointer-events: none;
  z-index: 1;
}
.ign-hero__keyvisual {
  position: absolute;
  right: 0; top: 0; bottom: 0;
  width: 45%;
  z-index: 2;
  pointer-events: none;
  /* Bei Bereitstellung eines PNG:
     background-image: url('/wp-content/uploads/hero-keyvisual.png');
     background-repeat: no-repeat;
     background-position: right center;
     background-size: contain; */
}
.ign-hero__content {
  position: relative; z-index: 3;
  max-width: var(--container-max);
  margin: 0 auto;
  padding: 180px 28px 96px;
  display: grid;
  grid-template-columns: 1.25fr 1fr;
  gap: 56px;
  align-items: center;
}
.ign-hero__copy { max-width: 680px; }

.ign-hero__eyebrow {
  font-family: var(--ff-mono);
  font-weight: 500;
  font-size: 11px;
  letter-spacing: 0.26em;
  text-transform: uppercase;
  color: var(--ember);
  margin-bottom: 20px;
  display: flex; align-items: center; gap: 14px;
}
.ign-hero__rule {
  width: 34px; height: 1px;
  background: var(--ember);
  display: inline-block;
}
.ign-hero__headline {
  font-family: var(--ff-display);
  font-weight: 500;
  font-size: clamp(44px, 6.4vw, 84px);
  line-height: 1.02;
  letter-spacing: -0.035em;
  color: var(--bone);
  margin: 0;
}
.ign-hero__headline-accent {
  font-family: var(--ff-display);
  font-weight: 500;
  font-style: italic;
  background: var(--gradient-text-ember);
  -webkit-background-clip: text;
  background-clip: text;
  -webkit-text-fill-color: transparent;
  color: transparent;
}
.ign-hero__lead {
  font-family: var(--ff-body);
  font-weight: 300;
  font-size: 19px;
  line-height: 1.55;
  color: rgba(245,242,236,0.82);
  max-width: 54ch;
  margin-top: 28px;
  margin-bottom: 32px;
}
.ign-hero__lead strong { color: var(--bone); font-weight: 600; }

.ign-hero__ctas {
  display: flex;
  gap: 12px;
  flex-wrap: wrap;
}

.ign-hero__trust {
  list-style: none;
  padding: 0;
  margin: 44px 0 0 0;
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  font-family: var(--ff-mono);
  font-size: 11px;
  letter-spacing: 0.18em;
  text-transform: uppercase;
  color: rgba(245,242,236,0.55);
}
.ign-hero__trust li {
  padding-left: 16px;
  position: relative;
}
.ign-hero__trust li::before {
  content: "";
  position: absolute;
  left: 0; top: 50%;
  width: 8px; height: 1px;
  background: var(--copper-light);
  transform: translateY(-50%);
}

@media (max-width: 960px) {
  .ign-hero__content {
    grid-template-columns: 1fr;
    padding: 140px 24px 72px;
  }
  .ign-hero__keyvisual { width: 100%; opacity: 0.25; }
}
@media (max-width: 560px) {
  .ign-hero__content { padding: 120px 20px 64px; }
  .ign-hero__lead { font-size: 17px; }
  .ign-hero__ctas .ign-btn { flex: 1 1 auto; }
}
</style>

<script>
(function () {
  const canvas = document.getElementById('ign-hero-canvas');
  if (!canvas) return;
  const ctx = canvas.getContext('2d');
  let W, H, raf;
  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  const dpr = Math.min(window.devicePixelRatio || 1, 2);
  const resize = () => {
    W = canvas.offsetWidth;
    H = canvas.offsetHeight;
    canvas.width  = W * dpr;
    canvas.height = H * dpr;
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
  };
  resize();
  window.addEventListener('resize', resize);

  const COLORS = [
    'rgba(200,105,30,',
    'rgba(255,107,28,',
    'rgba(244,169,98,',
  ];
  const COUNT = reduced ? 25 : 140;
  const particles = [];

  const makeParticle = (init) => ({
    x: Math.random() * W,
    y: init ? Math.random() * H : H + Math.random() * 60,
    vy: -(0.35 + Math.random() * 0.9),
    vx: (Math.random() - 0.5) * 0.4,
    r: 0.6 + Math.random() * 1.8,
    life: 0,
    maxLife: 180 + Math.random() * 240,
    tw: Math.random() * 10,
    color: COLORS[Math.floor(Math.random() * COLORS.length)],
  });

  for (let i = 0; i < COUNT; i++) particles.push(makeParticle(true));

  const tick = () => {
    ctx.clearRect(0, 0, W, H);
    ctx.globalCompositeOperation = 'lighter';
    for (let i = 0; i < particles.length; i++) {
      const p = particles[i];
      p.life++;
      p.tw += 0.05;
      p.x += p.vx + Math.sin(p.tw) * 0.25;
      p.y += p.vy;
      p.vy -= 0.003;
      const t = p.life / p.maxLife;
      const alpha = Math.max(0, 1 - t) * (0.5 + 0.5 * Math.sin(p.tw));
      ctx.beginPath();
      ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
      ctx.fillStyle = p.color + alpha + ')';
      ctx.shadowColor = p.color + '0.9)';
      ctx.shadowBlur = 14;
      ctx.fill();
      if (p.life > p.maxLife || p.y < -10) {
        Object.assign(particles[i], makeParticle(false));
      }
    }
    ctx.globalCompositeOperation = 'source-over';
    ctx.shadowBlur = 0;
    if (!reduced) raf = requestAnimationFrame(tick);
  };

  // Nur animieren, wenn Hero sichtbar (spart CPU beim Scrollen)
  const io = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting && !raf && !reduced) {
        tick();
      } else if (!e.isIntersecting && raf) {
        cancelAnimationFrame(raf);
        raf = null;
      }
    });
  }, { threshold: 0.02 });
  io.observe(canvas);

  tick();
})();
</script>
```

---

## 4 · GEO-/LLM-freundlicher Kontext (unsichtbar, nur für Bots)

Direkt **unter** dem Code-Widget kann optional eine Bricks `Rich-Text`-Komponente mit `display: none` + `aria-hidden="true"` + strukturierter Summary eingefügt werden. Empfehlung: **lieber sichtbar und sinnvoll** als versteckt. Die Stat-Bar in STEP 3.2 übernimmt diese Rolle.

## 5 · Verifikation

- [ ] Canvas-Partikel animieren flüssig auf Desktop
- [ ] Reduced-Motion: Canvas zeigt 25 statische Funken, keine Animation
- [ ] H1 genau 1× im DOM
- [ ] `GWP 0` im Fließtext (relevanter Marketing-Claim)
- [ ] Trust-Bar unten zeigt 5 Standards
- [ ] Mobile: Copy single-column, Key-Visual 0.25 Opazität im Hintergrund
- [ ] Lighthouse Performance > 90 (Canvas pausiert außerhalb Viewport)

## 6 · Anpassungspunkte

- **Key-Visual PNG**: Upload in Mediathek, URL in `.ign-hero__keyvisual` `background-image` setzen.
- **Headline**: Im HTML (`Wenn ein Funke über Millionen entscheidet.`) direkt editieren.
- **CTAs**: `/konfigurator/`, `/downloads/datenblaetter/` — URLs anpassen.
- **Partikel-Anzahl**: `COUNT = 140` in JS, für mehr/weniger Dichte.
- **Partikel-Farben**: `COLORS`-Array im JS.

---

**Nach Verifikation → STEP 3.2 (Stat Bar) freigeben.**
