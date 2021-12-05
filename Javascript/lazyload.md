npm install lazyload

#img
<img class="lazyload" data-src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full');?>" alt="" />

#js
import lazyload from "lazyload";

export default function portfolioLazyLoading() {
  let images = document.querySelectorAll(".lazyload");
  console.log(images, "images");
  lazyload(images);
}
