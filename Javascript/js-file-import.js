function importAll() {
  //@ts-ignore
  const file = file_ref.value.files[0];
  if (file) {
    const FR = new FileReader();
    FR.onload = function (e) {
      const fileContents = e.target.result;
      const inputs = JSON.parse(fileContents);
      console.log(inputs);
      form_store.setProjectTitle(inputs.title)
      form_store.setAllInputs(inputs.inputs);
      setInputs();
    };
    // FR.readAsDataURL(el.files[0]);
    FR.readAsText(file);
  }
}
