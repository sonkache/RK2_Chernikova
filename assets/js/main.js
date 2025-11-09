document.addEventListener('DOMContentLoaded', () => {
  const slider = document.querySelector('.slider');
  if (!slider) return;

  const slides = Array.from(slider.querySelectorAll('.slides img'));
  if (!slides.length) return;

  let i = slides.findIndex(s => s.classList.contains('active'));
  if (i < 0) i = 0;

  const show = (n) => slides.forEach((img, idx) => img.classList.toggle('active', idx === n));
  show(i);

  const prev = slider.querySelector('.prev');
  const next = slider.querySelector('.next');

  prev && prev.addEventListener('click', () => { i = (i - 1 + slides.length) % slides.length; show(i); });
  next && next.addEventListener('click', () => { i = (i + 1) % slides.length; show(i); });

  let t = setInterval(() => { i = (i + 1) % slides.length; show(i); }, 5000);
  slider.addEventListener('mouseenter', () => clearInterval(t));
  slider.addEventListener('mouseleave', () => {
    clearInterval(t);
    t = setInterval(() => { i = (i + 1) % slides.length; show(i); }, 5000);
  });
});
