<div class="form-row">
  <div class="form-group form-group--file">
    <label for="city">Curriculum</label>
    [file* file id:file filetypes:pdf|txt|csv|xml limit:2mb]
    <div class="form-file__label"></div>
    <div class="form-file"></div>
  </div>
</div>
<script>
  export default function fileInput() {
    const file = document.querySelector('input[name="file"]');
    if (file) {
      file.addEventListener("change", (e) => {
        // Get the selected file
        const [file] = e.target.files;
        // Get the file name and size
        const {
          name: fileName,
          size
        } = file;
        // Convert size in bytes to kilo bytes
        const fileSize = (size / 1000).toFixed(2);
        // Set the text content
        const fileNameAndSize = `${fileName} - ${fileSize}KB`;
        document.querySelector(".form-file").textContent = fileNameAndSize;
      });
    }
  }
</script>
<style>
  .form-group--file {
    position: relative;
    margin-bottom: 4rem;

    span[data-name="file"],
    input[type="file"] {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      cursor: pointer;
    }

    input[type="file"] {
      opacity: 0;
    }

    .wpcf7-not-valid-tip {
      position: absolute;
      bottom: -2rem;
      left: 0;
      width: 100%;
      color: red;
      display: block;
      z-index: 10;
    }

    .form-file {
      margin-top: 1rem;
      color: white;
    }

    .form-file__label {
      position: relative;
      height: 5.5rem;
      pointer-events: none;

      &::after {
        display: flex;
        justify-content: center;
        align-items: center;
        top: 0;
        left: 0;
        border-radius: 5rem;
        content: "Allega il tuo Curriculum";
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: #f3f6f7;
        border: 1px solid rgba(#666666, 0.3);
        pointer-events: none;
        cursor: pointer;
      }

      &::before {
        content: "";
        display: block;
        position: absolute;
        right: 3.5rem;
        top: 2.9rem;
        width: 18px;
        height: 20px;
        background-image: url(../i/static/pin2.svg);
        background-position: center center;
        background-repeat: no-repeat;
        background-size: 100%;
        z-index: 1;
        will-change: transform;
        transition: transform 300ms ease-out;
        backface-visibility: hidden;
      }

      &:hover {
        &::before {
          transform: scale(1.3) translateX(-2rem);
        }
      }
    }
  }
</style>
