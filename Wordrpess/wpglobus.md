admin widgets list

<div class="language">
    <div class="language__current">IT</div>
    <?php if (!dynamic_sidebar('sidebar-1')): ?>
        <h3>add language widget</h3>
    <?php endif; ?>
</div>


.language {
  position: relative;
  top: 9px;
  text-align: left;
  @media screen and (max-width: 768px) {
    right: 6.4rem;
  }
  &__current {
    padding: 0 3.2rem;
    font-size: 14px;
    text-align: left;
    cursor: pointer;
    transition: all .4s;
    &:hover {
      color: var(--accent);
    }
  }
  .widget_wpglobus {
    position: absolute;
    top: 5rem;
    right: 0;
    opacity: 0;
    pointer-events: none;
    transition: all .4s;
    &.active {
      opacity: 1;
      pointer-events: auto;
    }
  }
  .widget-title {
    display: none;
  }
  .list {
    padding: 3.2rem;
    background: var(--accent);
    a {
      display: block;
      font-size: 14px;
      text-transform: uppercase;
      opacity: 0.8;
      transition: all .4s;
      &:not(:last-of-type) {
        margin-bottom: 3.2rem;
      }
      &:hover {
        opacity: 1;
      }
    }
    .code {
      display: none !important;
    }
  }
}


export default function languageSelector() {
    const language_current = document.querySelector('.language__current');
    const widget_wpglobus = document.querySelector('.widget_wpglobus');
    const widget_current_language = document.querySelector('.wpglobus-current-language');
    const code = widget_current_language.querySelector('.code').textContent;
    language_current.textContent = code;

    language_current.addEventListener('click', function () {
        widget_wpglobus.classList.toggle('active');
    });
}
