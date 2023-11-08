<script lang="ts" setup>
// @ts-ignore
import {LMap, LTileLayer, LMarker, LIcon, LPopup} from "@vue-leaflet/vue-leaflet";
import "leaflet/dist/leaflet.css";
import {IMapItem} from "../../interfaces/map/IMapItem";
import MapPopup from "../popups/MapPopup.vue";

import {PropType, ref} from "vue";
import LoadingComponent from "../LoadingComponent.vue";

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
  }
});
// console.log(props.items, 'props.items')
const scroll_behaviour = ref(true);
const center_coords = ref(props.center ? props.center : [41.64108812736914, 13.334761026100429]);

const iconUrl = ref("/wp-content/themes/bs-remax-collection/assets/i/static/map-pin2.svg");
const iconUrlActive = ref("/wp-content/themes/bs-remax-collection/assets/i/static/map-pin.svg");
const iconSize = ref([40, 40]);

const map_ref = ref(null);
const active_marker = ref(-10);

const closeMapPopup = () => {
  // @ts-ignore
  map_ref.value.leafletObject.closePopup();
}
const changeMarkerIcon = ( id: string | number) => {
  // @ts-ignore
  active_marker.value = id;
}
</script>

<template>
  <div
      @click="scroll_behaviour = !scroll_behaviour"
      class="leaflet-map active"
      >
    <l-map
        :zoom="zoom"
        :minZoom="5"
        :maxZoom="20"
        zoomSnap="0.5"
        zoomDelta="1"
        ref="map_ref"
        :center="center_coords">
      <l-tile-layer
          url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
          layer-type="base"
          name="OpenStreetMap"></l-tile-layer>
      <l-marker
          v-for="item in items"
          :lat-lng="[item.latitudine, item.longitudine]"
          @popupopen="changeMarkerIcon( item.id)"
          @popupclose="changeMarkerIcon(-10)"
          >
        <l-icon
            :key="item.id"
            :icon-url="item.id === active_marker ? iconUrlActive : iconUrl"
            :icon-size="iconSize"/>
        <l-popup>
          <MapPopup @emit_close="closeMapPopup" :item="item"/>
        </l-popup>
      </l-marker>
    </l-map>
  </div>
</template>


