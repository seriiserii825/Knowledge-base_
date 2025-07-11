import axios from "axios";
export const axiosWp = axios.create({
   headers: {
     "Content-Type": "application/json",
     "Accept": "application/json",
   },
});

