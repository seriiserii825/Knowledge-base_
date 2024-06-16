export const openstreetmap = () => {
  const mymap = L.map('js-map').setView(
    [41.80461123464314, 12.68389592731651],
    8
  );
  mymap.setZoom(16);

  const marker = L.marker([41.80461123464314, 12.68389592731651]).addTo(mymap);

  L.tileLayer('https://api.maptiler.com/maps/bright/256/{z}/{x}/{y}.png?key=xCc4Z9JASQ9O5wNFusRG', {
    attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
  }).addTo(mymap);

  // L.tileLayer('https://api.maptiler.com/maps/voyager/{z}/{x}/{y}.png?key=xCc4Z9JASQ9O5wNFusRG', {
  //   attribution: '<a href="https://carto.com/" target="_blank">&copy; CARTO</a> <a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
  // }).addTo(mymap);

  // L.tileLayer(
  //   'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}',
  //   {
  //     attribution:
  //       'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
  //     id: 'mapbox/streets-v11',
  //     tileSize: 512,
  //     zoomOffset: -1,
  //     accessToken:
  //       'pk.eyJ1IjoiYmx1ZGVsZWdvIiwiYSI6ImNrdjJkM3EwZzBiZzkydXMzbTZ1d3I3YnEifQ.UcO5wDKFiFDPQ6M8U7-byg',
  //   }
  // ).addTo(mymap);
}
