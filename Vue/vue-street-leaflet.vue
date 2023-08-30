yarn add @vue-leaflet/vue-leaflet leaflet

<script lang="ts" setup>
import "leaflet/dist/leaflet.css";
import {LIcon, LMap, LMarker, LTileLayer} from "@vue-leaflet/vue-leaflet";
import {PropType, ref} from "vue";
import {IMapPopup} from "../../interfaces/map/IMapPopup";

const props = defineProps({
  items: {
    type: Array as PropType<IMapPopup[]>,
    required: true,
  },
});

const center = [41.64108812736914, 13.334761026100429];

const zoom = ref(6);
const iconUrl = ref("/wp-content/themes/bs-remax-collection/assets/i/static/map-icon.svg");
const iconSize = ref([25, 41]);
</script>

<template>
  <div class="leaflet-map">
    <div style="height:940px; width:100%">
      <l-map v-model:zoom="zoom" :center="center">
        <l-tile-layer
            url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
            layer-type="base"
            name="OpenStreetMap"
        ></l-tile-layer>
        <l-marker
            v-for="item in items"
            :lat-lng="[item.lat, item.long]">
          <l-icon :icon-url="iconUrl" :icon-size="iconSize"/>
        </l-marker>
      </l-map>
    </div>
  </div>
</template>



