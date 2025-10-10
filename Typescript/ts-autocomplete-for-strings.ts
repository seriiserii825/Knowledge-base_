type Entry = {
  id: number;
  title: string;
}
type ContentType = "post" | "page" | "asset" | (string & {});
function retrieve(content: ContentType): Entry[] {
  // Mock data for demonstration purposes
  const data: Record<ContentType, Entry[]> = {
    post: [
      { id: 1, title: "First Post" },
      { id: 2, title: "Second Post" },
    ],
    page: [
      { id: 1, title: "About Us" },
      { id: 2, title: "Contact" },
    ],
    asset: [
      { id: 1, title: "Logo" },
      { id: 2, title: "Banner" },
    ],
  };

  return data[content] || [];
}

retrieve("test");
