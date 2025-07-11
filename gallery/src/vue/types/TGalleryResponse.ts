export type TGalleryResponse = {
  title: string;
  gallery: TGalleryItem[];
  per_page: string;
}
export type TGalleryItem = {
  id: number;
  url: string;
  alt: string;
}


