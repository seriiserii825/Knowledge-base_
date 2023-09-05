<script charset="utf-8">
//package.json

    "@vue-leaflet/vue-leaflet": "^0.6.0",
</script>

<script lang="ts" setup>
import {ref, onMounted} from "vue";
import {OpenStreetMapProvider} from "leaflet-geosearch";

import {
  LMap,
  LTileLayer,
  LMarker,
  LIcon,
  LCircle,
} from "@vue-leaflet/vue-leaflet";
import "leaflet/dist/leaflet.css";

const props = defineProps({
  auction: {
    type: Object,
    required: true,
  },
  strippedAddress: {
    type: String,
    required: true,
  },
  isAuth: {
    type: Boolean,
    required: true,
  },
  dirUrl: {
    type: String,
    required: true,
  },
});

const provider = new OpenStreetMapProvider();
const lat_lng = ref(null);

onMounted(async () => {
  lat_lng.value = await provider.search({
    query: props.auction.address,
  });
});

const iconUrl = `${props.dirUrl}/assets/i/static/pin.png`;
const iconSize = [36, 36];

const options = {
  zoomControl: false,
  attributionControl: false,
};

const handleMouseDown = (e) => {
  e.target.classList.add("active");
};
const handleMouseUp = (e) => {
  e.target.classList.remove("active");
};
</script>

<template>
  <div v-if="lat_lng && lat_lng.length > 0" class="ar-map">
    <div class="container">
      <ar-heading
                  title="Carta geografica"
                  subtitle="MAPPA"
                  align="center"
                  className="ar-map__header" />
      <div class="ar-map__address">
        {{
          isAuth && auction.status !== "Coming Soon"
          ? auction.address
          : strippedAddress
        }}
      </div>
    </div>

    <div
         @mousedown="handleMouseDown"
         @mouseup="handleMouseUp"
         @mouseleave="handleMouseUp"
         class="ar-map__map">
      <!-- <l-map
                v-model:zoom="zoom"
                :options="options"
                :center="[47.41322, -1.219482]"
            >
                <l-marker :lat-lng="[47.41322, -1.219482]">
                    <l-icon :icon-url="iconUrl" :icon-size="iconSize" />
                </l-marker>
                <l-tile-layer
                    url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                    layer-type="base"
                    name="OpenStreetMap"
                ></l-tile-layer>
            </l-map> -->

      <l-map
             :zoom="isAuth && auction.status !== 'Coming Soon' ? 17 : 15"
             :minZoom="3"
             :maxZoom="19"
             :options="options"
             :center="[lat_lng[0].y, lat_lng[0].x]">
        <l-marker
                  v-if="isAuth && auction.status !== 'Coming Soon'"
                  :lat-lng="[lat_lng[0].y, lat_lng[0].x]">
          <l-icon :icon-url="iconUrl" :icon-size="iconSize" />
        </l-marker>

        <l-circle
                  v-else
                  :lat-lng="[lat_lng[0].y, lat_lng[0].x]"
                  :radius="400"
                  :fill="true"
                  color="#c6a070"
                  fillColor="#c6a070"
                  :fillOpacity="0.4">
          <!-- <l-icon :icon-url="iconUrl" :icon-size="iconSize" /> -->
        </l-circle>

        <l-tile-layer
                      url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                      layer-type="base"
                      name="OpenStreetMap"></l-tile-layer>
      </l-map>
    </div>
  </div>
</template>
<style lang="scss">
.ar-map {
  padding: 7.8rem 0 0;

  @media (max-width: 750px) {
    padding: 6rem 0 0;
  }

  &__header {
    margin-bottom: 3.7rem;
  }

  &__address {
    font-family: "Barlow";
    font-style: normal;
    font-weight: 400;
    font-size: 1.8rem;
    line-height: calc(22 / 18);
    color: var(--sec-700);
    text-align: center;
    margin-bottom: 3rem;
  }

  &__map {
    height: 50rem;
    cursor: pointer;

    &.active {
      cursor: grabbing;

      &>div {
        pointer-events: all;
      }
    }

    &>div {
      pointer-events: none;
    }

    @media (max-width: 750px) {
      height: 40rem;
    }

    *,
    *:focus,
    *:hover {
      outline: none;
    }
  }
}
</style>

