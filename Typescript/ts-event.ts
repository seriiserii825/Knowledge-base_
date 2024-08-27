function toggleCheckbox(event: Event) {
  const target = event?.target as HTMLInputElement;
  if (props.group) {
    if (target) {
      emits('updateValue', {id: props.id, checked: target['checked']});
    }
  } else {
    if (target) {
      emits('update:checked', target['checked']);
    }
  }
}
