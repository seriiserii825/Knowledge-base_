const useDownloadPdf = (event) => {
    if (event.scheduling_pdf) {
        const pdf = event.scheduling_pdf;
        window.open(pdf, '_blank');
    }
}

export default useDownloadPdf;