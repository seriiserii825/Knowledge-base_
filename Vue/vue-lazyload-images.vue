<script lang="ts" setup>
import {IAgentsList} from "../../interfaces/agents/IAgentsList";
import {onMounted, PropType} from "vue";
import AgentInfo from "../agency/AgentInfo.vue";
import {useShowFormPopup} from "../../hooks/useShowFormPopup";
import AgentData from "../agent/AgentData.vue";
import {useTranslate} from "../../hooks/useTranslate";
import {useLangPermalink} from "../../hooks/useLangPermalink";

const props = defineProps({
  item: Object as PropType<IAgentsList>
});

function showPopup() {
  if (props.item) {
    useShowFormPopup(
        props.item.nome,
        props.item.agenzia_denominazione,
        props.item.foto_list[0].nome_th,
        String(props.item.id_agente),
        props.item.cognome,
        props.item.email
    );
  }
}

function lazyLoad() {
  let lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));
  let active = false;
  if (!active) {
    active = true;
    setTimeout(() => {
      lazyImages.forEach(function (lazyImage) {
        //@ts-ignore
        if ((lazyImage.getBoundingClientRect().top <= window.innerHeight && lazyImage.getBoundingClientRect().bottom >= 0) && getComputedStyle(lazyImage).display !== "none") {
          //@ts-ignore
          if(lazyImage.dataset.src){
            //@ts-ignore
            lazyImage.src = lazyImage.dataset.src;
            //@ts-ignore
            lazyImage.classList.remove("lazy");
            //@ts-ignore
            lazyImage.classList.add("loaded");
            lazyImages = lazyImages.filter(function (image) {
              return image !== lazyImage;
            });

            if (lazyImages.length === 0) {
              window.removeEventListener("scroll", lazyLoad);
            }
          }
        }
      });
      active = false;
    }, 200)
  }
}

onMounted(() => {
  window.scrollTo(0, 0);
  window.addEventListener("scroll", lazyLoad);
  window.scrollTo(0, 3);
})
</script>
<template>
  <div v-if="item" class="agents-item">
    <div class="agents-item__wrap">
      <div class="agents-item__img">
        <img :data-src="item.foto_list[0] && item.foto_list[0].nome" alt="" class="lazy"/>
      </div>
      <div class="agents-item__content">
        <div class="agents-item__info">
          <AgentInfo
              :title="item.agenzia_denominazione || ''"
              :code="item.ccia || ''"
              :vat="item.partita_iva || ''"
          />
        </div>
        <AgentData :item="item"/>
        <footer class="agents-item__footer">
          <button @click="showPopup" class="btn">
            {{ useTranslate("Contatta", "Contact") }}
          </button>
          <a
              :href="useLangPermalink(`/agenti?id=${item.id_agente}`)"
              class="btn btn--border"
          >{{
              useTranslate(
                  "Vedi pagina agente",
                  "See agent's details"
              )
            }}</a
          >
        </footer>
      </div>
    </div>
  </div>
</template>
