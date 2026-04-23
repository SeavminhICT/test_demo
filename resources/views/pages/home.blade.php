@extends('layouts.app')

@section('content')
  <main id="main" class="home-page">
    <section id="home" class="hero home-hero">
      <div class="hero-content home-hero-content" role="region" aria-labelledby="home-heading">
        <div class="home-hero-copy">
          <span class="section-kicker home-kicker">Personal learning space</span>
          <p id="greeting" class="greeting hero-subtitle">Hello!</p>
          <h1 id="home-heading">Learn deeply. Think clearly. Create with purpose.</h1>
          <p class="hero-desc">A calm digital space for nature notes, mindset lessons, and small experiments that make learning feel practical, creative, and alive.</p>

          <div class="btn-group home-actions">
            <a href="{{ route('blog.index') }}" class="btn">Explore Blog</a>
            <a href="{{ route('experiments') }}" class="btn btn-outline">Try Experiments</a>
          </div>
        </div>

        <aside class="home-hero-panel" aria-label="Learning highlights">
          <div class="home-panel-card home-panel-main">
            <span>Today&apos;s focus</span>
            <strong>Curiosity builds confidence.</strong>
            <p>Small steps, clear thinking, and steady practice turn ideas into progress.</p>
          </div>

          <div class="home-metric-grid">
            <div class="home-metric">
              <strong>{{ count($posts) }}</strong>
              <span>Fresh posts</span>
            </div>
            <div class="home-metric">
              <strong>{{ count($experiments) }}</strong>
              <span>Experiments</span>
            </div>
          </div>
        </aside>
      </div>
    </section>

    <section id="about" class="home-belief-section" aria-labelledby="home-belief-heading">
      <div class="section-heading">
        <span class="section-kicker">What this site is about</span>
        <h2 id="home-belief-heading">Simple ideas, designed to help you grow</h2>
        <p>Every section is built around practical learning: observe carefully, reflect honestly, and try something small.</p>
      </div>

      <div class="home-belief-grid">
        <article class="home-belief-card">
          <span>01</span>
          <h3>Notice More</h3>
          <p>Use nature and everyday moments as prompts for calm thinking and better attention.</p>
        </article>

        <article class="home-belief-card">
          <span>02</span>
          <h3>Practice Clearly</h3>
          <p>Turn curiosity into action with small experiments, simple challenges, and repeatable habits.</p>
        </article>

        <article class="home-belief-card">
          <span>03</span>
          <h3>Create Better</h3>
          <p>Build confidence through thoughtful writing, creative projects, and steady improvement.</p>
        </article>
      </div>
    </section>

    <section class="home-feature-strip" aria-label="Learning path">
      <div>
        <span>Start here</span>
        <strong>Read a reflection</strong>
      </div>
      <div>
        <span>Then try</span>
        <strong>Run an experiment</strong>
      </div>
      <div>
        <span>Keep going</span>
        <strong>Build a positive mindset</strong>
      </div>
    </section>

    <section class="home-preview-section home-journal-section" aria-labelledby="latest-blog-heading">
      <div class="section-heading">
        <span class="section-kicker">Latest writing</span>
        <h2 id="latest-blog-heading">Fresh Ideas From The Blog</h2>
        <p>Short reflections on nature, mindset, and learning moments that help us slow down and notice more.</p>
      </div>

      <div class="home-card-grid">
        @foreach ($posts as $post)
          @php
            $readingTime = max(1, ceil(str_word_count(implode(' ', $post['content'])) / 180));
          @endphp

          <article class="blog-post home-preview-card">
            <a href="{{ route('blog.show', $post['id']) }}" class="blog-card-image" aria-label="Read {{ $post['title'] }}">
              <img src="{{ asset($post['image']) }}" alt="{{ $post['alt'] }}">
            </a>
            <div class="blog-content">
              <span class="blog-date">{{ $post['date'] }}</span>
              <h3>{{ $post['title'] }}</h3>
              <p>{{ $post['excerpt'] }}</p>
              <div class="blog-card-meta">
                <span>{{ $readingTime }} min read</span>
                <span>{{ $post['subtitle'] }}</span>
              </div>
              <a href="{{ route('blog.show', $post['id']) }}" class="btn">Read More</a>
            </div>
          </article>
        @endforeach
      </div>

      <div class="section-action">
        <a href="{{ route('blog.index') }}" class="btn">View All Posts</a>
      </div>
    </section>

    <section class="home-preview-section home-experiments" aria-labelledby="featured-experiments-heading">
      <div class="section-heading">
        <span class="section-kicker">Learn by doing</span>
        <h2 id="featured-experiments-heading">Featured Experiments</h2>
        <p>Try small interactive challenges that make science, memory, and creative thinking easier to understand.</p>
      </div>

      <div class="experiment-preview-grid">
        @foreach ($experiments as $experiment)
          <article class="experiment-preview-card">
            <span class="experiment-preview-icon">{{ $experiment['label'] }}</span>
            <h3>{{ $experiment['title'] }}</h3>
            <p>{{ $experiment['description'] }}</p>
          </article>
        @endforeach
      </div>

      <div class="section-action">
        <a href="{{ route('experiments') }}" class="btn">Explore Experiments</a>
      </div>
    </section>

    <section class="home-final-cta" aria-labelledby="home-final-heading">
      <span class="section-kicker">Keep moving</span>
      <h2 id="home-final-heading">Ready to learn something useful today?</h2>
      <p>Choose a post, try the Focus Lab, or learn more about the mindset behind the project.</p>
      <div class="btn-group">
        <a href="{{ route('experiments') }}" class="btn">Start Experiment</a>
        <a href="{{ route('about') }}" class="btn btn-outline">About PHEARUM</a>
      </div>
    </section>
  </main>
@endsection

@push('scripts')
  <script>
    (function () {
      const greetingEl = document.getElementById('greeting');
      if (!greetingEl) return;

      const hour = new Date().getHours();
      let text = 'Hello!';
      if (hour >= 5 && hour < 12) text = 'Good morning ☀️';
      else if (hour >= 12 && hour < 18) text = 'Good afternoon 🌤️';
      else if (hour >= 18 && hour < 22) text = 'Good evening 🌆';
      else text = 'Working late? ✨';
      greetingEl.textContent = text;
    })();
  </script>
@endpush
