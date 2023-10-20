<script lang="ts" setup>
import {PropType, onMounted, ref} from "vue";
import {useClearPhone} from "../../hooks/useClearPhone";
import IFaxIcon from "../../icons/IFaxIcon.vue";
import ILocation from "../../icons/ILocation.vue";
import IconPhone from "../../icons/IconPhone.vue";
import {IAgentsList} from "../../interfaces/agents/IAgentsList";
import {useTranslate} from "../../hooks/useTranslate";
import {useAddressHook} from "../../hooks/useAddressHook";

//@ts-ignore
const props = defineProps({
  item: Object as PropType<IAgentsList>,
});
const google_map_link = ref();
onMounted(() => {
  google_map_link.value = 'https://www.google.it/maps/place/' + props.item?.indirizzo + '+' + props.item?.comune + '+' + props.item?.provincia + '+' + props.item?.cap;
});
</script>
<template>
  <div class="agent-data" v-if="item">
    <h3 class="agent-data__title">{{ item.nome }} {{ item.cognome }}</h3>
    <ul class="agent-data__list">
      <li v-if="item.nr_clienti">{{ item.nr_clienti }} {{ useTranslate('Contatti', 'Customers') }}</li>
      <li v-if="item.nr_immobili">{{ item.nr_immobili }} {{ useTranslate('Immobili', 'Properties') }}</li>
    </ul>
    <ul class="agent-data__contacts">
      <li v-if="item.telefono">
        <IconPhone />
        <a :href="`tel:${useClearPhone(item.telefono)}`">{{ item.telefono }}</a>
      </li>
      <li v-if="item.fax">
        <IFaxIcon />
        <a :href="`fax:${useClearPhone(item.fax)}`">{{ item.fax }}</a>
      </li>
      <li v-if="item.indirizzo">
        <ILocation />
        <a target="_blank" :href="google_map_link">{{ useAddressHook(item.comune, item.provincia, item.cap, item.indirizzo) }}</a>
      </li>
    </ul>
  </div>
</template>


