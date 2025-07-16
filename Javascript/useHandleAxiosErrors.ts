import axios from 'axios';
export default function useHandleAxiosErrors(error: unknown, errors: any) {
  if (axios.isAxiosError(error)) {
    const { response } = error;
    if (response) {
      const { status, data } = response;
      if (status === 422) {
        for (const key in errors.value) {
          if (errors.value[key].length > 0) {
            console.log('error', 'Error', errors.value[key][0]);
          }
        }
      } else {
        console.log('error', 'Error', data.message || 'Something went wrong');
      }
    } else {
      console.log('error', 'Error', 'No response from server.');
    }
  } else if (error instanceof Error) {
    console.log('error', 'Error', error.message);
  } else {
    console.log('error', 'Error', 'An unknown error occurred.');
  }
}

