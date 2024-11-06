const scrollContainer = document.querySelector('.scroll-container');
// Optional: Check if it's a touch device
const isTouchDevice = 'ontouchstart' in window || navigator.maxTouchPoints > 0;

if (isTouchDevice) {
    scrollContainer?.addEventListener('touchstart', (e) => {
        // Handle touchstart event (if needed)
    });

    scrollContainer?.addEventListener('touchmove', (e) => {
        // Handle touchmove event for smooth scrolling
        // e.g., add momentum, inertia scrolling, etc.
    });

    scrollContainer?.addEventListener('wheel', (e) => {
        // Add smooth scrolling on wheel (desktop fallback)
        e.preventDefault();
        scrollContainer.scrollBy({
            top: e.deltaY * 2,
            behavior: 'smooth'
        });
    });
}
