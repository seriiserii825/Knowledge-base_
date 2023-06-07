<?php
//y2mate extenstion or yotubepp.com
?>

<div class="gallery">
  <?php foreach ($gallery as $item) : ?>
    <?php
    $image = $item['image'];
    $video_id = $item['video_id'];
    $text = $item['text'];
    ?>
    <div class="gallery__item" data-video-id="<?php echo $video_id; ?>">
      <div class="gallery__img">
        <img src="<?php echo $image; ?>" alt="">
        <div class="gallery__play">
          <svg width="15" height="18" viewBox="0 0 15 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15 9L0 17.6603L0 0.339746L15 9Z" fill="white" />
          </svg>
        </div>
      </div>
      <div class="gallery__content"><?php echo $text; ?></div>
    </div>
  <?php endforeach; ?>
</div>

<script>
  export default function galleryVideo() {
    const gallery_play_all = document.querySelectorAll('.gallery__play');

    gallery_play_all.forEach((item) => {
      item.addEventListener('click', (e) => {
        const target = e.target as HTMLElement;
        const parent = target.closest('.gallery__item');
        const video_id = parent.getAttribute('data-video-id');
        const iframe = document.createElement("iframe");
        const gallery_img = parent.querySelector('.gallery__img');
        iframe.setAttribute("width", "100%");
        iframe.setAttribute("height", "100%");
        iframe.setAttribute(
          "src",
          `https://www.youtube-nocookie.com/embed/${video_id}?autoplay=1`
        );
        iframe.setAttribute("frameborder", "0");
        iframe.setAttribute(
          "allow",
          "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        );
        iframe.setAttribute("allowfullscreen", "true");
        parent.classList.add('active');
        gallery_img.insertAdjacentHTML('afterbegin', iframe.outerHTML);
      });
    });
  }
</script>
