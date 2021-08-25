<ReactMarkdown
  components={{
    img: () => (
      <Image src={`${imagePath}`} alt={title} width={200} height={150} />
    ),
  }}
>
  {content}
</ReactMarkdown>;
