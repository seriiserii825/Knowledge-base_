<template>
  <form class="form">
    <slot name="title"></slot>
    <div class="form__body">
      <slot name="form-group-1"></slot>
      <slot name="form-group-2"></slot>
      <slot name="form-group-3"></slot>
      <footer class="form__footer">
        <slot name="submit"></slot>
      </footer>
    </div>
  </form>
</template>

<script>

export default {}
</script>

<style lang="scss">
@import "src/assets/scss/variables";
.form {
  width: 400px;
  box-shadow: 0 4px 18px rgba(black, .4);
  @media screen and (max-width: 430px) {
    width: 300px;
  }
  &__title {
    padding: 2rem;
    color: white;
    background-color: $accent;
  }
  &__body {
    padding: 4rem 2rem 2rem;
  }
  &__group {
    position: relative;
    display: flex;
    align-items: center;
    margin-bottom: 3rem;
    &.active {
      label {
        top: -1.5rem;
        font-size: 1.2rem;
        color: $accent;
      }
      input {
        border-bottom-color: $accent;
        outline: none;
      }
      svg {
        color: $accent;
      }
    }
    &.invalid {
      label {
        color: red;
      }
      input {
        border-bottom-color: red;
      }
      svg {
        color: red;
      }
    }
  }
  &__footer {
    text-align: right;
  }
  label {
    position: absolute;
    top: 30%;
    left: 4.5rem;
    font-size: 1.4rem;
    transition: all .4s;
    cursor: text;
    z-index: 1;
    @media screen and (max-width: 1200px) {
      font-size: 1.8rem;
    }
  }
  input {
    position: relative;
    width: 100%;
    height: 4rem;
    font-size: 1.6rem;
    border: none;
    border-bottom: 1px solid #888;
    transition: all .4s;
    background-color: transparent;
    z-index: 2;
    @media screen and (max-width: 1200px) {
      font-size: 1.8rem;
    }
  }
  svg {
    margin-right: 2rem;
    transition: all .4s;
  }
  .field-error {
    position: absolute;
    bottom: -1.4rem;
    left: 4rem;
    font-size: 1.2rem;
    color: red;
  }
}
</style>
