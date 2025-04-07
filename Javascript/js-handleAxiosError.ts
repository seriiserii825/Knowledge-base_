import axios, { AxiosError } from "axios";

export default function handleAxiosError(error: unknown, errors: any) {
  if (axios.isAxiosError(error)) {
    const { response } = error;
    if (response) {
      const { status, data } = response;
      if (status === 422) {
        errors.value = data.errors;
        for (const key in errors.value) {
          if (errors.value[key].length > 0) {
            useSweetAlert("error", "Error", errors.value[key][0]);
            break;
          }
        }
      } else {
        useSweetAlert("error", "Error", data.message || "Something went wrong");
      }
    } else {
      useSweetAlert("error", "Error", "No response from server.");
    }
  } else if (error instanceof Error) {
    useSweetAlert("error", "Error", error.message);
  } else {
    useSweetAlert("error", "Error", "An unknown error occurred.");
  }
}


