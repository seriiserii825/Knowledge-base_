### php structure file

```html
<section class="shipping-cost">
  <div class="shipping-cost__item">
    <span class="shipping-cost__label">—</span>
    <span class="shipping-cost__price">—</span>
  </div>
  <div class="shipping-cost__remaining"></div>
</section>

<script>
  window.AJAX_URL = '<?php echo admin_url("admin-ajax.php"); ?>';
</script>
```

### php logic file in functions.php

```php
add_action('wp_ajax_get_shipping_cost', 'get_shipping_cost_ajax');
add_action('wp_ajax_nopriv_get_shipping_cost', 'get_shipping_cost_ajax');

function get_shipping_cost_ajax()
{
  $cart_total = floatval($_POST['cart_total'] ?? 0);
  $threshold = 300;

  $zone = new WC_Shipping_Zone(1);
  $methods = $zone->get_shipping_methods(true);

  $shipping = null;
  $cheap_shipping_cost = 0;

  foreach ($methods as $method) {
    if ($method->id !== 'flat_rate') continue;

    $instance_id = $method->get_instance_id();
    $cost = floatval($method->get_option('cost'));

    // Запоминаем стоимость дешёвой доставки (instance 1)
    if ($instance_id == 1) {
      $cheap_shipping_cost = $cost;
    }

    if ($cart_total >= $threshold && $instance_id == 1) {
      $shipping = [
        'title' => $method->get_title(),
        'cost'  => $cost,
      ];
      break;
    }

    if ($cart_total < $threshold && $instance_id == 8) {
      $shipping = [
        'title' => $method->get_title(),
        'cost'  => $cost,
      ];
      break;
    }
  }

  wp_send_json_success([
    'shipping'           => $shipping,
    'remaining'          => max(0, $threshold - $cart_total),
    'threshold'          => $threshold,
    'cheap_shipping_cost' => $cheap_shipping_cost,
  ]);
}
```

### javascript file my.ts

```ts
import translateText from "../global/translateText";

declare global {
  interface Window {
    AJAX_URL: string;
    jQuery: any;
  }
}

const SELECTORS = {
  section: ".shipping-cost",
  label: ".shipping-cost__label",
  price: ".shipping-cost__price",
  remaining: ".shipping-cost__remaining",
  cartTotal: ".woocommerce-mini-cart__total .woocommerce-Price-amount bdi",
} as const;

const CLASSES = {
  shippingCostHidden: "shipping-cost--hidden",
  remainingAvailable: "shipping-cost__remaining--available",
} as const;

const WC_EVENTS = [
  "added_to_cart",
  "removed_from_cart",
  "updated_cart_totals",
  "wc_fragments_refreshed",
  "wc_fragments_loaded",
];

interface ShippingData {
  shipping: {
    title: string;
    cost: number;
  };
  remaining: number;
  threshold: number;
  cheap_shipping_cost: number;
}

interface AjaxResponse {
  success: boolean;
  data: ShippingData;
}

class ShippingCalculator {
  private section: HTMLElement;
  private labelEl: HTMLElement;
  private priceEl: HTMLElement;
  private remainingEl: HTMLElement;

  constructor() {
    const section = document.querySelector<HTMLElement>(SELECTORS.section);
    const labelEl = section?.querySelector<HTMLElement>(SELECTORS.label);
    const priceEl = section?.querySelector<HTMLElement>(SELECTORS.price);
    const remainingEl = section?.querySelector<HTMLElement>(SELECTORS.remaining);

    if (!section || !labelEl || !priceEl || !remainingEl) {
      throw new Error("Shipping calculator elements not found");
    }

    this.section = section;
    this.labelEl = labelEl;
    this.priceEl = priceEl;
    this.remainingEl = remainingEl;

    this.init();
  }

  private init(): void {
    this.waitForCartAndCalculate();
    this.bindEvents();
  }

  private bindEvents(): void {
    const $ = window.jQuery;

    if ($) {
      $(document.body).on(WC_EVENTS.join(" "), () => {
        setTimeout(() => this.calculate(), 100);
      });
    } else {
      WC_EVENTS.forEach((event) => {
        document.body.addEventListener(event, () => this.calculate());
      });
    }
  }

  private waitForCartAndCalculate(): void {
    let attempts = 0;
    const maxAttempts = 50;

    const checkCart = setInterval(() => {
      attempts++;
      const totalEl = document.querySelector(SELECTORS.cartTotal);

      if (totalEl) {
        clearInterval(checkCart);
        this.calculate();
      } else if (attempts >= maxAttempts) {
        clearInterval(checkCart);
        this.calculate();
      }
    }, 100);
  }

  private getCartTotal(): number {
    const totalEl = document.querySelector(SELECTORS.cartTotal);
    const text = totalEl?.textContent ?? "0";
    return parseFloat(text.replace(/[^\d.,]/g, "").replace(",", ".")) || 0;
  }

  private async calculate(): Promise<void> {
    try {
      const formData = new FormData();
      formData.append("action", "get_shipping_cost");
      formData.append("cart_total", String(this.getCartTotal()));

      const response = await fetch(window.AJAX_URL, {
        method: "POST",
        body: formData,
      });

      const result: AjaxResponse = await response.json();

      if (result.success) {
        if (result.data.remaining === result.data.threshold) {
          this.section.classList.add(CLASSES.shippingCostHidden);
        } else {
          this.section.classList.remove(CLASSES.shippingCostHidden);
          this.render(result.data);
        }
      }
    } catch (error) {
      console.error("Shipping calculation error:", error);
    }
  }

  private render(data: ShippingData): void {
    const { shipping, remaining, cheap_shipping_cost } = data;

    if (shipping) {
      if (shipping.title === "Livrare curier") {
        shipping.title = translateText({
          ro: "Livrare curier",
          ru: "Доставка курьером",
          en: "Courier delivery",
        });
      } else {
        console.error("Unknown shipping title:", shipping.title);
      }
      this.labelEl.textContent = shipping.title;
      this.priceEl.textContent = `${shipping.cost} MDL`;
    }
    const remainingText = translateText({
      ro: `Până la livrarea de ${cheap_shipping_cost} MDL mai rămân: ${remaining} MDL`,
      ru: `До доставки за ${cheap_shipping_cost} MDL осталось: ${remaining} MDL`,
      en: `Until shipping of ${cheap_shipping_cost} MDL remains: ${remaining} MDL`,
    });

    const deliveryAvailableText = translateText({
      ro: `Livrarea pentru ${cheap_shipping_cost} MDL este disponibilă!`,
      ru: `Доставка за ${cheap_shipping_cost} MDL доступна!`,
      en: `Shipping for ${cheap_shipping_cost} MDL is available!`,
    });

    this.remainingEl.textContent = remaining > 0 ? remainingText : deliveryAvailableText;
    if (remaining <= 0) {
      this.remainingEl.classList.add(CLASSES.remainingAvailable);
    } else {
      this.remainingEl.classList.remove(CLASSES.remainingAvailable);
    }
  }
}

export function shippingCalculator(): void {
  try {
    new ShippingCalculator();
  } catch (e) {
    console.log(e);
  }
}
```

### javascript file translateText

```typescript
interface IText {
  ro: string;
  ru: string;
  en: string;
}

export default function translateText(textObj: IText): string {
  const lang = getCurrentLang();
  if (lang === "ru") {
    return textObj.ru;
  } else if (lang === "en") {
    return textObj.en;
  } else {
    return textObj.ro;
  }
}

function getCurrentLang() {
  const lang_html = document.querySelector("html") as HTMLElement;
  const current_lang = lang_html.getAttribute("lang") as string;
  let lang_code = "ro";
  if (current_lang.includes("ru")) {
    lang_code = "ru";
  } else if (current_lang.includes("en")) {
    lang_code = "en";
  }
  return lang_code;
}
```

### php file translateText

```php
function translateText($text_ro, $text_ru, $text_en)
{
  if (get_lang() === '_ro') {
    return $text_ro;
  } elseif (get_lang() === '_ru') {
    return $text_ru;
  } else {
    return $text_en;
  }
}
```
