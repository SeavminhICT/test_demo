@extends('layouts.app')

@push('styles')
  <style>
    .about-page {
      padding: 0 20px clamp(58px, 8vw, 96px);
    }

    .about-hero {
      position: relative;
      overflow: hidden;
      width: 100vw;
      margin-left: calc(50% - 50vw);
      padding: clamp(72px, 10vw, 132px) 20px;
      color: #fff;
      background:
        linear-gradient(115deg, rgba(7, 16, 35, 0.88), rgba(7, 16, 35, 0.42)),
        radial-gradient(circle at 84% 18%, rgba(255, 232, 166, 0.18), transparent 30%),
        radial-gradient(circle at 12% 18%, rgba(22, 201, 255, 0.22), transparent 30%),
        url('{{ asset('images/BG.jpg') }}') center / cover no-repeat;
    }

    .about-hero::after {
      content: '';
      position: absolute;
      inset: auto -10% -42% 42%;
      height: 340px;
      border-radius: 999px;
      background: linear-gradient(90deg, rgba(255, 232, 166, 0.16), rgba(22, 201, 255, 0.08));
      transform: rotate(-8deg);
    }

    .about-hero-inner {
      position: relative;
      z-index: 1;
      display: grid;
      grid-template-columns: minmax(0, 1.08fr) minmax(320px, 0.92fr);
      gap: clamp(28px, 6vw, 72px);
      align-items: center;
      width: min(1180px, 100%);
      margin: 0 auto;
    }

    .about-hero-copy {
      max-width: 780px;
      text-align: left;
    }

    .about-hero .section-kicker {
      color: #0f2747;
      background: rgba(255, 247, 219, 0.88);
      border: 1px solid rgba(255, 255, 255, 0.42);
      box-shadow: 0 14px 30px rgba(5, 18, 38, 0.18);
    }

    .about-hero h1 {
      margin: 0 0 18px;
      color: #fff7db;
      font-size: clamp(3rem, 7vw, 6.4rem);
      line-height: 0.94;
      letter-spacing: -0.075em;
      text-shadow:
        0 4px 18px rgba(0, 0, 0, 0.38),
        0 18px 54px rgba(5, 18, 38, 0.46);
    }

    .about-hero p {
      max-width: 650px;
      margin: 0 0 28px;
      color: #e9f7ff;
      font-size: clamp(1.02rem, 1.7vw, 1.22rem);
      line-height: 1.78;
      text-shadow: 0 3px 16px rgba(0, 0, 0, 0.34);
    }

    .about-hero-actions {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
    }

    .about-hero-actions .btn {
      color: #102039;
      background: linear-gradient(135deg, #ffe8a6, #ffffff);
      box-shadow: 0 14px 28px rgba(0, 0, 0, 0.22);
    }

    .about-hero-actions .btn-outline {
      color: #e9f7ff;
      background: rgba(6, 24, 48, 0.28);
      border-color: rgba(233, 247, 255, 0.52);
    }

    .about-hero-card,
    .about-stat {
      border: 1px solid rgba(255, 247, 219, 0.26);
      background: linear-gradient(145deg, rgba(12, 37, 70, 0.62), rgba(8, 23, 42, 0.44));
      box-shadow: 0 24px 70px rgba(0, 0, 0, 0.24);
      backdrop-filter: blur(18px);
    }

    .about-hero-card {
      position: relative;
      overflow: hidden;
      padding: clamp(28px, 5vw, 44px);
      border-radius: 30px;
    }

    .about-hero-card::after {
      content: '';
      position: absolute;
      right: -70px;
      bottom: -70px;
      width: 190px;
      height: 190px;
      border-radius: 50%;
      background: linear-gradient(135deg, rgba(22, 201, 255, 0.38), rgba(255, 232, 166, 0.10));
    }

    .about-hero-card span,
    .about-stat span {
      display: block;
      color: #bfeaff;
      font-family: var(--font-nav);
      font-size: 0.74rem;
      font-weight: 800;
      letter-spacing: 0.1em;
      text-transform: uppercase;
    }

    .about-hero-card strong {
      position: relative;
      z-index: 1;
      display: block;
      margin: 12px 0;
      color: #fff7db;
      font-family: var(--font-nav);
      font-size: clamp(1.8rem, 4vw, 3rem);
      line-height: 1.02;
      letter-spacing: -0.055em;
    }

    .about-hero-card p {
      position: relative;
      z-index: 1;
      margin: 0;
      color: #d9f1ff;
      font-size: 1rem;
      line-height: 1.7;
      text-shadow: none;
    }

    .about-stat-grid {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 14px;
      margin-top: 16px;
    }

    .about-stat {
      padding: 18px;
      border-radius: 22px;
    }

    .about-stat strong {
      display: block;
      margin-bottom: 6px;
      color: #ffe8a6;
      font-family: var(--font-nav);
      font-size: clamp(1.65rem, 4vw, 2.4rem);
      line-height: 1;
    }

    .about-section,
    .about-insights,
    .about-final-cta {
      width: min(1180px, 100%);
      margin: 0 auto 46px;
    }

    .about-section {
      margin-top: clamp(48px, 7vw, 86px);
      padding: clamp(34px, 6vw, 68px);
      border: 1px solid rgba(37, 99, 235, 0.14);
      border-radius: 34px;
      background:
        radial-gradient(circle at 10% 0%, rgba(255, 232, 166, 0.14), transparent 30%),
        radial-gradient(circle at 90% 8%, rgba(22, 201, 255, 0.12), transparent 34%),
        var(--surface);
      box-shadow: 0 24px 70px rgba(15, 23, 42, 0.10);
    }

    .about-values-grid {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 18px;
    }

    .about-value-card {
      position: relative;
      overflow: hidden;
      min-height: 250px;
      padding: 26px;
      border: 1px solid var(--line);
      border-radius: 26px;
      background: var(--surface-solid);
      box-shadow: var(--shadow-card);
      text-align: left;
      transition: transform 0.28s ease, box-shadow 0.28s ease, border-color 0.28s ease;
    }

    .about-value-card::before {
      content: '';
      position: absolute;
      inset: 0 0 auto;
      height: 5px;
      background: linear-gradient(90deg, var(--brand), #16c9ff);
    }

    .about-value-card:hover {
      transform: translateY(-6px);
      border-color: rgba(37, 99, 235, 0.34);
      box-shadow: var(--shadow-soft);
    }

    .about-value-card span {
      display: inline-flex;
      margin-bottom: 34px;
      color: rgba(37, 99, 235, 0.22);
      font-family: var(--font-nav);
      font-size: 3.2rem;
      font-weight: 800;
      line-height: 1;
      letter-spacing: -0.08em;
    }

    .about-value-card h3 {
      margin: 0 0 10px;
      color: var(--text);
      font-size: 1.34rem;
    }

    .about-value-card p {
      margin: 0;
      color: var(--text-soft);
      font-size: 0.98rem;
      line-height: 1.72;
    }

    .about-mantra {
      margin-top: 24px;
      padding: 22px;
      border: 1px solid rgba(37, 99, 235, 0.14);
      border-left: 5px solid var(--brand);
      border-radius: 22px;
      background: var(--brand-3);
      color: var(--text);
      font-size: 1.08rem;
      font-weight: 800;
      line-height: 1.65;
      text-align: center;
    }

    .about-insights {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 22px;
    }

    .fact-card {
      position: relative;
      overflow: hidden;
      min-height: 300px;
      padding: clamp(26px, 4vw, 36px);
      border: 1px solid rgba(37, 99, 235, 0.14);
      border-radius: 30px;
      background: var(--surface);
      box-shadow: var(--shadow-card);
      text-align: left;
      transition: transform 0.24s ease, box-shadow 0.24s ease;
    }

    .fact-card::before {
      content: '';
      position: absolute;
      inset: 0 0 auto;
      height: 6px;
      background: linear-gradient(90deg, #ffe8a6, var(--brand), #16c9ff);
    }

    .fact-card:hover {
      transform: translateY(-5px);
      box-shadow: var(--shadow-soft);
    }

    .fact-card h3 {
      margin: 0 0 14px;
      color: var(--text);
      font-size: clamp(1.5rem, 3vw, 2.1rem);
      line-height: 1.08;
      letter-spacing: -0.04em;
    }

    .fact-text {
      min-height: 90px;
      color: var(--text);
      font-size: 1.12rem;
      font-weight: 800;
      line-height: 1.65;
      margin-bottom: 14px;
    }

    .fact-meta {
      color: var(--text-soft);
      margin-bottom: 18px;
      font-size: 0.94rem;
      line-height: 1.6;
    }

    .fact-card .btn {
      border-radius: 16px;
      background: linear-gradient(135deg, var(--brand), #16c9ff);
      box-shadow: 0 16px 30px rgba(37, 99, 235, 0.18);
    }

    .about-final-cta {
      padding: clamp(38px, 7vw, 74px);
      text-align: center;
      border-radius: 34px;
      color: #fff;
      background:
        radial-gradient(circle at 18% 0%, rgba(255, 255, 255, 0.16), transparent 30%),
        linear-gradient(135deg, #123d9c, #0b7fe5 52%, #12b8d7);
      box-shadow: 0 24px 70px rgba(15, 23, 42, 0.18);
    }

    .about-final-cta .section-kicker {
      color: #e4f7ff;
      background: rgba(255, 255, 255, 0.16);
    }

    .about-final-cta h2 {
      max-width: 760px;
      margin: 0 auto 14px;
      color: #fff;
      font-size: clamp(2rem, 5vw, 4.2rem);
      line-height: 1;
      letter-spacing: -0.055em;
    }

    .about-final-cta p {
      max-width: 620px;
      margin: 0 auto 24px;
      color: rgba(255, 255, 255, 0.84);
      line-height: 1.7;
    }

    .about-final-cta .btn-outline {
      color: #fff;
      border-color: rgba(255, 255, 255, 0.4);
      background: rgba(255, 255, 255, 0.10);
    }

    .dark .about-hero-card,
    .dark .about-stat {
      border-color: rgba(255, 247, 219, 0.16);
      background: linear-gradient(145deg, rgba(15, 23, 42, 0.72), rgba(8, 23, 42, 0.52));
    }

    @media (max-width: 820px) {
      .about-hero {
        padding: 58px 18px;
      }

      .about-hero-inner {
        grid-template-columns: 1fr;
        text-align: center;
      }

      .about-hero-copy,
      .about-hero p {
        margin-left: auto;
        margin-right: auto;
        text-align: center;
      }

      .about-hero-actions {
        justify-content: center;
      }

      .about-values-grid,
      .about-insights {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 520px) {
      .about-page {
        padding-inline: 16px;
      }

      .about-stat-grid {
        grid-template-columns: 1fr;
      }

      .about-section {
        padding: 30px 18px;
        border-radius: 26px;
      }
    }
  </style>
@endpush

@section('content')
  <main id="main" class="about-page">
    <section class="about-hero" aria-labelledby="about-heading">
      <div class="about-hero-inner">
        <div class="about-hero-copy">
          <span class="section-kicker">Positive mindset</span>
          <h1 id="about-heading">Curiosity, kindness, and clear thinking.</h1>
          <p>A personal learning space built around a simple belief: when we stay curious and patient, challenges become practice and practice becomes growth.</p>

          <div class="about-hero-actions">
            <a href="#about-values" class="btn">Explore Values</a>
            <a href="{{ route('blog.index') }}" class="btn btn-outline">Read Blog</a>
          </div>
        </div>

        <aside aria-label="Mindset summary">
          <div class="about-hero-card">
            <span>Mindset mantra</span>
            <strong>Stay curious. Stay kind. Keep growing.</strong>
            <p>Positive thinking is not ignoring difficulty. It is choosing a useful next step with courage and care.</p>
          </div>

          <div class="about-stat-grid">
            <div class="about-stat">
              <strong>3</strong>
              <span>Values</span>
            </div>
            <div class="about-stat">
              <strong>2</strong>
              <span>Daily prompts</span>
            </div>
            <div class="about-stat">
              <strong>∞</strong>
              <span>Growth</span>
            </div>
          </div>
        </aside>
      </div>
    </section>

    <section class="about-section" id="about-values" aria-labelledby="values-heading">
      <div class="section-heading">
        <span class="section-kicker">Vision and mission</span>
        <h2 id="values-heading">Build confidence through learning and discovery</h2>
        <p>A positive mindset helps us see opportunities, and science helps us understand them.</p>
      </div>

      <div class="about-values-grid">
        <article class="about-value-card">
          <span>01</span>
          <h3>Learn With Curiosity</h3>
          <p>Ask better questions, explore patiently, and let discovery turn confusion into a path forward.</p>
        </article>

        <article class="about-value-card">
          <span>02</span>
          <h3>Think With Kindness</h3>
          <p>Use kindness as a learning tool so mistakes feel like feedback, not failure.</p>
        </article>

        <article class="about-value-card">
          <span>03</span>
          <h3>Grow Through Practice</h3>
          <p>Small consistent actions build confidence, clarity, and momentum over time.</p>
        </article>
      </div>

      <div class="about-mantra">
        Vision: build a world where positivity and knowledge help people grow.
      </div>
    </section>

    <section class="about-insights" aria-label="Daily insights">
      <div class="fact-card">
        <h3>Daily Positive Reflection</h3>
        <p class="fact-text" id="mindset-text">Loading your daily positive insight...</p>
        <p class="fact-meta" id="mindset-meta">Click below to reveal a new mindset thought.</p>
        <button class="btn" id="new-mindset-btn" type="button">New Thought</button>
      </div>

      <div class="fact-card" role="region" aria-live="polite" aria-label="Fact of the day">
        <h3>Science Fact of the Day</h3>
        <div class="fact-text" id="fact-text">Loading an interesting science fact...</div>
        <div class="fact-meta" id="fact-meta">Click below to discover another fact.</div>
        <button class="btn" id="new-fact-btn" type="button">New Fact</button>
      </div>
    </section>

    <section class="about-final-cta" aria-labelledby="about-next-heading">
      <span class="section-kicker">Keep exploring</span>
      <h2 id="about-next-heading">Turn mindset into action.</h2>
      <p>Read a reflection, try an experiment, or send a message if you want to connect around learning and growth.</p>
      <div class="btn-group">
        <a href="{{ route('experiments') }}" class="btn">Try Experiments</a>
        <a href="{{ route('contact') }}" class="btn btn-outline">Contact Me</a>
      </div>
    </section>
  </main>
@endsection

@push('scripts')
  <script>
    const mindsetThoughts = [
      'Small progress is still progress. Keep showing up.',
      'Curiosity turns confusion into a path forward.',
      'Practice makes hard things feel lighter over time.',
      'Kind thinking helps you learn without fear.',
    ];

    const scienceFacts = [
      'The human brain can form new neural connections through learning and practice.',
      'Plants use sunlight to turn carbon dioxide and water into energy through photosynthesis.',
      'The ocean helps regulate Earth temperature by storing and moving heat.',
      'DNA carries instructions that help living things grow, function, and reproduce.',
    ];

    function showRandomText(items, textId, metaId) {
      const text = document.getElementById(textId);
      const meta = document.getElementById(metaId);
      if (!text) return;

      text.textContent = items[Math.floor(Math.random() * items.length)];
      if (meta) meta.textContent = 'Refresh whenever you need a new idea.';
    }

    showRandomText(mindsetThoughts, 'mindset-text', 'mindset-meta');
    showRandomText(scienceFacts, 'fact-text', 'fact-meta');

    document.getElementById('new-mindset-btn')?.addEventListener('click', () => {
      showRandomText(mindsetThoughts, 'mindset-text', 'mindset-meta');
    });

    document.getElementById('new-fact-btn')?.addEventListener('click', () => {
      showRandomText(scienceFacts, 'fact-text', 'fact-meta');
    });
  </script>
@endpush
