function downloadFile() {
  const download_file_array = file_path.value.split('/');
  const file_name = download_file_array[download_file_array.length - 1];
  axios({
    url: file_path.value,
    method: 'GET',
    responseType: 'blob',
  }).then((response) => {
    let fileURL = window.URL.createObjectURL(new Blob([response.data]));
    let fURL = document.createElement('a');

    fURL.href = fileURL;
    fURL.setAttribute('download', file_name);
    document.body.appendChild(fURL);

    fURL.click();
  });
}
