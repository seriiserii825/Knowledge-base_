<div class="footer-popup">
  <div class="footer-popup__body">
    <header class="footer-popup__header">
      <h2 class="footer-popup__title">Per ulteriori informazioni</h2>
      <div class="footer-popup__close">
        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g id="X" clip-path="url(#clip0_23_998)">
            <path id="Vector" d="M10.9375 3.0625L3.0625 10.9375" stroke="#524A73" stroke-linecap="round" stroke-linejoin="round" />
            <path id="Vector_2" d="M10.9375 10.9375L3.0625 3.0625" stroke="#524A73" stroke-linecap="round" stroke-linejoin="round" />
          </g>
          <defs>
            <clipPath id="clip0_23_998">
              <rect width="14" height="14" fill="white" />
            </clipPath>
          </defs>
        </svg>
      </div>
    </header>
    <?php echo do_shortcode('[contact-form-7 id="eb0d207" title="Form popup"]'); ?>
  </div>
</div>
<style>
.footer-popup {
  position: fixed;
  top: 0;
  left: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.8);
  z-index: 9999;
  opacity: 0;
  pointer-events: none;
  transition: all .4s;
  &.active {
    opacity: 1;
    pointer-events: all;
  }
  &__body {
    flex: 0 0 68.8rem;
    padding: 4.8rem;
    border-radius: 1.6rem;
    border: 1px solid var(--Blue-Lightest, #c0e9fd);
    background: #fff;
    @media screen and (max-width: 576px) {
      flex: initial;
      padding: 3.2rem;
      width: 96%;
    }
  }
  &__header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 3.2rem;
  }
  &__close {
    display: flex;
    justify-content: center;
    align-items: center;
    flex: 0 0 2.6rem;
    height: 2.6rem;
    background: #c0e9fd;
    border-radius: 50%;
    cursor: pointer;
  }
}
</style>
