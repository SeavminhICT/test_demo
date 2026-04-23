@extends('layouts.app')

@push('styles')
  <style>
    .experiments-hero {
      position: relative;
      overflow: hidden;
      min-height: calc(100vh - 92px);
      display: grid;
      align-items: center;
      padding: clamp(70px, 10vw, 126px) 20px;
      color: #fff;
      background:
        linear-gradient(115deg, rgba(7, 16, 35, 0.86), rgba(7, 16, 35, 0.42)),
        radial-gradient(circle at 82% 16%, rgba(255, 232, 166, 0.18), transparent 30%),
        radial-gradient(circle at 14% 18%, rgba(22, 201, 255, 0.22), transparent 30%),
        url('{{ asset('images/BG.jpg') }}') no-repeat center/cover;
    }

    .experiments-hero::after {
      content: '';
      position: absolute;
      inset: auto -10% -42% 42%;
      height: 340px;
      border-radius: 999px;
      background: linear-gradient(90deg, rgba(255, 232, 166, 0.16), rgba(22, 201, 255, 0.08));
      transform: rotate(-8deg);
    }

    .experiments-hero-content {
      position: relative;
      z-index: 1;
      display: grid;
      grid-template-columns: minmax(0, 1.06fr) minmax(320px, 0.94fr);
      gap: clamp(28px, 6vw, 72px);
      align-items: center;
      width: min(1180px, 100%);
      margin: 0 auto;
      text-align: left;
      animation: rise-in 1s ease forwards;
    }

    .experiments-hero-copy {
      max-width: 760px;
    }

    .experiments-hero .section-kicker {
      color: #0f2747;
      background: rgba(255, 247, 219, 0.88);
      border: 1px solid rgba(255, 255, 255, 0.42);
      box-shadow: 0 14px 30px rgba(5, 18, 38, 0.18);
    }

    .experiments-hero h1 {
      max-width: 780px;
      margin: 0 0 18px;
      color: #fff7db;
      font-size: clamp(3rem, 7vw, 6.4rem);
      line-height: 0.94;
      letter-spacing: -0.075em;
      text-shadow:
        0 4px 18px rgba(0, 0, 0, 0.38),
        0 18px 54px rgba(5, 18, 38, 0.46);
    }

    .experiments-hero p {
      max-width: 650px;
      margin: 0 0 28px;
      color: #e9f7ff;
      font-size: clamp(1.02rem, 1.7vw, 1.22rem);
      line-height: 1.78;
      text-shadow: 0 3px 16px rgba(0, 0, 0, 0.34);
    }

    .experiments-hero-actions {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
      align-items: center;
    }

    .experiments-hero-actions .btn {
      color: #102039;
      background: linear-gradient(135deg, #ffe8a6, #ffffff);
      box-shadow: 0 14px 28px rgba(0, 0, 0, 0.22);
    }

    .experiments-hero-actions .btn-outline {
      color: #e9f7ff;
      background: rgba(6, 24, 48, 0.28);
      border-color: rgba(233, 247, 255, 0.52);
    }

    .experiments-hero-panel {
      display: grid;
      gap: 16px;
    }

    .experiments-panel-card,
    .experiments-stat {
      border: 1px solid rgba(255, 247, 219, 0.26);
      background: linear-gradient(145deg, rgba(12, 37, 70, 0.62), rgba(8, 23, 42, 0.44));
      box-shadow: 0 24px 70px rgba(0, 0, 0, 0.24);
      backdrop-filter: blur(18px);
    }

    .experiments-panel-card {
      position: relative;
      overflow: hidden;
      padding: clamp(28px, 5vw, 44px);
      border-radius: 30px;
    }

    .experiments-panel-card::after {
      content: '';
      position: absolute;
      right: -70px;
      bottom: -70px;
      width: 190px;
      height: 190px;
      border-radius: 50%;
      background: linear-gradient(135deg, rgba(22, 201, 255, 0.38), rgba(255, 232, 166, 0.10));
    }

    .experiments-panel-card span,
    .experiments-stat span {
      display: block;
      color: #bfeaff;
      font-family: var(--font-nav);
      font-size: 0.74rem;
      font-weight: 800;
      letter-spacing: 0.1em;
      text-transform: uppercase;
    }

    .experiments-panel-card strong {
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

    .experiments-panel-card p {
      position: relative;
      z-index: 1;
      margin: 0;
      color: #d9f1ff;
      font-size: 1rem;
      line-height: 1.7;
      text-shadow: none;
    }

    .experiments-stat-grid {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 14px;
    }

    .experiments-stat {
      padding: 18px;
      border-radius: 22px;
    }

    .experiments-stat strong {
      display: block;
      margin-bottom: 6px;
      color: #ffe8a6;
      font-family: var(--font-nav);
      font-size: clamp(1.7rem, 4vw, 2.6rem);
      line-height: 1;
    }

    .experiments-section {
      padding: clamp(64px, 8vw, 104px) 20px;
      width: 100%;
      max-width: 1240px;
      margin: 0 auto;
    }

    .experiments-section .section-heading {
      margin-bottom: 34px;
    }

    .experiments-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 24px;
    }

    .experiment-card {
      position: relative;
      overflow: hidden;
      min-height: 100%;
      border-radius: 28px;
      border: 1px solid rgba(37, 99, 235, 0.14);
      background:
        linear-gradient(180deg, rgba(255, 255, 255, 0.96), rgba(245, 250, 255, 0.92));
      box-shadow: 0 20px 48px rgba(15, 23, 42, 0.10);
      transition: transform 0.28s ease, box-shadow 0.28s ease, border-color 0.28s ease, filter 0.28s ease;
    }

    .experiment-card:hover {
      transform: translateY(-8px);
      border-color: rgba(37, 99, 235, 0.34);
      box-shadow: 0 26px 64px rgba(15, 23, 42, 0.16);
      filter: saturate(1.04);
    }

    .experiment-card-header {
      position: relative;
      overflow: hidden;
      padding: 28px 24px;
      color: white;
      text-align: left;
      background:
        radial-gradient(circle at 90% 0%, rgba(255, 232, 166, 0.24), transparent 34%),
        linear-gradient(135deg, #123d9c, #0b7fe5 56%, #12b8d7);
    }

    .experiment-card-header h3 {
      position: relative;
      z-index: 1;
      font-size: 1.35rem;
      line-height: 1.12;
      margin: 0 0 8px;
    }

    .experiment-emoji {
      position: relative;
      z-index: 1;
      display: inline-grid;
      place-items: center;
      width: 58px;
      height: 58px;
      margin-bottom: 18px;
      border-radius: 18px;
      background: rgba(255, 255, 255, 0.16);
      font-size: 2rem;
      backdrop-filter: blur(12px);
    }

    .experiment-level {
      position: relative;
      z-index: 1;
      display: inline-block;
      margin-top: 10px;
      padding: 6px 12px;
      border-radius: 999px;
      background: rgba(255, 247, 219, 0.18);
      font-size: 0.78rem;
      font-weight: 800;
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }

    .experiment-number {
      position: absolute;
      right: 20px;
      top: 18px;
      color: rgba(255, 255, 255, 0.18);
      font-family: var(--font-nav);
      font-size: 3.2rem;
      font-weight: 800;
      letter-spacing: -0.08em;
      line-height: 1;
    }

    .experiment-card-body {
      display: flex;
      min-height: 280px;
      flex-direction: column;
      padding: 24px;
    }

    .experiment-description {
      margin-bottom: 16px;
      color: var(--text-soft);
      font-size: 0.94rem;
      line-height: 1.7;
    }

    .experiment-what {
      margin-bottom: 16px;
      padding: 16px;
      border: 1px solid rgba(37, 99, 235, 0.14);
      border-left: 4px solid var(--brand);
      border-radius: 18px;
      background: rgba(12, 124, 255, 0.08);
      font-size: 0.9rem;
      line-height: 1.62;
    }

    .experiment-what strong {
      color: var(--brand);
    }

    .experiment-btn {
      margin-top: auto;
      width: 100%;
      padding: 13px 18px;
      border: none;
      border-radius: 16px;
      color: #fff;
      background: linear-gradient(135deg, #0f7cff, #16c9ff);
      box-shadow: 0 10px 20px rgba(12, 114, 214, 0.24);
      font-weight: 700;
      text-align: center;
      text-decoration: none;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .experiment-btn:hover {
      transform: translateY(-2px);
      background: linear-gradient(135deg, #0b68d9, #10abd9);
      box-shadow: 0 14px 24px rgba(12, 114, 214, 0.32);
    }

    .interactive-section {
      width: min(1240px, calc(100% - 40px));
      margin: 0 auto clamp(56px, 8vw, 100px);
      padding: clamp(44px, 7vw, 76px) 20px;
      border: 1px solid rgba(37, 99, 235, 0.14);
      border-radius: 34px;
      background:
        radial-gradient(circle at 10% 0%, rgba(255, 232, 166, 0.14), transparent 30%),
        radial-gradient(circle at 90% 8%, rgba(22, 201, 255, 0.16), transparent 34%),
        var(--surface);
      box-shadow: 0 24px 70px rgba(15, 23, 42, 0.10);
    }

    .interactive-section h2 {
      text-align: center;
      margin-bottom: 14px;
      color: var(--text);
      font-size: clamp(2.2rem, 5vw, 4.4rem);
      line-height: 1;
      letter-spacing: -0.055em;
    }

    .interactive-container {
      width: 100%;
      max-width: 1120px;
      margin: 0 auto;
    }

    .interactive-description {
      max-width: 760px;
      margin: 0 auto 36px;
      color: var(--text-soft);
      line-height: 1.7;
      text-align: center;
    }

    .focus-lab {
      display: grid;
      grid-template-columns: 320px minmax(0, 1fr);
      overflow: hidden;
      border: 1px solid rgba(37, 99, 235, 0.16);
      border-radius: 32px;
      background: rgba(255, 255, 255, 0.76);
      box-shadow: 0 24px 70px rgba(15, 23, 42, 0.14);
      backdrop-filter: blur(18px);
    }

    .lab-panel {
      position: relative;
      overflow: hidden;
      padding: clamp(28px, 4vw, 42px);
      color: #fff;
      background:
        radial-gradient(circle at 20% 0%, rgba(255, 232, 166, 0.20), transparent 32%),
        linear-gradient(160deg, #123d9c, #0b7fe5 52%, #12b8d7);
    }

    .lab-panel::after {
      content: '';
      position: absolute;
      right: -76px;
      bottom: -76px;
      width: 200px;
      height: 200px;
      border-radius: 50%;
      background: linear-gradient(135deg, rgba(255, 232, 166, 0.22), rgba(255, 255, 255, 0.06));
    }

    .lab-panel h3 {
      position: relative;
      z-index: 1;
      margin: 0 0 12px;
      color: #fff7db;
      font-size: clamp(2rem, 4vw, 3.1rem);
      line-height: 1.05;
      letter-spacing: -0.055em;
    }

    .lab-panel p {
      position: relative;
      z-index: 1;
      margin: 0 0 22px;
      color: rgba(255, 255, 255, 0.86);
      font-size: 0.98rem;
      line-height: 1.72;
    }

    .lab-rules {
      position: relative;
      z-index: 1;
      display: grid;
      gap: 12px;
      margin: 0 0 24px;
      padding: 0;
      list-style: none;
    }

    .lab-rules li {
      display: flex;
      gap: 10px;
      align-items: flex-start;
      padding: 12px;
      border-radius: 16px;
      background: rgba(255, 255, 255, 0.14);
      font-size: 0.9rem;
      line-height: 1.55;
    }

    .lab-rules span {
      display: inline-grid;
      flex: 0 0 24px;
      place-items: center;
      width: 24px;
      height: 24px;
      border-radius: 50%;
      color: #0b4ca5;
      background: #fff;
      font-weight: 900;
    }

    .difficulty-control {
      position: relative;
      z-index: 1;
      display: grid;
      gap: 9px;
      margin-top: 24px;
    }

    .difficulty-control label {
      color: rgba(255, 255, 255, 0.88);
      font-family: var(--font-nav);
      font-size: 0.78rem;
      font-weight: 800;
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }

    .difficulty-control select {
      width: 100%;
      padding: 12px 13px;
      border: 0;
      border-radius: 14px;
      color: #102039;
      background: #fff;
      font-weight: 800;
    }

    .lab-stage {
      padding: clamp(24px, 4vw, 38px);
    }

    .lab-stats {
      display: grid;
      grid-template-columns: repeat(4, minmax(0, 1fr));
      gap: 12px;
      margin-bottom: 20px;
    }

    .lab-stat {
      padding: 16px;
      border: 1px solid rgba(37, 99, 235, 0.14);
      border-radius: 18px;
      background: rgba(255, 255, 255, 0.58);
      box-shadow: 0 12px 24px rgba(15, 23, 42, 0.06);
    }

    .lab-stat span {
      display: block;
      margin-bottom: 6px;
      color: var(--text-soft);
      font-family: var(--font-nav);
      font-size: 0.68rem;
      font-weight: 800;
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }

    .lab-stat strong {
      color: var(--text);
      font-family: var(--font-nav);
      font-size: clamp(1.25rem, 3vw, 1.8rem);
      line-height: 1;
    }

    .challenge-card {
      display: grid;
      place-items: center;
      min-height: 300px;
      margin-bottom: 20px;
      padding: 28px;
      border: 1px solid rgba(37, 99, 235, 0.14);
      border-radius: 30px;
      background:
        linear-gradient(145deg, rgba(255, 255, 255, 0.84), rgba(232, 240, 255, 0.68)),
        radial-gradient(circle at 50% 0%, rgba(255, 232, 166, 0.14), transparent 40%);
      text-align: center;
      box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.68);
    }

    .challenge-label {
      display: inline-flex;
      margin-bottom: 14px;
      padding: 8px 12px;
      border-radius: 999px;
      color: var(--brand);
      background: linear-gradient(135deg, rgba(255, 232, 166, 0.72), var(--brand-3));
      font-family: var(--font-nav);
      font-size: 0.72rem;
      font-weight: 800;
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }

    .challenge-word {
      min-height: 1.05em;
      color: var(--brand);
      font-family: var(--font-nav);
      font-size: clamp(4rem, 12vw, 8.5rem);
      font-weight: 800;
      letter-spacing: -0.09em;
      line-height: 0.95;
      transition: transform 0.18s ease;
      text-shadow: 0 12px 26px rgba(15, 23, 42, 0.10);
    }

    .challenge-help {
      max-width: 560px;
      margin-top: 16px;
      color: var(--text-soft);
      line-height: 1.65;
    }

    .color-grid {
      display: grid;
      grid-template-columns: repeat(4, minmax(0, 1fr));
      gap: 12px;
    }

    .color-choice {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-height: 58px;
      border: 0;
      border-radius: 17px;
      color: #fff;
      font-family: var(--font-nav);
      font-size: 0.88rem;
      font-weight: 800;
      letter-spacing: 0.05em;
      text-transform: uppercase;
      box-shadow: 0 14px 26px rgba(15, 23, 42, 0.14);
      cursor: pointer;
      transition: transform 0.18s ease, box-shadow 0.18s ease, filter 0.18s ease;
    }

    .color-choice:hover,
    .color-choice:focus-visible {
      transform: translateY(-3px);
      box-shadow: 0 18px 32px rgba(15, 23, 42, 0.2);
      filter: saturate(1.08);
      outline: none;
    }

    .color-choice:disabled {
      cursor: not-allowed;
      filter: grayscale(0.25);
      opacity: 0.72;
      transform: none;
    }

    .lab-feedback {
      min-height: 42px;
      margin-top: 18px;
      color: var(--text);
      font-weight: 800;
      text-align: center;
    }

    .lab-controls {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 22px;
      justify-content: center;
    }

    .lab-controls .btn {
      border-radius: 14px;
    }

    .btn-soft {
      color: var(--brand);
      background: var(--brand-3);
    }

    .btn-soft:hover {
      color: #fff;
    }

    .result-card {
      display: none;
      margin-top: 22px;
      padding: 22px;
      border: 1px solid rgba(37, 99, 235, 0.16);
      border-radius: 22px;
      background: rgba(37, 99, 235, 0.08);
    }

    .result-card.show {
      display: block;
      animation: result-pop 0.36s ease both;
    }

    .result-card h3 {
      margin: 0 0 8px;
      color: var(--text);
      font-size: 1.5rem;
    }

    .result-card p {
      margin: 0;
      color: var(--text-soft);
      line-height: 1.7;
    }

    @keyframes result-pop {
      from {
        opacity: 0;
        transform: translateY(10px) scale(0.98);
      }

      to {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }

    .dark .experiment-card {
      border-color: rgba(102, 153, 236, 0.24);
      background: linear-gradient(180deg, rgba(17, 31, 58, 0.96), rgba(12, 24, 45, 0.94));
    }

    .dark .experiments-panel-card,
    .dark .experiments-stat {
      border-color: rgba(255, 247, 219, 0.16);
      background: linear-gradient(145deg, rgba(15, 23, 42, 0.72), rgba(8, 23, 42, 0.52));
    }

    .dark .experiment-description,
    .dark .interactive-description {
      color: #b0b8c8;
    }

    .dark .experiment-what {
      color: #b0b8c8;
      background: rgba(0, 120, 215, 0.16);
    }

    .dark .experiment-what strong {
      color: #00e5ff;
    }

    .dark .focus-lab {
      border-color: rgba(96, 165, 250, 0.22);
      background: rgba(15, 23, 42, 0.76);
      box-shadow: 0 28px 80px rgba(0, 0, 0, 0.34);
    }

    .dark .lab-stat {
      background: rgba(15, 23, 42, 0.58);
    }

    .dark .challenge-card {
      background:
        linear-gradient(145deg, rgba(15, 23, 42, 0.86), rgba(30, 58, 95, 0.54)),
        radial-gradient(circle at 50% 0%, rgba(96, 165, 250, 0.16), transparent 40%);
    }

    @media (max-width: 768px) {
      .experiments-hero {
        min-height: auto;
        padding: 58px 18px;
      }

      .experiments-hero-content {
        grid-template-columns: 1fr;
        text-align: center;
      }

      .experiments-hero-copy,
      .experiments-hero p {
        margin-left: auto;
        margin-right: auto;
      }

      .experiments-hero-actions {
        justify-content: center;
      }

      .experiments-stat-grid {
        grid-template-columns: repeat(3, minmax(0, 1fr));
      }

      .experiments-hero h1 {
        font-size: clamp(2.6rem, 13vw, 4.4rem);
      }

      .experiments-section {
        padding: 54px 15px;
      }

      .focus-lab {
        grid-template-columns: 1fr;
      }

      .interactive-section {
        width: calc(100% - 30px);
        padding: 38px 16px;
        border-radius: 26px;
      }

      .lab-stats,
      .color-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
      }

      .lab-panel,
      .lab-stage {
        padding: 22px;
      }
    }

    @media (max-width: 460px) {
      .experiments-stat-grid {
        grid-template-columns: 1fr;
      }

      .lab-stats,
      .color-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
@endpush

@section('content')
  <section class="experiments-hero">
    <div class="experiments-hero-content">
      <div class="experiments-hero-copy">
        <span class="section-kicker">Interactive learning lab</span>
        <h1>Experiment, notice, and learn by doing.</h1>
        <p>Explore science, psychology, memory, and creative thinking through hands-on challenges designed to make ideas easier to understand.</p>
        <div class="experiments-hero-actions">
          <a href="#interactive" class="btn">Try Focus Lab</a>
          <a href="#experiments-list" class="btn btn-outline">Browse Experiments</a>
        </div>
      </div>

      <aside class="experiments-hero-panel" aria-label="Experiments overview">
        <div class="experiments-panel-card">
          <span>Lab mindset</span>
          <strong>Small tests create big understanding.</strong>
          <p>Each card introduces a practical idea you can explore, repeat, and connect to real learning.</p>
        </div>

        <div class="experiments-stat-grid">
          <div class="experiments-stat">
            <strong>{{ count($experiments) }}</strong>
            <span>Labs</span>
          </div>
          <div class="experiments-stat">
            <strong>10</strong>
            <span>Rounds</span>
          </div>
          <div class="experiments-stat">
            <strong>3</strong>
            <span>Levels</span>
          </div>
        </div>
      </aside>
    </div>
  </section>

  <main id="main" class="experiments-page">
    <section class="experiments-section" id="experiments-list">
      <div class="section-heading">
        <span class="section-kicker">Choose a challenge</span>
        <h2>Featured Experiments</h2>
        <p>Start with a card, learn the goal, then jump into the interactive Focus Lab below.</p>
      </div>

      <div class="experiments-grid">
        @foreach ($experiments as $experiment)
          <article class="experiment-card">
            <div class="experiment-card-header">
              <span class="experiment-number">{{ str_pad((string) ($loop->index + 1), 2, '0', STR_PAD_LEFT) }}</span>
              <span class="experiment-emoji">{{ $experiment['emoji'] }}</span>
              <h3>{{ $experiment['title'] }}</h3>
              <span class="experiment-level">{{ $experiment['level'] }}</span>
            </div>
            <div class="experiment-card-body">
              <p class="experiment-description">{{ $experiment['description'] }}</p>
              <div class="experiment-what">
                <strong>What you'll learn:</strong> {{ $experiment['learn'] }}
              </div>

              <a href="#interactive" class="experiment-btn">{{ $experiment['action'] }}</a>
            </div>
          </article>
        @endforeach
      </div>
    </section>

    <section class="interactive-section" id="interactive">
      <div class="interactive-container">
        <div class="section-heading">
          <span class="section-kicker">Try it now</span>
          <h2>Focus Lab</h2>
        </div>
        <p class="interactive-description">
          Read the ink color, ignore the word, and test how quickly your brain can respond under pressure. This quick challenge trains selective attention and reaction speed.
        </p>

        <div class="focus-lab" aria-labelledby="focus-lab-title">
          <div class="lab-panel">
            <h3 id="focus-lab-title">Color Reflex Challenge</h3>
            <p>The word can trick you. Your task is to choose the color of the text, not what the word says.</p>

            <ul class="lab-rules">
              <li><span>1</span> Press Start to begin a 10-round challenge.</li>
              <li><span>2</span> Look at the ink color of the big word.</li>
              <li><span>3</span> Click the matching color as fast as you can.</li>
            </ul>

            <div class="difficulty-control">
              <label for="difficulty">Difficulty</label>
              <select id="difficulty">
                <option value="relaxed">Relaxed - 12 seconds</option>
                <option value="focused" selected>Focused - 8 seconds</option>
                <option value="expert">Expert - 5 seconds</option>
              </select>
            </div>
          </div>

          <div class="lab-stage">
            <div class="lab-stats" aria-label="Challenge statistics">
              <div class="lab-stat">
                <span>Score</span>
                <strong id="score">0</strong>
              </div>
              <div class="lab-stat">
                <span>Round</span>
                <strong id="round">0/10</strong>
              </div>
              <div class="lab-stat">
                <span>Average</span>
                <strong id="average">--</strong>
              </div>
              <div class="lab-stat">
                <span>Time</span>
                <strong id="timer">8.0s</strong>
              </div>
            </div>

            <div class="challenge-card" aria-live="polite">
              <div>
                <span class="challenge-label" id="challengeLabel">Ready</span>
                <div class="challenge-word" id="challengeWord">FOCUS</div>
                <p class="challenge-help" id="challengeHelp">
                  Start the challenge, then choose the ink color. This trains selective attention and reaction speed.
                </p>
              </div>
            </div>

            <div class="color-grid" id="colorGrid">
              <button class="color-choice" type="button" data-color="red">Red</button>
              <button class="color-choice" type="button" data-color="blue">Blue</button>
              <button class="color-choice" type="button" data-color="green">Green</button>
              <button class="color-choice" type="button" data-color="yellow">Yellow</button>
            </div>

            <div class="lab-feedback" id="feedback">Press Start Challenge when you are ready.</div>

            <div class="lab-controls">
              <button class="btn" type="button" id="startBtn">Start Challenge</button>
              <button class="btn btn-soft" type="button" id="resetBtn">Reset</button>
            </div>

            <div class="result-card" id="resultCard">
              <h3 id="resultTitle">Great focus.</h3>
              <p id="resultText">Your result will appear here after the final round.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection

@push('scripts')
  <script>
    (() => {
      const colors = [
        { name: 'red', label: 'Red', value: '#ef4444' },
        { name: 'blue', label: 'Blue', value: '#2563eb' },
        { name: 'green', label: 'Green', value: '#16a34a' },
        { name: 'yellow', label: 'Yellow', value: '#d97706' },
      ];

      const durationByDifficulty = { relaxed: 12, focused: 8, expert: 5 };
      const totalRounds = 10;
      const state = {
        active: false,
        score: 0,
        round: 0,
        correctColor: null,
        startedAt: 0,
        times: [],
        timerId: null,
        remaining: durationByDifficulty.focused,
      };

      const scoreEl = document.getElementById('score');
      const roundEl = document.getElementById('round');
      const averageEl = document.getElementById('average');
      const timerEl = document.getElementById('timer');
      const challengeWord = document.getElementById('challengeWord');
      const challengeLabel = document.getElementById('challengeLabel');
      const challengeHelp = document.getElementById('challengeHelp');
      const feedback = document.getElementById('feedback');
      const startBtn = document.getElementById('startBtn');
      const resetBtn = document.getElementById('resetBtn');
      const difficulty = document.getElementById('difficulty');
      const resultCard = document.getElementById('resultCard');
      const resultTitle = document.getElementById('resultTitle');
      const resultText = document.getElementById('resultText');
      const choiceButtons = [...document.querySelectorAll('.color-choice')];

      const pick = (items) => items[Math.floor(Math.random() * items.length)];

      const setChoicesEnabled = (enabled) => {
        choiceButtons.forEach((button) => {
          button.disabled = !enabled;
        });
      };

      const updateStats = () => {
        const average = state.times.length
          ? `${Math.round(state.times.reduce((sum, time) => sum + time, 0) / state.times.length)}ms`
          : '--';

        scoreEl.textContent = state.score;
        roundEl.textContent = `${state.round}/${totalRounds}`;
        averageEl.textContent = average;
        timerEl.textContent = `${Math.max(state.remaining, 0).toFixed(1)}s`;
      };

      const setFeedback = (message, tone = 'neutral') => {
        feedback.textContent = message;
        feedback.style.color = tone === 'success' ? '#16a34a' : tone === 'error' ? '#ef4444' : '';
      };

      const stopTimer = () => {
        if (state.timerId) clearInterval(state.timerId);
        state.timerId = null;
      };

      const startTimer = () => {
        stopTimer();
        state.remaining = durationByDifficulty[difficulty.value];
        updateStats();

        state.timerId = setInterval(() => {
          state.remaining -= 0.1;
          updateStats();

          if (state.remaining <= 0) {
            setFeedback('Time is up. Moving to the next round.', 'error');
            nextRound();
          }
        }, 100);
      };

      const drawChallenge = () => {
        const wordColor = pick(colors);
        let inkColor = pick(colors);

        if (Math.random() > 0.25) {
          while (inkColor.name === wordColor.name) inkColor = pick(colors);
        }

        state.correctColor = inkColor.name;
        state.startedAt = performance.now();
        challengeWord.textContent = wordColor.label.toUpperCase();
        challengeWord.style.color = inkColor.value;
        challengeWord.style.transform = 'scale(1.02)';
        challengeLabel.textContent = `Round ${state.round}`;
        challengeHelp.textContent = 'Choose the ink color, not the word.';

        setTimeout(() => {
          challengeWord.style.transform = '';
        }, 160);
      };

      const finishGame = () => {
        state.active = false;
        stopTimer();
        setChoicesEnabled(false);
        startBtn.disabled = false;
        challengeLabel.textContent = 'Complete';
        challengeWord.textContent = 'DONE';
        challengeWord.style.color = 'var(--brand)';
        challengeHelp.textContent = 'Nice work. Review your score and try again to improve.';

        const average = state.times.length
          ? Math.round(state.times.reduce((sum, time) => sum + time, 0) / state.times.length)
          : 0;
        const accuracy = Math.round((state.score / totalRounds) * 100);

        resultTitle.textContent = accuracy >= 80 ? 'Excellent focus.' : accuracy >= 50 ? 'Good effort.' : 'Keep practicing.';
        resultText.textContent = `You scored ${state.score}/${totalRounds} with ${accuracy}% accuracy. Your average correct response time was ${average || '--'}ms.`;
        resultCard.classList.add('show');
        setFeedback('Challenge complete. You can reset or start again.', 'success');
        updateStats();
      };

      function nextRound() {
        stopTimer();
        if (!state.active) return;

        if (state.round >= totalRounds) {
          finishGame();
          return;
        }

        state.round += 1;
        setChoicesEnabled(true);
        drawChallenge();
        startTimer();
        updateStats();
      }

      const startGame = () => {
        state.active = true;
        state.score = 0;
        state.round = 0;
        state.times = [];
        resultCard.classList.remove('show');
        startBtn.disabled = true;
        setFeedback('Go fast, but stay accurate.');
        nextRound();
      };

      const resetGame = () => {
        state.active = false;
        state.score = 0;
        state.round = 0;
        state.times = [];
        state.correctColor = null;
        state.remaining = durationByDifficulty[difficulty.value];
        stopTimer();
        setChoicesEnabled(false);
        startBtn.disabled = false;
        resultCard.classList.remove('show');
        challengeLabel.textContent = 'Ready';
        challengeWord.textContent = 'FOCUS';
        challengeWord.style.color = 'var(--brand)';
        challengeHelp.textContent = 'Start the challenge, then choose the ink color. This trains selective attention and reaction speed.';
        setFeedback('Press Start Challenge when you are ready.');
        updateStats();
      };

      choiceButtons.forEach((button) => {
        const color = colors.find((item) => item.name === button.dataset.color);
        button.style.background = color.value;

        button.addEventListener('click', () => {
          if (!state.active) return;

          stopTimer();
          setChoicesEnabled(false);

          if (button.dataset.color === state.correctColor) {
            const reactionTime = Math.round(performance.now() - state.startedAt);
            state.score += 1;
            state.times.push(reactionTime);
            setFeedback(`Correct. Reaction time: ${reactionTime}ms.`, 'success');
          } else {
            const correctLabel = colors.find((item) => item.name === state.correctColor).label;
            setFeedback(`Not quite. The ink color was ${correctLabel}.`, 'error');
          }

          setTimeout(nextRound, 520);
          updateStats();
        });
      });

      startBtn.addEventListener('click', startGame);
      resetBtn.addEventListener('click', resetGame);
      difficulty.addEventListener('change', resetGame);

      resetGame();
    })();
  </script>
@endpush
