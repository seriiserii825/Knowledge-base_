<script>
    fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrf_token,
            },
            body: JSON.stringify({
                _method: "DELETE",
            }),
        })
        .then((response) => response.json())
        .then((data) => {
            console.log(data, "data");
            closeModal();
            window.location.reload();
        })
        .catch((error) => {
            console.error("Error:", error);
        });
</script>
