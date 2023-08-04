yarn add leaflet
<script setup lang="ts">
import {onMounted} from "vue";
import L from 'leaflet'
import 'leaflet/dist/leaflet.css'

const marker_url = 'bs-remax-collection';
let myIcon = L.icon({
  iconUrl: '/wp-content/themes/' + marker_url + '/assets/i/static/map-icon.png',
  iconSize: [38, 38],
  iconAnchor: [38, 38],
  shadowSize: [68, 95],
  shadowAnchor: [22, 94]
});

function init(){
  const map = L.map('map').setView([41.92374874523605, 12.500281577355913], 6)
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '© OpenStreetMap'
  }).addTo(map)
  
  const marker = L.marker([41.92374874523605, 12.500281577355913], {icon: myIcon}).addTo(map)

  marker.bindPopup("<b>Hello world!</b><br>I am a popup.")
  var popup = L.popup()
      .setLatLng([41.92374874523605, 12.500281577355913])
      .setContent("I am a standalone popup.")
      .openOn(map);
}

onMounted(() => {
  init();
});
</script>

<template>
    <div id="map"></div>
</template>

<style scoped>
    #map  { 
        width: 100%;
        height: 92rem;
    }
</style>
