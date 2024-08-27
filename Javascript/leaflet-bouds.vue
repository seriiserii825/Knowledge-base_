<script setup lang="ts">
  import {ref, onMounted, PropType} from 'vue';
//@ts-ignore
import L from 'leaflet';
//@ts-ignore
import {IMapItem} from "@/interfaces/map/IMapItem";
//@ts-ignore
import {usePermalink} from "@/hooks/usePermalink";
//@ts-ignore
import {useAddTitle} from "@/hooks/useAddTitle";
//@ts-ignore
import {usePriceTrattativa} from "@/hooks/usePriceTrattativa";

const props = defineProps({
  items: {
    type: Array as PropType<IMapItem[]>,
    required: true,
  },
  center: {
    type: Array as PropType<number[]>,
    required: false,
  },
  zoom: {
    type: Number,
    default: 6
  },
  disable_popup: {
    type: Boolean,
    default: false
  },
  agency_popup: {
    type: Boolean,
    default: false
  }
});
const coords = [45.04441604652633, 7.671658699123353];
const marker_url = 'bs-remax-collection';
onMounted(() => {
  let map = L.map('map').setView(coords, 17);

  const multiple_coords = props.items.map((item) => {
    return [parseFloat(item.latitudine), parseFloat(item.longitudine)];
  });
  const bounds = new L.LatLngBounds(multiple_coords);
  map.fitBounds(bounds);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 24,
    attribution:
      '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
  }).addTo(map);

  let myIcon = L.icon({
    iconUrl: '/wp-content/themes/' + marker_url + '/assets/i/pin.svg',
    iconSize: [12, 12],
    iconAnchor: [12, 12],
    shadowSize: [68, 95],
    shadowAnchor: [22, 94]
  });

  props.items.forEach((item: IMapItem) => {
    const coords = [parseFloat(item.latitudine), parseFloat(item.longitudine)];
    const permalink = usePermalink(item.titolo, item.localita, String(item.id));
    const popup_html = `
    <div class="map-popup" style="pointer-events: auto;">
       <a href="${permalink}" class="map-popup__img">
          <img src="${item.foto_thumb}" alt="">
          <div v-if="item.codice" class="map-popup__rif">
             <div class="add-rif">
                <strong>RE/MAX Collection</strong>
                <span>${item.codice}</span>
             </div>
          </div>
       </a>
       <div class="map-popup__content">
          <a class="map-popup__title" href="${permalink}">
            ${useAddTitle(item.titolo, item.tipologia_en, item.localita)}
          </a>
          <div class="map-popup__price">
            ${usePriceTrattativa(String(item.prezzo_richiesto), Number(item.trattativa_riservata))}
          </div>
          <ul class="add-list">
             <li>${item.superficie} mq</li>
             <li>${item.locali} Locali</li>
             ${item.camere != 0 ? `<li>${item.camere} Camere</li>` : ''}
             <li>${item.bagni} Bagni</li>
          </ul>
       </div>
       <div class="map-popup__close">
          <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8" fill="none">
             <g clip-path="url(#clip0_1074_1620)">
                <path d="M6.25 1.75L1.75 6.25" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M6.25 6.25L1.75 1.75" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
             </g>
             <defs>
                <clipPath id="clip0_1074_1620">
                   <rect width="8" height="8" fill="white"></rect>
                </clipPath>
             </defs>
          </svg>
       </div>
    </div>
    `;
    const new_popup = L.popup({
      closeOnClick: true,
      autoClose: true
    }).setContent(popup_html);

    L.marker(coords, {icon: myIcon})
      .bindPopup(new_popup, {maxWidth: 300})
      .addTo(map)
  });

  map.addEventListener('popupopen', () => {
    const map_popup_close =   document.querySelector('.map-popup__close');
    map_popup_close?.addEventListener('click', () => {
      map.closePopup();
    })
  });

})
</script>
<template>
  <div id="map" class="leaflet-map"></div>
</template>
