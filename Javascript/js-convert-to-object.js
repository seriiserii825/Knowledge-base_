export function convertToObject(data) {
  return data.map((doc) => {
    const item = doc.toObject();
    item._id = item._id.toString();
    return item;
  });
}
