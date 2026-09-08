<div class="send-email">
  <div class="send-email__top">
    <?php echo get_template_part('template-parts/icons/icon-send-email-top'); ?>
  </div>
  <input type="text" placeholder="Email">
  <button>Continua</button>
  <div class="send-email__bottom">
    <?php echo get_template_part('template-parts/icons/icon-send-email-bottom'); ?>
  </div>
  <div class="send-email__error">L'e-mail è obbligatoria</div>
</div>
<style>
.send-email {
  position: relative;
  display: inline-flex;
  @media screen and (max-width: 992px) {
    margin-bottom: 6.4rem;
  }
  @media screen and (max-width: 576px) {
    width: 100%;
  }
  input,
  button {
    height: 5.2rem;
  }
  input {
    width: 33.3rem;
    padding: 0 1.6rem;
    font-size: 1.5rem;
    font-weight: 400;
    letter-spacing: -0.06rem;
    color: var(--text-color);
    border-radius: 0rem 0rem 0rem 1.2rem;
    border: 1px solid var(--accent);
    background: var(--Blue-Lightest, #c0e9fd);
    @media screen and (max-width: 576px) {
      width: 70%;
    }
    &:focus {
      outline: 1px solid var(--accent);
    }
    &::placeholder {
      color: var(--text-color);
    }
  }
  button {
    width: 14.7rem;
    font-size: 2rem;
    font-weight: 600;
    letter-spacing: -0.08rem;
    text-align: center;
    color: #fff;
    border-radius: 0rem 1.2rem 0rem 0rem;
    border: 1px solid var(--accent);
    background: var(--accent);
    @media screen and (max-width: 576px) {
      width: 30%;
    }
    &:focus {
      outline: 0.1rem solid var(--accent);
    }
  }
  &__top,
  &__bottom {
    position: absolute;
    left: 0;
    display: block;
    width: 100%;
    z-index: -1;
    svg {
      width: 100%;
    }
  }
  &__top {
    top: -1.4rem;
  }
  &__bottom {
    bottom: -0.9rem;
  }
  &__error {
    position: absolute;
    bottom: -2.4rem;
    left: 0;
    display: none;
    font-size: 1.4rem;
    font-style: italic;
    color: red;
    &.active {
      display: block;
    }
  }
}
</style>
