// for html anchor tag
// <a href="files/example.pdf" download>Download PDF</a>

function downloadFile() {
  const download_file_array = file_path.value.split("/");
  const file_name = download_file_array[download_file_array.length - 1];
  axios({
    url: file_path.value,
    method: "GET",
    responseType: "blob",
  }).then((response) => {
    let fileURL = window.URL.createObjectURL(new Blob([response.data]));
    let fURL = document.createElement("a");

    fURL.href = fileURL;
    fURL.setAttribute("download", file_name);
    document.body.appendChild(fURL);

    fURL.click();
  });
}

//================== Vue js

function downloadItem({ url, label }) {
  axios
    .get(url, { responseType: "blob" })
    .then((response) => {
      const blob = new Blob([response.data], { type: "application/pdf" });
      const link = document.createElement("a");
      link.href = URL.createObjectURL(blob);
      link.download = label;
      link.click();
      URL.revokeObjectURL(link.href);
    })
    .catch(console.error);
}
function downloadPdf() {
  if (event.value.scheduling_pdf) {
    const pdf = event.value.scheduling_pdf;
    const pdf_array = pdf.split("/");
    const file_name = pdf_array[pdf_array.length - 1];
    downloadItem({ url: pdf, label: file_name });
  }
}
