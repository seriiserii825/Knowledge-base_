const video_url = "";
const video = "https://www.youtube.com/watch?v=L_LUpnjgPso&ab_channel=Fireplace10hours";
const id_start = video.indexOf('v=');
const str_after_start = video.substring(id_start + 2);
const id_end = str_after_start.indexOf('&');
const id = str_after_start.substring(0, id_end);
video_url = `https://www.youtube.com/embed/${id}`;
