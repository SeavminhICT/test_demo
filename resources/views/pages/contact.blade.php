@extends('layouts.app')

@section('content')
  <main id="main" class="contact-page">
    <section id="contact" class="contact-section" aria-labelledby="contact-heading">
      <div class="contact-container">
        <div class="contact-hero">
          <div class="contact-hero-copy">
            <span class="section-kicker">Contact</span>
            <h1 id="contact-heading">Let&apos;s build something thoughtful.</h1>
            <p class="contact-intro">Have a question, idea, project, or collaboration in mind? Send a message and I will get back to you soon.</p>

            <div class="contact-promise-grid" aria-label="Contact promises">
              <div>
                <strong>Friendly</strong>
                <span>Clear and respectful communication.</span>
              </div>
              <div>
                <strong>Creative</strong>
                <span>Open to ideas, learning, and projects.</span>
              </div>
            </div>
          </div>

          <div class="contact-hero-card">
            <span>Response style</span>
            <strong>Warm, simple, and useful.</strong>
            <p>Share the details that matter most. I&apos;ll read carefully and respond with clarity.</p>
          </div>
        </div>

        <div class="contact-layout">
          <aside class="contact-info" aria-label="Contact channels">
            <a class="contact-item" href="mailto:info@phearum.vip" target="_blank" rel="noopener noreferrer">
              <span class="contact-item-icon">✉️</span>
              <span class="contact-item-text">
                <strong>Email</strong>
                <small>info@phearum.vip</small>
              </span>
            </a>

            <a class="contact-item" href="https://x.com/RoathPhearum" target="_blank" rel="noopener noreferrer">
              <span class="contact-item-icon">𝕏</span>
              <span class="contact-item-text">
                <strong>Twitter / X</strong>
                <small>@RoathPhearum</small>
              </span>
            </a>

            <a class="contact-item" href="https://facebook.com/RoathPhearum" target="_blank" rel="noopener noreferrer">
              <span class="contact-item-icon">👥</span>
              <span class="contact-item-text">
                <strong>Facebook</strong>
                <small>RoathPhearum</small>
              </span>
            </a>

            <div class="contact-note-card">
              <span>Best for</span>
              <p>Questions, feedback, collaboration ideas, learning projects, and friendly conversations.</p>
            </div>
          </aside>

          <div class="form-wrapper">
            <div class="form-heading">
              <span class="section-kicker">Send a message</span>
              <h2>Write your message</h2>
              <p>I&apos;ll open your email app with the message prepared for you.</p>
            </div>

            <form class="contact-form" action="mailto:info@phearum.vip" method="post" enctype="text/plain" autocomplete="on">
              <div class="form-grid">
                <div>
                  <label for="name">Name</label>
                  <input type="text" id="name" name="name" placeholder="Your full name" minlength="2" maxlength="60" required>
                </div>

                <div>
                  <label for="email">Email</label>
                  <input type="email" id="email" name="email" placeholder="you@example.com" required>
                </div>
              </div>

              <label for="message">Message</label>
              <textarea id="message" name="message" rows="6" maxlength="800" placeholder="Write your message here..." required></textarea>

              <button type="submit" class="btn">Send Message</button>
              <p class="form-status" id="form-status" role="status" aria-live="polite"></p>
            </form>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection

@push('scripts')
  <script>
    const contactForm = document.querySelector('.contact-form');

    if (contactForm) {
      const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            obs.unobserve(entry.target);
          }
        });
      }, { threshold: 0.3 });

      observer.observe(contactForm);
    }

    const formStatus = document.getElementById('form-status');
    if (contactForm && formStatus) {
      contactForm.addEventListener('submit', (event) => {
        event.preventDefault();

        const submitBtn = contactForm.querySelector('button[type="submit"]');
        const nameInput = contactForm.querySelector('#name');
        const emailInput = contactForm.querySelector('#email');
        const messageInput = contactForm.querySelector('#message');
        if (submitBtn) submitBtn.disabled = true;

        const firstName = nameInput && nameInput.value ? nameInput.value.trim().split(' ')[0] : '';
        const body = [
          `Name: ${nameInput ? nameInput.value.trim() : ''}`,
          `Email: ${emailInput ? emailInput.value.trim() : ''}`,
          '',
          messageInput ? messageInput.value.trim() : '',
        ].join('\n');

        formStatus.textContent = firstName
          ? `Thanks, ${firstName}! Opening your email app now.`
          : 'Thanks! Opening your email app now.';
        formStatus.classList.add('show');
        window.location.href = `mailto:info@phearum.vip?subject=${encodeURIComponent('PHEARUM contact message')}&body=${encodeURIComponent(body)}`;

        setTimeout(() => {
          contactForm.reset();
          if (submitBtn) submitBtn.disabled = false;
        }, 400);
      });
    }
  </script>
@endpush
