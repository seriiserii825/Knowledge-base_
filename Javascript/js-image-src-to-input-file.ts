async function loadImageIntoInput() {
  const img = document.getElementById('sourceImage');
  const input = document.getElementById('fileInput');
 
  const response = await fetch(img.src);
  const blob = await response.blob();
 
  const file = new File([blob], 'image.jpg', { type: blob.type });
 
  const dataTransfer = new DataTransfer();
  dataTransfer.items.add(file);
 
  input.files = dataTransfer.files;
 
  console.log('Image loaded into input!');
}
