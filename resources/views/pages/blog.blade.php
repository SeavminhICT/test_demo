@extends('layouts.app')

@section('content')
  @php
    $postCollection = collect($posts);
    $featuredPost = $postCollection->first();
    $otherPosts = $postCollection->slice(1);
    $totalMinutes = $postCollection->sum(fn ($post) => max(1, ceil(str_word_count(implode(' ', $post['content'])) / 180)));
  @endphp

  <section class="blog-hero">
    <div class="blog-hero-content">
      <div class="blog-hero-copy">
        <span class="section-kicker">Field notes</span>
        <h1>Thoughtful stories for a clearer mind</h1>
        <p>Short reflections on nature, mindset, and learning. Each post is built to feel calm, useful, and easy to read.</p>

        <div class="blog-hero-actions">
          <a href="#latest-posts" class="btn">Start Reading</a>
          <a href="{{ route('experiments') }}" class="btn btn-outline">Try Experiments</a>
        </div>
      </div>

      <aside class="blog-hero-panel" aria-label="Blog highlights">
        <div class="blog-hero-card">
          <span>Journal rhythm</span>
          <strong>Observe slowly. Write clearly. Learn daily.</strong>
          <p>Nature notes, mindset lessons, and practical ideas for steady growth.</p>
        </div>

        <div class="blog-hero-stats" aria-label="Blog statistics">
          <div>
            <strong>{{ $postCollection->count() }}</strong>
            <span>Posts</span>
          </div>
          <div>
            <strong>{{ $totalMinutes }}</strong>
            <span>Min read</span>
          </div>
          <div>
            <strong>Nature</strong>
            <span>Theme</span>
          </div>
        </div>
      </aside>
    </div>
  </section>

  <main id="main" class="blog-page">
    <section class="blog-section" id="latest-posts">
      <div class="section-heading">
        <span class="section-kicker">Latest writing</span>
        <h2>Fresh From The Journal</h2>
        <p>Browse the newest ideas and slow-reading notes from PHEARUM.</p>
      </div>

      @if ($featuredPost)
        @php
          $featuredReadingTime = max(1, ceil(str_word_count(implode(' ', $featuredPost['content'])) / 180));
        @endphp

        <article class="blog-featured-card">
          <span class="blog-featured-label">Featured</span>
          <a href="{{ route('blog.show', $featuredPost['id']) }}" class="blog-featured-media" aria-label="Read {{ $featuredPost['title'] }}">
            <img src="{{ asset($featuredPost['image']) }}" alt="{{ $featuredPost['alt'] }}">
          </a>
          <div class="blog-featured-content">
            <span class="blog-date">{{ $featuredPost['date'] }}</span>
            <h3>{{ $featuredPost['title'] }}</h3>
            <p>{{ $featuredPost['excerpt'] }}</p>
            <div class="blog-card-meta">
              <span>{{ $featuredReadingTime }} min read</span>
              <span>{{ $featuredPost['subtitle'] }}</span>
            </div>
            <a href="{{ route('blog.show', $featuredPost['id']) }}" class="btn">Read Featured Post</a>
          </div>
        </article>
      @endif

      <div class="blog-container">
        @foreach ($otherPosts as $post)
          @php
            $readingTime = max(1, ceil(str_word_count(implode(' ', $post['content'])) / 180));
          @endphp

          <article @class(['blog-post', 'blog-card', 'hidden' => $loop->index >= 3])>
            <span class="blog-card-number">{{ str_pad((string) ($loop->index + 2), 2, '0', STR_PAD_LEFT) }}</span>
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

      @if ($otherPosts->count() > 3)
        <div class="load-more-container">
          <button id="loadMoreBtn" class="btn load-more-btn" type="button">Load More Posts</button>
        </div>
      @endif

      <div class="load-more-container experiments-cta">
        <a href="{{ route('experiments') }}" class="btn btn-experiments">Experiments</a>
      </div>
    </section>

    <section class="blog-final-cta" aria-labelledby="blog-final-heading">
      <span class="section-kicker">Keep exploring</span>
      <h2 id="blog-final-heading">Turn reading into practice.</h2>
      <p>After a reflection, try the Focus Lab or explore the mindset behind this project.</p>
      <div class="btn-group">
        <a href="{{ route('experiments') }}" class="btn">Try Focus Lab</a>
        <a href="{{ route('about') }}" class="btn btn-outline">About Mindset</a>
      </div>
    </section>
  </main>
@endsection

@push('scripts')
  <script>
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    const hiddenPosts = document.querySelectorAll('.blog-card.hidden');

    if (loadMoreBtn) {
      loadMoreBtn.addEventListener('click', () => {
        document.querySelectorAll('.blog-card.hidden').forEach((post) => {
          post.classList.remove('hidden');
        });

        loadMoreBtn.style.display = 'none';
      });
    }
  </script>
@endpush
