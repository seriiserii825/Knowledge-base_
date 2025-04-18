<?php 
// woocommerce/global/quantity-input.php ?>
<div class="quantity pro-qty">
  <?php
  /**
   * Hook to output something before the quantity input field.
   *
   * @since 7.2.0
   */
  do_action('woocommerce_before_quantity_input_field');
  ?>
  <label class="screen-reader-text" for="<?php echo esc_attr($input_id); ?>"><?php echo esc_attr($label); ?></label>
  <input
    type="text"
    <?php echo $readonly ? 'readonly="readonly"' : ''; ?>
    id="<?php echo esc_attr($input_id); ?>"
    class="<?php echo esc_attr(join(' ', (array) $classes)); ?>"
    name="<?php echo esc_attr($input_name); ?>"
    value="<?php echo esc_attr($input_value); ?>"
    aria-label="<?php esc_attr_e('Product quantity', 'woocommerce'); ?>"
    <?php if (in_array($type, array('text', 'search', 'tel', 'url', 'email', 'password'), true)) : ?>
    size="4"
    <?php endif; ?>
    data-min="<?php echo esc_attr($min_value); ?>"
    data-max="<?php echo esc_attr(0 < $max_value ? $max_value : ''); ?>"
    <?php if (! $readonly) : ?>
    data-step="<?php echo esc_attr($step); ?>"
    placeholder="<?php echo esc_attr($placeholder); ?>"
    inputmode="<?php echo esc_attr($inputmode); ?>"
    autocomplete="<?php echo esc_attr(isset($autocomplete) ? $autocomplete : 'on'); ?>"
    <?php endif; ?> />
  <?php
  /**
   * Hook to output something after quantity input field
   *
   * @since 3.6.0
   */
  do_action('woocommerce_after_quantity_input_field');
  ?>
</div>

<script>
  const pro_qty = document.querySelector(".pro-qty");
  if (pro_qty) {
    const proQty = $(".pro-qty");
    const input = proQty.find("input");
    input.on("input", function () {
      // if value is not a number
      if (isNaN(this.value)) {
        this.value = 0;
      }
    });
    proQty.prepend(`<a href="#" class="dec qty-btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
          <g clip-path="url(#clip0_521_2092)">
            <path d="M3.4375 11H18.5625" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
          </g>
          <defs>
            <clipPath id="clip0_521_2092">
              <rect width="22" height="22" fill="white"/>
            </clipPath>
          </defs>
        </svg>
      </a>`);
    proQty.append(`<a href="#" class="inc qty-btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
          <g clip-path="url(#clip0_521_2088)">
            <path d="M3.4375 11H18.5625" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M11 3.4375V18.5625" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
          </g>
          <defs>
            <clipPath id="clip0_521_2088">
              <rect width="22" height="22" fill="white"/>
            </clipPath>
          </defs>
        </svg>
      </a>`);
    $("body").on("click", ".qty-btn", function (e) {
      e.preventDefault();
      var $button = $(this);
      var oldValue = $button.parent().find("input").val();
      if (!oldValue) {
        oldValue = 0;
      }
      if ($button.hasClass("inc")) {
        var newVal = parseFloat(oldValue) + 1;
      } else {
        // Don't allow decrementing below zero
        if (oldValue > 0) {
          var newVal = parseFloat(oldValue) - 1;
        } else {
          newVal = 0;
        }
      }
      $button.parent().find("input").val(newVal).change();
    });

    $(document).on("updated_cart_totals", function () {
      $(".pro-qty").append(
        '<a href="#" class="inc qty-btn">+</a><a href="#" class= "dec qty-btn">-</a>'
      );
    });
  }
</script>
<style>

.pro-qty {
  position: relative;
  display: flex;
  max-width: 22rem;
  height: 6.4rem;
  border: 1px solid #ebebeb;
  input {
    flex: 1;
    font-weight: 400;
    font-size: 1.8rem;
    text-align: center;
    padding: 0 15px;
    color: black;
    border: none;
    outline: none;
  }
  a {
    flex: 0 0 6.4rem;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  a:hover {
    color: #d25b5b;
  }
  a.inc {
    top: 0;
    border-bottom: 1px solid #e7e7e7;
  }
  a.dec {
    bottom: 0;
  }
}
</style>
