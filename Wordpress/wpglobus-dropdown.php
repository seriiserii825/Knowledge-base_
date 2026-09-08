// List

    <div class="language">
        <?php if (!dynamic_sidebar('sidebar-1')) : ?>
            <h3>add language widget</h3>
        <?php endif; ?>
        <div class="language__btn">
            <svg class="globe" width="18" height="18" viewBox="0 0 18 18" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_205_11541)">
                    <path d="M9 15.75C12.7279 15.75 15.75 12.7279 15.75 9C15.75 5.27208 12.7279 2.25 9 2.25C5.27208 2.25 2.25 5.27208 2.25 9C2.25 12.7279 5.27208 15.75 9 15.75Z"
                          stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6.1875 9C6.1875 11.6339 7.12477 13.9866 8.59781 15.5735C8.64898 15.6292 8.71115 15.6736 8.78038 15.704C8.84961 15.7344 8.92439 15.7501 9 15.7501C9.07561 15.7501 9.15039 15.7344 9.21962 15.704C9.28885 15.6736 9.35102 15.6292 9.40219 15.5735C10.8752 13.9866 11.8125 11.6339 11.8125 9C11.8125 6.36609 10.8752 4.01343 9.40219 2.42648C9.35102 2.37082 9.28885 2.32639 9.21962 2.296C9.15039 2.2656 9.07561 2.24991 9 2.24991C8.92439 2.24991 8.84961 2.2656 8.78038 2.296C8.71115 2.32639 8.64898 2.37082 8.59781 2.42648C7.12477 4.01343 6.1875 6.36609 6.1875 9Z"
                          stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2.63379 6.75H15.366" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2.63379 11.25H15.366" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                </g>
                <defs>
                    <clipPath id="clip0_205_11541">
                        <rect width="18" height="18" fill="white"/>
                    </clipPath>
                </defs>
            </svg>
            <span>Italiano</span>
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_1015_1148)">
                    <path d="M9.75 4.5L6 8.25L2.25 4.5" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"/>
                </g>
                <defs>
                    <clipPath id="clip0_1015_1148">
                        <rect width="12" height="12" fill="white"/>
                    </clipPath>
                </defs>
            </svg>
        </div>
    </div>
<script>
export default function wpGlobus() {
    const html = document.querySelector('html');
    const lang = html?.getAttribute('lang')
    let lang_span = document.querySelector('.language__btn span');
    const btn = document.querySelector('.language__btn');
    const list = document.querySelector('.widget_wpglobus');

    btn?.addEventListener('click', () => {
        list?.classList.toggle('active');
    });


    if (lang_span) {
        if (lang === 'it-IT') {
            lang_span.textContent = 'Italiano';
        } else {
            lang_span.textContent = 'English';
        }
    }
}
</script>

<style lang="scss">
.language {
  position: relative;
  padding-left: 1.9rem;
  padding-right: 2.2rem;
  &__btn {
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
    span {
      display: inline-block;
      margin-left: 0.6rem;
      margin-right: 0.4rem;
      font-size: 1.4rem;
    }
  }
  .widget-title {
    display: none;
  }
  .widget_wpglobus {
    position: absolute;
    top: 3rem;
    left: 0;
    display: block;
    padding: 2.2rem;
    width: 17rem;
    background: var(--accent);
    border-radius: 1.6rem;
    transition: all .6s;
    opacity: 0;
    pointer-events: none;
    transform: translateY(50%);
    &.active {
      opacity: 1;
      pointer-events: all;
      transform: translateY(0);
    }
    a {
      display: block;
      padding-bottom: 1.2rem;
      font-size: 1.4rem;
      font-weight: bold;
      &:last-of-type {
        padding-top: 1.2rem;
        padding-bottom: 0;
        border-top: 1px solid var(--border-color);
        opacity: 0.8;
      }
    }
    .code {
      display: none !important;
    }
  }
}
</style>
