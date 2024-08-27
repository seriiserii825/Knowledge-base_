export const useCopyClipboard = (text: string) => {

  // Create a temporary textarea element
  var tempTextarea = document.createElement('textarea');

  // Set the value of the textarea to the text you want to copy
  tempTextarea.value = text;

  // Append the textarea to the body
  document.body.appendChild(tempTextarea);

  // Select the text inside the textarea
  tempTextarea.select();

  // Copy the selected text
  document.execCommand('copy');

  // Remove the temporary textarea
  document.body.removeChild(tempTextarea);
}
