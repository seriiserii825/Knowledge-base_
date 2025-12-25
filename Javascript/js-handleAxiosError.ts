import axios from "axios";
import type { Ref } from "vue";
import useSweetAlert from "~/composable/useSweetAlert";

interface ValidationErrors {
  [key: string]: string[];
}

export default function handleAxiosError(
  error: unknown,
  errors: Ref<ValidationErrors> | null = null
) {
  if (axios.isAxiosError(error)) {
    const { response } = error;
    if (response) {
      const { status, data } = response;
      if (status === 422 && errors) {
        errors.value = data.errors;
        for (const key in errors.value) {
          const fieldErrors = errors.value[key];
          if (fieldErrors && fieldErrors.length > 0) {
            useSweetAlert("error", "Error", fieldErrors[0]);
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
