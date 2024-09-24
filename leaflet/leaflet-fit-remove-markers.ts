import "leaflet";

export default function popupMap() {
  const pins = document.querySelectorAll(
    "#js-blue, #js-yellow, #js-green, #js-light-blue"
  );
  const popup_map = document.querySelector(".popup-map");
  const close = document.querySelector(".popup-map__closes");

  let coords = [43.02848434969805, 12.455616622390409];
  const marker_url = "lm-dr-stefano-petrillo";

  let map = L.map("js-map", {
    scrollWheelZoom: false,
  }).setView(coords, 7);

  let markers = [];

  let myIcon = L.icon({
    iconUrl:
      "/wp-content/themes/" + marker_url + "/assets/i/static/map-icon.png",
    iconSize: [38, 38],
    iconAnchor: [19, 38], // first divide iconSize first param by 2, second the same as iconSize last param
    shadowSize: [68, 95],
    shadowAnchor: [22, 94],
  });

  const pins_collection = {
    "js-light-blue": [[45.45284372851204, 8.618952125811969]],
    "js-yellow": [
      [45.52268722640561, 9.09624056630102],
      [45.461479372948986, 9.20497364115188],
      [45.418871609589274, 9.264347125810492],
      [45.596538034447555, 8.915897396983212],
    ],
    "js-green": [
      [45.0307440123614, 9.69524372579405],
      [45.00234481847807, 9.61375492579285],
      [44.865580996351845, 9.643746868117285],
    ],
    "js-blue": [[41.81669713135605, 12.490202425662595]],
  };

  pins.forEach((pin)
 => {
    pin.addEventListener("click", function () {
      const id = pin.getAttribute("id");
      let current_pin_coords = [];
      //   console.log(current_pin_coords, '--- current_pin_coords');
      current_pin_coords = getCoordinates(id)
;

      current_pin_coords.forEach((coords) => {
        let marker = L.marker(coords, { icon: myIcon })
          .bindTooltip("", {
            direction: "right",
            offset: [-10, -30],
            permanent: false,
          })
          .addTo(map);

        markers.push(marker);
      });

      fitMapToMarkers(current_pin_coords);
      setTimeout(() => {
        popup_map?.classList.toggle("active");
      }, 400);
    });
  });

  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    maxZoom: 30,
    attribution:
      '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
  }).addTo(map);

  function getCoordinates(id: string) {
    // console.log(id, "--- id");
    let result = [];
    for (let key of Object.keys(pins_collection)) {
      //   console.log(key, "--- key");
      if (key === id) {
        result = pins_collection[key];
      }
    }
    return result;
  }

  close?.addEventListener("click", function () {
    closePopup();
  });

  document?.addEventListener("click", function (e) {
    const target = e.target;
    if (target === target.closest(".popup-map")) {
      closePopup();
    }
    // console.log(target.closest(".popup-map"), '--- target.closest(".popup-map")');
    // console.log(target, '--- target');
  });

  function closePopup() {
    popup_map?.classList.remove("active");
    removeAllMarkers();
    map.setView(coords, 7);
  }

  // Function to remove all markers from the map
  function removeAllMarkers() {
    markers.forEach((m) => map.removeLayer(m));
    markers = []; // Clear the array
  }

  // Function to fit map bounds to the markers
  function fitMapToMarkers(coords) {
    console.log(coords);
    if (markers.length > 1) {
      // Get all the marker positions
      console.log(markers.length, "--- markers.lenght");

      var latlngs = markers.map((marker) => marker.getLatLng());

      // Create bounds from the markers' positions
      var bounds = L.latLngBounds(latlngs);

      // Fit the map to the bounds with padding
      map.fitBounds(bounds, { padding: [50, 50] });
    } else {
      const t = [coords[0], coords[1]];
      console.log(t[0], "--- t");
      map.setView(t[0], 10);
    }
  }
}
