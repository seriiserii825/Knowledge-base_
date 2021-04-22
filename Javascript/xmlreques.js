// // if data is json
// $_POST = json_decode(file_get_contents("php://input", true), true);
//echo var_dump($_POST);
export default function formPost() {

    const forms = document.querySelectorAll('form');
    const messages = {
        loading: "Your message are sending",
        success: "Success",
        error: "Error"
    };

    forms.forEach(item => {
        postData(item);
    });

    function postData(form) {
        form.addEventListener('submit', (e) => {
            e.preventDefault();

            const request = new XMLHttpRequest();

            request.open('POST', 'formPost.php');

            // Если используется xmlhttprequest + formData, то header прописывать не нужно!!!
            // request.setRequestHeader('Content-type', 'multipart/form-data');

            // Если json, то нужно прописывать
            // request.setRequestHeader('Content-type', 'application/json');


            // For formData
            const formData = new FormData(form);
            request.send(formData);

            //For json

            // const object = {};
            // formData.forEach((value, key) => {
            //     object[key] = value;
            // });

            // const json = JSON.stringify(object);
            // request.send(json);

            request.addEventListener('load', () => {
                const div = document.createElement('div');
                div.classList.add('request');

                div.textContent = messages.loading;
                form.append(div);

                if (request.status === 200) {
                    div.textContent = messages.success;
                    console.log(request.responseText);
                    form.append(div);
                    form.reset();
                } else {
                    div.textContent = messages.error;
                    form.append(div);
                }
            });
        });
    }
};
