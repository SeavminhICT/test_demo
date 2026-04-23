@extends('layouts.app')

@section('content')
  @php
    $readingTime = max(1, ceil(str_word_count(implode(' ', $post['content'])) / 180));
  @endphp

  <main id="main" class="article-page">
    <article class="blog-post-single">
      <header class="article-header">
        <a href="{{ route('blog.index') }}" class="article-back-link">Back to Blog</a>
        <span class="blog-date">{{ $post['date'] }}</span>
        <h1>{{ $post['title'] }}</h1>
        <p>{{ $post['subtitle'] }}</p>
        <div class="article-meta">
          <span>{{ $readingTime }} min read</span>
          <span>Nature journal</span>
          <span>PHEARUM</span>
        </div>
      </header>

      <img class="article-hero-image" src="{{ asset($post['image']) }}" alt="{{ $post['alt'] }}">

      <div class="blog-single-container">
        <div class="article-lead">
          {{ $post['excerpt'] }}
        </div>

        @foreach ($post['content'] as $paragraph)
          <p>{{ $paragraph }}</p>
        @endforeach

        <footer class="article-signoff">
          <span>Reflection prompt</span>
          <strong>What is one small thing this post helps you notice today?</strong>
          <p>Save the idea, take a walk, or try a simple experiment to turn the reflection into practice.</p>
        </footer>
      </div>
    </article>

    @if (!empty($relatedPosts))
      <section class="related-posts" aria-labelledby="related-posts-heading">
        <div class="section-heading">
          <span class="section-kicker">Keep reading</span>
          <h2 id="related-posts-heading">Related Posts</h2>
        </div>

        <div class="blog-container related-post-grid">
          @foreach ($relatedPosts as $relatedPost)
            <article class="blog-post blog-card">
              <a href="{{ route('blog.show', $relatedPost['id']) }}" class="blog-card-image" aria-label="Read {{ $relatedPost['title'] }}">
                <img src="{{ asset($relatedPost['image']) }}" alt="{{ $relatedPost['alt'] }}">
              </a>
              <div class="blog-content">
                <span class="blog-date">{{ $relatedPost['date'] }}</span>
                <h3>{{ $relatedPost['title'] }}</h3>
                <p>{{ $relatedPost['excerpt'] }}</p>
                <a href="{{ route('blog.show', $relatedPost['id']) }}" class="btn">Read More</a>
              </div>
            </article>
          @endforeach
        </div>
      </section>
    @endif
  </main>
@endsection
