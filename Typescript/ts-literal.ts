function getStatus(status: 'success' | 'error') {
  if (status === 'success') {
    return 'success';
  } else {
    return 'error';
  }
}

const my_status = getStatus('error');
