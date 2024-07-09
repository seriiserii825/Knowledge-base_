const baseURL = import.meta.env.VITE_BASE_URL
  ? import.meta.env.VITE_BASE_URL
  : "https://backworktime.bludelego.it/api";

const axiosInstance = axios.create({
  baseURL: baseURL,
  // baseURL: "http://backworktime/api",
  headers: {
    Accept: "application/json",
  },
});

axiosInstance.interceptors.request.use(function (config) {
  config.headers["app-token"] = localStorage.getItem("userToken") || null;
  return config;
});

export function addErrorHandler(fn: any) {
  axiosInstance.interceptors.response.use((response) => response, fn);
  axiosInstance.defaults.headers.common["Access-Control-Allow-Origin"] = "*";
}

export { axiosInstance };

const response = await axios({
  method: "post",
  url: "https://api.monitorcrm.it/index.php/topcareatf",
  data: formData,
  headers: { "Content-Type": "multipart/form-data" },
});
