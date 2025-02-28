async function downloadAndZipPDFs(pdfUrls: string[], btn_title: string) {
  const button_title = btn_title.replace(/\s/g, "_");
  const zip = new JSZip();
  const folder = zip.folder(button_title);

  for (const url of pdfUrls) {
    const filename = url.split("/").pop();
    const response = await fetch(url);
    const blob = await response.blob();
    folder.file(filename, blob);
  }

  const zipBlob = await zip.generateAsync({ type: "blob" });
  const link = document.createElement("a");
  link.href = URL.createObjectURL(zipBlob);
  link.download = `${button_title}.zip`;
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}
