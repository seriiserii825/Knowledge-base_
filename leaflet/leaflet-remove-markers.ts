import "leaflet";

export default function streetMap() {
  const coords = [45.42080767307064, 11.285030639883836];
  const marker_url = "bs-casa-helen";
  const addressText = "Sede Operativa: Via Giacomo Brodolini";

  // Create a map instance
  let map = L.map("map", {
    scrollWheelZoom: false,
  }).setView(coords, 17);

  // Create an array to store all markers
  let markers = [];

  // Create custom icon
  let myIcon = L.icon({
    iconUrl:
      "/wp-content/themes/" + marker_url + "/assets/i/static/map-icon.png",
    iconSize: [38, 38],
    iconAnchor: [19, 38],
    shadowSize: [68, 95],
    shadowAnchor: [22, 94],
  });

  // Add marker to the map and store it in the markers array
  let marker = L.marker(coords, { icon: myIcon })
    .bindTooltip(addressText, {
      direction: "right",
      offset: [-10, -30],
      permanent: false,
    })
    .addTo(map);

  markers.push(marker); // Add marker to the array

  // Add tile layer
  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    maxZoom: 24,
    attribution:
      '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
  }).addTo(map);

  // Function to remove all markers from the map
  function removeAllMarkers() {
    markers.forEach((m) => map.removeLayer(m));
    markers = []; // Clear the array
  }

  // Example usage: remove all markers after 5 seconds
  setTimeout(removeAllMarkers, 5000); // This will remove the markers after 5 seconds
}
