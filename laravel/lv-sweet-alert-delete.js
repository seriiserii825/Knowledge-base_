import Swal from "sweetalert2";
export default function delItem() {
    const del_items = document.querySelectorAll(".js-delete-item");
    del_items.forEach((del_item) => {
        del_item.addEventListener("click", (e) => {
            e.preventDefault();
            const url = del_item.getAttribute("href");
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log(result.isConfirmed, "result.isConfirmed");
                    fetch(url, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute("content"),
                        },
                    })
                        .then((response) => {
                            if (response.ok) {
                                return response.json();
                            } else {
                                throw new Error("Something went wrong");
                            }
                        })
                        .then((data) => {
                            if (data.status === "success") {
                                Swal.fire({
                                    title: "Success",
                                    text: data.message,
                                    icon: "success",
                                    confirmButtonText: "OK",
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                console.error(data.message);
                            }
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                }
            });
        });
    });
}
