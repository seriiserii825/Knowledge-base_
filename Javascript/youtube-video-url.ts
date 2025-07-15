export default function convertYoutubeUrlToIframeUrl(youtube_url: string): string {
  try {
    const url = new URL(youtube_url);
    const videoId = url.searchParams.get('v');
    if (!videoId) return '';
    return `https://www.youtube.com/embed/${videoId}`;
  } catch {
    return '';
  }
}
