### js code

```js
async function emitDoneListClick(attempt_id: number) {
  await question_store.downloadPdf(attempt_id);
  const url = window.URL.createObjectURL(
    new Blob([downloaded_certificate.value])
  );
  const link = document.createElement("a");
  link.href = url;
  link.setAttribute("download", "file.pdf");
  document.body.appendChild(link);
  link.click();
}
```

### add to axios setting
```

export async function questionDownloadApi(request: any) {
    const url = `/download_certificate`;
    const data = await axiosInstance.post(url, {
        attempt_id: request.attempt_id,
    }, {
        //@ts-ignore
        error_alert: "questionCheckApi",
        responseType: 'blob' ---------------------------- here --------------
    });
    return {data: data};
}
```
