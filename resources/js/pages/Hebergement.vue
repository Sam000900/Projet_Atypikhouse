<script setup>
  import { ref, onMounted } from 'vue';

  import { getLastNineAccommodations } from '@/api/accommodationApi.js';

  import Header from '@/components/Header.vue';
  import Banner from '@/components/Banner.vue';
  import Map from '@/components/Map.vue';
  import CardsGallery from '@/components/CardsGallery.vue';
  import Footer from '@/components/Footer.vue';
  import imgLogement from '@/../../public/images/img-interieur-maison-vue-foret.jpg';

  const accommodations = ref([]);
  const pageInfos = ref({ current_page: 1, last_page: 1 });

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
    }
  }

  onMounted(() => {
    loadAccommodations(pageInfos.value.current_page);
  });
</script>

<template>
  <Header />
  <Banner :image="imgLogement" />
  <Map />
  <CardsGallery :accommodationsData="accommodations" :pageData="pageInfos" @emitGoToPage="(page) => goToPage(page)" />
  <Footer />
</template>

<style scoped>
</style>
