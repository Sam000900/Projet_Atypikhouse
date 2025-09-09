<script setup>
  import { ref, onMounted, useTemplateRef } from 'vue';

  import { getLastNineAccommodations } from '@/api/accommodationApi.js';

  import Header from '@/components/Header.vue';
  import Banner from '@/components/large/Banner.vue';
  import Map from '@/components/large/Map.vue';
  import CardsGallery from '@/components/large/CardsGallery.vue';
  import Footer from '@/components/Footer.vue';
  
  import imgLogement from '@/../../public/images/img-interieur-maison-vue-foret.jpg';

  const accommodations = ref([]);
  const pageInfos = ref({ current_page: 1, last_page: 1 });
  const section = useTemplateRef('cardsgallery');

  async function loadAccommodations(page) {
    const getResult = await getLastNineAccommodations(page);
    accommodations.value = getResult.data;
    pageInfos.value.current_page = getResult.current_page;
    pageInfos.value.last_page = getResult.last_page;
  };

  function goToPage(page) {
    if (page >= 1 && page <= pageInfos.value.last_page) {
      pageInfos.value.current_page = page;
      loadAccommodations(pageInfos.value.current_page);
      section.value?.scrollIntoView({behavior: "instant", block: "start"});
      window.scrollBy({ top: -120, behavior: "instant" });
    }
  }

  onMounted(() => {
    loadAccommodations(pageInfos.value.current_page);
  });
</script>

<template>
  <Header />
  <Banner :image="imgLogement" title="Hébergement" />
  <Map />
  <div ref="cardsgallery">
    <CardsGallery :accommodationsData="accommodations" :pageData="pageInfos" @emitGoToPage="(page) => goToPage(page)" />
  </div>
  <Footer />
</template>

<style scoped>
</style>
