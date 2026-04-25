# STEP 3.1 — Homepage · Hero (Mockup-aligned)

Vollbild-Hero auf dunklem Carrier mit Spark-Canvas, rotierenden Copper-Ringen, Aerosol-Generator-Unit und Hot-Spot-Nozzle als Key-Visual rechts. Inline-Stat-Micro unten (4 harte Fakten unmittelbar unter den CTAs).

**Quelle:** Mockup `extracted/mockups/home.html` (Hero-Sektion).

---

## 1 · Platzierung

**Bricks → Pages → Startseite (Front-Page)** — oben als **erste Section** einen **Container (Full-Width)** einfügen mit Inhalt: **1 Code-Element**.

- Code-Element: Execute code ✅ · Render without wrapping tag ✅
- Container: `padding: 0`, `max-width: none`

## 2 · Meta / SEO Vorschläge

```
Meta-Title:       Ignitec — Kondensierte Aerosol-Löschsysteme · Serie ST
Meta-Description: Kondensierte Aerosol-Löschgeneratoren für Schaltschrank, BESS und Objektschutz. ≤ 20 s Reaktion, GWP 0, EN 15276. Ausstoßzeit, Auslegung und Datenblatt binnen 48 h.
```

## 3 · Code-Widget-Inhalt

```html
<section class="ign-hero" aria-label="Ignitec Hero">

  <canvas class="ign-hero__canvas" id="ign-hero-canvas" aria-hidden="true"></canvas>
  <div class="ign-hero__heatglow" aria-hidden="true"></div>

  <div class="ign-hero__keyvisual" aria-hidden="true">
    <div class="ign-hero__ring ign-hero__ring--1"></div>
    <div class="ign-hero__ring ign-hero__ring--2"></div>
    <div class="ign-hero__ring ign-hero__ring--3"></div>
    <div class="ign-hero__unit"></div>
    <div class="ign-hero__nozzle"></div>
  </div>

  <div class="ign-hero__content">
    <div class="ign-hero__copy">
      <div class="ign-hero__eyebrow">Reaction · Protection · Solution</div>

      <h1 class="ign-hero__headline">
        Wenn ein Funke<br>
        über Millionen<br>
        <em class="ign-hero__headline-accent">entscheidet.</em>
      </h1>

      <p class="ign-hero__lead">
        Kondensierte Aerosol-Löschgeneratoren für Schaltschrank, BESS und Objektschutz.
        Reagiert in ≤ 20 Sekunden, rückstandsarm, <strong>GWP 0</strong> — und passt in Räume,
        für die klassische Löschanlagen zu groß sind.
      </p>

      <div class="ign-hero__ctas">
        <a class="ign-btn ign-btn--primary" href="/konfigurator/">Konfigurator starten →</a>
        <a class="ign-btn ign-btn--ghost" href="/downloads/datenblaetter/">Datenblätter ansehen</a>
      </div>

      <div class="ign-hero__statmicro">
        <div class="ign-hero__stat"><div class="ign-hero__stat-n">≤ 20 s</div><div class="ign-hero__stat-l">Reaktionszeit</div></div>
        <div class="ign-hero__stat"><div class="ign-hero__stat-n">0</div><div class="ign-hero__stat-l">GWP / ODP</div></div>
        <div class="ign-hero__stat"><div class="ign-hero__stat-n">8</div><div class="ign-hero__stat-l">Generatorgrößen</div></div>
        <div class="ign-hero__stat"><div class="ign-hero__stat-n">EN 15276</div><div class="ign-hero__stat-l">Typprüfung</div></div>
      </div>
    </div>
    <div></div>
  </div>
</section>

<style>
.ign-hero {
  position: relative;
  min-height: 820px;
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

/* ===== KEY-VISUAL (Aerosol-Generator + rotierende Ringe + Hot-Spot) ===== */
.ign-hero__keyvisual {
  position: absolute;
  right: -40px; top: 120px; bottom: 0;
  width: 52%;
  z-index: 2;
  pointer-events: none;
  display: flex; align-items: center; justify-content: center;
}
.ign-hero__ring {
  position: absolute;
  border-radius: 50%;
  border: 1px solid rgba(200,105,30,.18);
  animation: ign-hero-spin 90s linear infinite;
}
.ign-hero__ring--1 { width: 640px; height: 640px; }
.ign-hero__ring--2 {
  width: 480px; height: 480px;
  border-color: rgba(244,169,98,.12);
  animation-duration: 60s;
  animation-direction: reverse;
}
.ign-hero__ring--3 {
  width: 320px; height: 320px;
  border-color: rgba(232,98,42,.22);
}
@keyframes ign-hero-spin { to { transform: rotate(360deg); } }
@media (prefers-reduced-motion: reduce) {
  .ign-hero__ring { animation: none; }
}

.ign-hero__unit {
  position: relative;
  width: 280px; height: 340px;
  border-radius: 14px;
  background: linear-gradient(160deg, #1A1210 0%, #3A1612 35%, #80401D 70%, #D06E3D 100%);
  box-shadow:
    0 60px 120px rgba(200,105,30,.22),
    0 20px 40px rgba(0,0,0,.45),
    inset 0 1px 0 rgba(255,200,150,.25);
  overflow: hidden;
}
.ign-hero__unit::before {
  content: "";
  position: absolute;
  top: 22px; left: 22px; right: 22px;
  height: 18px;
  background: linear-gradient(90deg, transparent, rgba(255,200,150,.35), transparent);
  border-radius: 2px;
}
.ign-hero__unit::after {
  content: "IGNI-ST250";
  position: absolute;
  left: 0; right: 0; bottom: 18px;
  text-align: center;
  font-family: var(--ff-mono);
  font-weight: 500;
  font-size: 10px;
  letter-spacing: 0.3em;
  color: rgba(245,242,236,.7);
}
.ign-hero__nozzle {
  position: absolute;
  bottom: 60%; left: 50%;
  width: 90px; height: 90px;
  border-radius: 50%;
  background: radial-gradient(circle, #FFE8C4 0%, #F4A962 40%, #C8691E 80%, transparent 100%);
  transform: translate(-50%, 50%);
  opacity: 0.85;
  mix-blend-mode: screen;
  filter: blur(2px);
}

/* ===== CONTENT (left column) ===== */
.ign-hero__content {
  position: relative; z-index: 3;
  max-width: var(--container-max);
  margin: 0 auto;
  padding: 200px 28px 120px;
  display: grid;
  grid-template-columns: 1.3fr 1fr;
  gap: 56px;
  align-items: center;
}
.ign-hero__copy { max-width: 700px; }

.ign-hero__eyebrow {
  font-family: var(--ff-mono);
  font-weight: 500;
  font-size: 11px;
  letter-spacing: 0.26em;
  text-transform: uppercase;
  color: var(--ember);
  display: inline-flex;
  align-items: center;
  gap: 12px;
}
.ign-hero__eyebrow::before {
  content: "";
  width: 28px; height: 1px;
  background: currentColor;
}

.ign-hero__headline {
  font-family: var(--ff-display);
  font-weight: 500;
  font-size: clamp(48px, 6.4vw, 84px);
  line-height: 1.02;
  letter-spacing: -0.035em;
  color: var(--bone);
  margin: 20px 0 28px;
}
.ign-hero__headline-accent {
  font-family: var(--ff-display);
  font-weight: 500;
  font-style: italic;
  background: linear-gradient(92deg, #B7591E 0%, #E89A5C 55%, #F0B074 100%);
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
  margin: 0 0 32px;
}
.ign-hero__lead strong { color: var(--bone); font-weight: 600; }

.ign-hero__ctas {
  display: flex;
  gap: 12px;
  flex-wrap: wrap;
}

.ign-hero__statmicro {
  display: flex;
  gap: 36px;
  margin-top: 48px;
  padding-top: 32px;
  border-top: 1px solid rgba(245,242,236,0.12);
  flex-wrap: wrap;
}
.ign-hero__stat-n {
  font-family: var(--ff-display);
  font-weight: 900;
  font-size: 36px;
  letter-spacing: -0.02em;
  color: var(--bone);
}
.ign-hero__stat-l {
  font-family: var(--ff-mono);
  font-weight: 500;
  font-size: 11px;
  letter-spacing: 0.18em;
  text-transform: uppercase;
  color: rgba(245,242,236,0.55);
  margin-top: 4px;
}

@media (max-width: 1080px) {
  .ign-hero__keyvisual { opacity: 0.55; }
  .ign-hero__unit { width: 220px; height: 280px; }
}
@media (max-width: 760px) {
  .ign-hero { min-height: 720px; }
  .ign-hero__content {
    grid-template-columns: 1fr;
    padding: 140px 24px 72px;
  }
  .ign-hero__keyvisual { width: 100%; opacity: 0.25; }
  .ign-hero__statmicro { gap: 24px; }
  .ign-hero__stat-n { font-size: 28px; }
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
  const COUNT = reduced ? 20 : 120;
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

  const io = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting && !raf && !reduced) tick();
      else if (!e.isIntersecting && raf) { cancelAnimationFrame(raf); raf = null; }
    });
  }, { threshold: 0.02 });
  io.observe(canvas);
  tick();
})();
</script>
```

---

## 4 · GEO/SEO-Notiz

- **H1** sitzt auf dunklem Carrier (Brand-Regel "Hero Claim Exception" erlaubt italic + copper-gradient nur auf einem Wort)
- **Stat-Micro** zeigt 4 SEO-relevante Kernfakten direkt unter den CTAs — Lighthouse-Boost und LLM-zitierfähig
- **Eyebrow** ist die Brand-Triade "Reaction · Protection · Solution" mit dem Brand-Hairline-Strich davor

## 5 · Verifikation

- [ ] Kupferne Ringe rotieren langsam (90s/60s)
- [ ] Aerosol-Unit zeigt SKU "IGNI-ST250" als Mock
- [ ] Nozzle-Glow leuchtet warm zentriert
- [ ] Spark-Canvas zeigt 120 Partikel (20 bei Reduced-Motion)
- [ ] Stat-Micro zeigt 4 Werte, mit Trennlinie oben
- [ ] H1 mit italic + Copper-Gradient nur auf "entscheidet."
- [ ] Mobile: Key-Visual als dezenter Hintergrund (Opacity 0.25), Content single-column

## 6 · Anpassungspunkte

- **Headline-Wort `entscheidet.`** — bleibt das einzige italic+gradient-Wort. **Nicht** auf andere Wörter ausdehnen (Brand-Regel)
- **Unit-Mock** kann durch ein echtes 3D-PNG ersetzt werden — `.ign-hero__unit` durch `<img>` austauschen, das Mock-CSS entfernen
- **CTAs**: `/konfigurator/`, `/downloads/datenblaetter/` — URLs nach Bedarf anpassen
