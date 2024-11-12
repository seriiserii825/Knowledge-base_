<?php
$home_intro = get_field('home_intro');
$items = $home_intro['items'];
$image = $home_intro['image'];
$title = $home_intro['title'];

?>

<div class="home-intro">
    <div class="home-intro__body">
        <div class="home-intro__container">
            <div class="home-intro__star">
                <?php get_template_part('/template-parts/icons/star-icon'); ?>
            </div>
            <img class="home-intro__img-bg" src="<?php echo $image; ?>" alt="">
            <div class="container">
                <!-- <div id="scroll-index">Scroll index: <span></span></div> -->
                <!-- <div id="scroll-direction">Scroll direction: <span></span></div> -->
                <h1 class="home-intro__title">
                    <?php echo $title; ?>
                </h1>

                <?php foreach ($items as $key => $item) : ?>
                    <p><?php echo $item['text']; ?></p>
                <?php endforeach; ?>

            </div>
            <a class="home-intro__scroll-btn">
                <?php get_template_part('/template-parts/icons/down-icon'); ?>
            </a>

        </div>
    </div>
</div>

<style lang="scss">
.home-intro {
  height: 100vh;
  &__container {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 9rem 0 9.6rem;
    width: 100%;
    height: 100vh;

    @media screen and (max-width: 1600px) {
      padding: 9rem 0 6rem;
    }
    @media screen and (max-width: 578px) {
      padding: 9rem 0 10rem;
    }
  }

  &__star {
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    max-width: 78px;
    max-height: 78px;
    top: 17rem;
    left: 55%;
    transform: translateX(-50%);
    z-index: 2;
    overflow: hidden;

    @media screen and (max-width: 992px) {
      top: 15rem;
    }

    @media screen and (max-width: 768px) {
      top: 9rem;
    }

    svg {
      cursor: pointer;
      animation: kaboom 2s ease-in-out alternate infinite;
      g {
        ellipse {
          transition: all 0.8s;
        }
      }
      &:hover {
        transition: all 0.8s;
        g {
          ellipse {
            fill: #ffdf6a;
          }
        }
      }
    }
  }

  @keyframes kaboom {
    0% {
      transform: scale(0.8);
    }

    50% {
      transform: scale(1.2);
    }

    100% {
      transform: scale(0.8);
    }
  }

  .container {
    position: relative;
    z-index: 3;

    @media screen and (max-height: 852px) {
      margin-top: 5rem;
    }
  }

  &__img-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  &__title {
    position: relative;
    color: #fff;
    text-align: center;
    font-size: 9.6rem;
    font-weight: 400;
    line-height: normal;
    letter-spacing: -3.84px;

    //Height
    @media screen and (max-height: 970px) {
      font-size: 6rem;
      line-height: 6rem;
      margin-bottom: 2rem;
    }
    @media screen and (max-height: 720px) {
      // margin-top: 12rem;
      font-size: 3rem;
      line-height: 4rem;
      letter-spacing: 0;
    }
    //width

    @media screen and (max-width: 992px) {
      font-size: 6rem;
      line-height: 6.5rem;
    }
    @media screen and (max-width: 768px) {
      font-size: 3.2rem;
      line-height: 3.5rem;
      letter-spacing: -1px;
    }

    @media screen and (max-width: 360px) {
      font-size: 2.6rem;
      line-height: 3.5rem;
    }
  }
  p {
    position: relative;
    margin: 0 auto;
    max-width: 64rem;
    font-size: 1.6rem;
    text-align: center;
    font-weight: 400;
    line-height: normal;
    letter-spacing: -0.048rem;
    cursor: pointer;
    @media screen and (max-width: 576px) {
      max-width: 50vw;
    }
    @media screen and (max-width: 350px) {
      font-size: 1.4rem;
    }
  }

  &__scroll-btn {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    bottom: 3.2rem;
    z-index: 5;
    border-radius: 32px;
    background: #5ecfff;
    display: flex;
    width: 5.6rem;
    height: 5.6rem;
    padding: 12px;
    align-items: center;
    gap: 1rem;
    cursor: pointer;
    transition: all 0.4s;

    @media screen and (max-height: 770px) {
      margin-top: 2rem;
    }
    svg {
      transition: all 0.4s;
    }
    &:hover {
      svg {
        transform: translateY(15%);
      }
    }
  }
}
</style>

<script>
import gsap from "gsap";
export default function introScoll() {
  const homeIntro = document.querySelector(".home-intro");
  const items = homeIntro?.querySelectorAll(".home-intro p");
  const title = document.querySelector(".home-intro__title");

  let direction = "down";
  let event: any = null;
  let touch_direction = 0;

  document.addEventListener("touchstart", function (e) {
    event = e;
  });
  document.addEventListener("touchmove", function (e) {
    if (event) {
      console.log(
        "Move delta: " + (e.touches[0].pageY - event.touches[0].pageY)
      );
      touch_direction = e.touches[0].pageY - event.touches[0].pageY;
    }
  });
  document.addEventListener("touched", function (e) {
    event = null;
  });

  const isTouchDevice =
    "ontouchstart" in window || navigator.maxTouchPoints > 0;

  if (!items?.length) return;
  let scroll_index = 0;
  let totalItems = items.length;
  const scroll_width = getScrollWidth();
  const duration = 1;

  gsap.set(title, {
    y: " top center",
  });

  items.forEach((item, index) => {
    gsap.set(item, {
      y: "24vh",
      opacity: 0,
    });
  });

  function scrollDown() {
    if (direction !== "down") {
      direction = "down";
      scroll_index += 1;
    }
    if (scroll_index === 0) {
      firstStep(items);
    } else {
      nextStep(items);
    }
    if (scroll_index === totalItems) {
      showScroll();
    } else {
      scroll_index++;
    }
  }

  function scrollUp() {
    if (window.scrollY < 50) {
      hideScroll();
      handleScroll = throttle(handleScroll, 1200);
    }
    if (direction !== "up") {
      direction = "up";
      scroll_index -= 2;
    }
    prevStep(items);
    if (scroll_index === -1) {
      scroll_index = -1;
      gsap.to(title, {
        y: " top center",
        duration,
      });
    } else {
      scroll_index--;
    }
  }

  function handleScroll(event: any) {
    if (!items?.length) return;
    if (isTouchDevice) {
      if (touch_direction < 0) {
        scrollDown();
      } else {
        scrollUp();
      }
    } else {
      if (event.deltaY > 0) {
        scrollDown();
      } else {
        scrollUp();
      }
    }
  }

  function firstStep(items: any) {
    setActive(items);
    gsap.to(title, {
      duration,
      y: "-13vh",
    });
    gsap.to(items[0], {
      y: 0,
      opacity: 1,
      duration,
    });
    gsap.to(items[1], {
      y: "14vh",
      opacity: 1,
      duration,
    });
  }

  function prevStep(items: any) {
    setActive(items);
    // console.log(scroll_index, "scroll_index");

    if (scroll_index == 1) {
      removeActive(items);
      movePrev(items);
      showCurrent(items);
      moveNext(items, false);
      moveNextOld(items);
    } else if (scroll_index <= totalItems - 2) {
      removeActive(items);
      movePrevOld(items);
      movePrev(items);
      showCurrent(items);
      moveNext(items, false);
      moveNextOld(items);
    } else {
      showScroll();
    }
  }

  function nextStep(items: any) {
    setActive(items);
    // console.log(scroll_index, "scroll_index");

    if (scroll_index == 1) {
      removeActive(items);
      movePrev(items);
      showCurrent(items);
      moveNext(items);
    } else if (scroll_index <= totalItems - 2) {
      removeActive(items);
      movePrevOld(items);
      movePrev(items);
      showCurrent(items);
      moveNext(items);
    } else {
      showScroll();
    }
  }

  function setActive(items: any) {
    if (items[scroll_index]) {
      gsap.to(items[scroll_index], {
        color: "white",
        scale: 1.6,
        duration,
      });
    }
  }

  function removeActive(items: any) {
    if (items[scroll_index - 1]) {
      gsap.to(items[scroll_index - 1], {
        color: "#ffffff66",
        scale: 1,
        duration,
      });
    }
    if (items[scroll_index + 1]) {
      gsap.to(items[scroll_index + 1], {
        color: "#ffffff66",
        scale: 1,
        duration,
      });
    }
  }

  function movePrevOld(items: any) {
    if (items[scroll_index - 2]) {
      // items[scroll_index - 2].style.color = "red";
      gsap.to(items[scroll_index - 2], {
        y: "-8vh",
        opacity: 0,
        scale: 0,
        duration: 1,
      });
    }
  }

  function movePrev(items: any) {
    if (items[scroll_index - 1]) {
      // items[scroll_index - 1].style.color = "green";
      gsap.to(items[scroll_index - 1], {
        y: "-8vh",
        opacity: 1,
        duration,
      });
    }
  }

  function showCurrent(items: any) {
    if (items[scroll_index]) {
      // items[scroll_index].style.color = "blue";
      gsap.to(items[scroll_index], {
        y: 0,
        opacity: 1,
        duration,
      });
    }
  }

  function moveNext(items: any, up: boolean = true) {
    // console.log(scroll_index, "scroll_index moveNext");
    if (items[scroll_index + 1]) {
      // items[scroll_index + 1].style.color = "yellow";
      const y = "12vh";
      const opacity = 1;
      const scale = up ? 1 : 1;
      gsap.to(items[scroll_index + 1], {
        y,
        opacity,
        scale,
        duration,
      });
    }
  }

  function moveNextOld(items: any) {
    // console.log(scroll_index, "scroll_index move next old");
    if (items[scroll_index + 2]) {
      // items[scroll_index + 2].style.color = "magenta";
      gsap.to(items[scroll_index + 2], {
        y: "24vh",
        opacity: 0,
        scale: 0,
        duration: 1,
      });
    }
  }

  function throttle(func: any, ms: number) {
    let isThrottled = false;
    let savedArgs: any;
    let savedThis: any;
    function wrapper() {
      if (isThrottled) {
        savedArgs = arguments;
        savedThis = this;
        return;
      }
      func.apply(this, arguments);
      isThrottled = true;
      setTimeout(function () {
        isThrottled = false;
        if (savedArgs) {
          // wrapper.appply(savedThis, savedArgs);
          savedArgs = savedThis = null;
        }
      }, ms);
    }
    return wrapper;
  }

  // if scrollTop is less 200px
  if (window.scrollY < 50) {
    hideScroll();
    handleScroll = throttle(handleScroll, 1200);

    if (isTouchDevice) {
      homeIntro?.addEventListener("touchstart", handleScroll);
    } else {
      homeIntro?.addEventListener("wheel", handleScroll);
    }
    // Add mouse wheel scroll listener
  }
  function getScrollWidth() {
    // Create a temporary element
    const scrollbarTester = document.createElement("div");

    // Apply styles to the element to make the scrollbar appear
    scrollbarTester.style.width = "100px";
    scrollbarTester.style.height = "100px";
    scrollbarTester.style.overflow = "scroll"; // Force scrollbar
    scrollbarTester.style.position = "absolute"; // Avoid affecting page layout
    scrollbarTester.style.top = "-9999px"; // Move it off-screen

    // Append the element to the body
    document.body.appendChild(scrollbarTester);

    // Calculate the scrollbar width
    const scrollbarWidth =
      scrollbarTester.offsetWidth - scrollbarTester.clientWidth;

    // Remove the element from the document
    document.body.removeChild(scrollbarTester);

    return scrollbarWidth;
  }
  function showScroll() {
    document.body.style.overflow = "auto";
    document.body.style.paddingRight = `0px`;
  }
  function hideScroll() {
    document.body.style.paddingRight = `${scroll_width}px`;
    document.body.style.overflow = "hidden";
  }
}
</script>
