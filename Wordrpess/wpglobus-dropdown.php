// dropdown with flags
<div class="language">
  <?php if (!dynamic_sidebar('sidebar-1')) : ?>
    <h3>add language widget</h3>
  <?php endif; ?>
  <div class="language__btn">
    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
      <g clip-path="url(#clip0_1015_1148)">
        <path d="M9.75 4.5L6 8.25L2.25 4.5" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" />
      </g>
      <defs>
        <clipPath id="clip0_1015_1148">
          <rect width="12" height="12" fill="white" />
        </clipPath>
      </defs>
    </svg>

  </div>
</div>
<script>
  export default function wpGlobus() {
    const current_lang = document.querySelector('.wpglobus-current-language');
    const lang_list = document.querySelector('.dropdown-styled ul ul');

    const wpglobus_css = document.querySelector('#wpglobus-css');
    document.getElementsByTagName('head')[0].removeChild(wpglobus_css);

    current_lang.addEventListener('click', function(e) {
      e.preventDefault();
      console.log(current_lang, 'current_lang')
      lang_list.classList.toggle('active');
    });

  }
</script>

<style lang="scss">
.language {
  position: relative;
  margin-left: 4rem;
  &__btn {
     position: absolute;
      top: -4px;
      right: -2rem;
  }
  .widget-title {
    display: none;
  }
  .wpglobus-current-language {
    font-size: 0;
  }
  .wpglobus-selector-link  {
    display: flex;
    align-items: center;
  }
  .dropdown-styled {
    position: relative;
    ul {
      ul {
        position: absolute;
        top: 33px;
        right: 0;
        width: 18rem;
        color: white;
        background: #498EBE;
        border-radius: 5px;
        transition: opacity .4s, transform .6s;
        transform: translateY(50%);
        opacity: 0;
        &.active {
          opacity: 1;
          transform: translateY(0);
        }
        li {
          padding: 1.6rem;
          transition: all .4s;
          &:not(:last-of-type) {
            border-bottom: 1px solid #3F84B5;
          }
          &:hover {
            background: #3F84B5;
          }
        }
      }
    }
  }
}
</style>
