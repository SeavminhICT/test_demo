<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'PHEARUM' }}</title>
  <meta name="theme-color" content="#0078d7" media="(prefers-color-scheme: light)">
  <meta name="theme-color" content="#071023" media="(prefers-color-scheme: dark)">
  <meta name="msapplication-TileColor" content="#0078d7">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <link rel="manifest" href="{{ asset('manifest.webmanifest') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.svg') }}">
  <link rel="icon" href="{{ asset('images/favicon.svg') }}" type="image/svg+xml">
  <link rel="shortcut icon" href="{{ asset('images/favicon.svg') }}">
  <link rel="mask-icon" href="{{ asset('images/safari-pinned-tab.svg') }}" color="#0078d7">
  <link rel="stylesheet" href="{{ asset('style.css') }}">
  @stack('styles')
</head>

<body>
  <a class="skip-link" href="#main">Skip to main content</a>

  <header class="site-header">
    <a class="logo" href="{{ route('home') }}" aria-label="Go to Home">PHEARUM</a>
    <nav id="navbar" aria-label="Primary navigation">
      <a href="{{ route('home') }}" @class(['active' => request()->routeIs('home')])>Home</a>
      <a href="{{ route('blog.index') }}" @class(['active' => request()->routeIs('blog.*')])>Blog</a>
      <a href="{{ route('experiments') }}" @class(['active' => request()->routeIs('experiments')])>Experiments</a>
      <a href="{{ route('about') }}" @class(['active' => request()->routeIs('about')])>About</a>
      <a href="{{ route('contact') }}" @class(['active' => request()->routeIs('contact')])>Contact</a>
    </nav>
    <button class="menu-toggle" id="menu-toggle" aria-label="Toggle menu" aria-controls="navbar" aria-expanded="false">
      <span></span>
      <span></span>
      <span></span>
    </button>
    <button id="theme-toggle" class="theme-toggle" aria-label="Toggle dark mode" aria-pressed="false">🌙</button>
  </header>

  @yield('content')

  <footer class="site-footer">
    <div class="footer-container">
      <div class="footer-brand">
        <a class="footer-logo" href="{{ route('home') }}" aria-label="Go to Home">PHEARUM</a>
        <p>A calm digital space for learning, reflection, experiments, and a positive mindset.</p>
        <a href="{{ route('contact') }}" class="footer-cta">Start a Conversation</a>
      </div>

      <div class="footer-links" aria-label="Footer navigation">
        <div>
          <h2>Explore</h2>
          <a href="{{ route('home') }}">Home</a>
          <a href="{{ route('blog.index') }}">Blog</a>
          <a href="{{ route('experiments') }}">Experiments</a>
        </div>

        <div>
          <h2>Project</h2>
          <a href="{{ route('about') }}">About</a>
          <a href="{{ route('contact') }}">Contact</a>
          <a href="{{ route('experiments') }}#interactive">Focus Lab</a>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <p>&copy; 2026 PHEARUM. All rights reserved.</p>
      <span>Learn. Grow. Create.</span>
    </div>
  </footer>

  <a href="{{ route('contact') }}" class="floating-contact-btn">Contact Me</a>

  <script>
    const menuToggle = document.getElementById('menu-toggle');
    const navbar = document.getElementById('navbar');
    const themeToggle = document.getElementById('theme-toggle');

    if (menuToggle && navbar) {
      menuToggle.addEventListener('click', () => {
        const expanded = menuToggle.getAttribute('aria-expanded') === 'true';
        navbar.classList.toggle('active');
        menuToggle.classList.toggle('open');
        menuToggle.setAttribute('aria-expanded', String(!expanded));
      });
    }

    (function () {
      if (!themeToggle) return;

      const posKey = 'theme-toggle-pos';
      const applyTheme = (isDark) => {
        document.documentElement.classList.toggle('dark', isDark);
        themeToggle.setAttribute('aria-pressed', String(!!isDark));
        themeToggle.textContent = isDark ? '☀️' : '🌙';
      };

      const stored = localStorage.getItem('site-theme');
      if (stored) applyTheme(stored === 'dark');
      else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) applyTheme(true);

      const storedPos = localStorage.getItem(posKey);
      if (storedPos) {
        try {
          const p = JSON.parse(storedPos);
          themeToggle.style.left = p.left + 'px';
          themeToggle.style.top = p.top + 'px';
          themeToggle.style.right = 'auto';
        } catch (e) {}
      }

      themeToggle.addEventListener('click', () => {
        const isDark = document.documentElement.classList.toggle('dark');
        themeToggle.setAttribute('aria-pressed', String(!!isDark));
        themeToggle.textContent = isDark ? '☀️' : '🌙';
        localStorage.setItem('site-theme', isDark ? 'dark' : 'light');
      });

      let dragging = false;
      let startX = 0;
      let startY = 0;
      let startLeft = 0;
      let startTop = 0;

      themeToggle.addEventListener('pointerdown', (e) => {
        dragging = true;
        themeToggle.setPointerCapture(e.pointerId);
        startX = e.clientX;
        startY = e.clientY;
        const r = themeToggle.getBoundingClientRect();
        startLeft = r.left;
        startTop = r.top;
        e.preventDefault();
      });

      window.addEventListener('pointermove', (e) => {
        if (!dragging) return;
        const dx = e.clientX - startX;
        const dy = e.clientY - startY;
        const left = Math.max(8, Math.min(window.innerWidth - themeToggle.offsetWidth - 8, Math.round(startLeft + dx)));
        const top = Math.max(8, Math.min(window.innerHeight - themeToggle.offsetHeight - 8, Math.round(startTop + dy)));
        themeToggle.style.left = left + 'px';
        themeToggle.style.top = top + 'px';
        themeToggle.style.right = 'auto';
      });

      window.addEventListener('pointerup', (e) => {
        if (!dragging) return;
        dragging = false;
        try { themeToggle.releasePointerCapture(e.pointerId); } catch {}
        const r = themeToggle.getBoundingClientRect();
        localStorage.setItem(posKey, JSON.stringify({ left: Math.round(r.left), top: Math.round(r.top) }));
      });

      themeToggle.addEventListener('dblclick', () => {
        themeToggle.style.removeProperty('left');
        themeToggle.style.removeProperty('top');
        themeToggle.style.right = '16px';
        themeToggle.style.top = '16px';
        localStorage.removeItem(posKey);
      });
    })();
  </script>

  @stack('scripts')
</body>
</html>
