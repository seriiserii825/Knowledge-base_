import axios from 'axios';
export default function useHandleAxiosErrors(error: unknown, errors: any) {
  if (axios.isAxiosError(error)) {
    const { response } = error;
    if (response) {
      const { status, data } = response;
      if (status === 422) {
        for (const key in errors.value) {
          if (errors.value[key].length > 0) {
            console.error('error', 'Error', errors.value[key][0]);
          }
        }
      } else {
        console.error('error', 'Error', data.message || 'Something went wrong');
      }
    } else {
      console.error('error', 'Error', 'No response from server.');
    }
  } else if (error instanceof Error) {
    console.error('error', 'Error', error.message);
  } else {
    console.error('error', 'Error', 'An unknown error occurred.');
  }
}

