try {
  const filePath = path.join(process.cwd(), "data", "dummy-json-backend.json");
  const jsonData = await fs.readFile(filePath, "utf-8");
  const data = JSON.parse(jsonData);

  return {
    props: {
      items: data.events,
    },
  };
} catch (error) {
  console.log(error.message, "error.message");
  return {
    props: {
      users: [],
    },
    notFound: true,
  };
}
