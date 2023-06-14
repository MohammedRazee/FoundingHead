function scrollToSection() {
  const sectionHeight = window.innerHeight;
  const currentScrollPosition = window.scrollY;
  const targetScrollPosition = currentScrollPosition + sectionHeight;
  const scrollStep = (targetScrollPosition - currentScrollPosition) / 100;
  let currPos = currentScrollPosition;

  function scrollAnimation() {
    if (currPos >= targetScrollPosition) {
      return;
    }

    currPos += scrollStep;
    if (currPos > targetScrollPosition) {
      currPos = targetScrollPosition;
    }
    window.scrollTo(0, currPos);
    requestAnimationFrame(scrollAnimation);
  }

  scrollAnimation();
}

setTimeout(scrollToSection, 2000);