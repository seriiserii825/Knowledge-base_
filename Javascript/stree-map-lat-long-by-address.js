async function getLatLon(address) {
  const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(
    address
  )}`;

  try {
    const response = await fetch(url, {
      headers: {
        "User-Agent": "YourAppName",
      },
    });
    const data = await response.json();

    if (data.length > 0) {
      console.log(`Latitude: ${data[0].lat}, Longitude: ${data[0].lon}`);
      return {
        lat: data[0].lat,
        lon: data[0].lon,
      };
    } else {
      console.error("Address not found");
      return null;
    }
  } catch (error) {
    console.error("Error fetching data:", error);
  }
}
