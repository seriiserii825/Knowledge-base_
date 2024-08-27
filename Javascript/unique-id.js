function generateUniqueId() {
  // Get the current timestamp
  const timestamp = new Date().getTime();

  // Generate a random number (you can use a more sophisticated method if needed)
  const random = Math.floor(Math.random() * 1000);

  // Combine the timestamp and random number to create a unique ID
  const uniqueId = `${timestamp}-${random}`;

  return uniqueId;
}
