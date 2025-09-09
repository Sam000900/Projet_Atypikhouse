<script setup>
  import { ref, onMounted } from 'vue';

  import { getAccommodationsByTypes } from '@/api/accommodationApi.js';

  import Header from '@/components/Header.vue';
  import Banner from '@/components/large/Banner.vue';
  import CarouselCards from '@/components/large/CarouselCards.vue';
  import Footer from '@/components/Footer.vue';
  
  import imgLogementInso from '@/../../public/images/img-logement-lumineux-montagne.jpg';

  const accommodations = ref([]);

  async function loadDatabaseContent() {
    try {
      accommodations.value = await getAccommodationsByTypes();
    } catch (error) {
      console.error('Failed to load database content:', error);
    }
  };

  onMounted(() => {
    loadDatabaseContent();
  });

</script>

<template>
  <Header />
  <Banner :image="imgLogementInso" title="Découvrir" />
  <CarouselCards title="Dôme / Bulles" :accomodationsData="accommodations.bubbles" />
  <CarouselCards title="Yourtes" :accomodationsData="accommodations.yurts" />
  <CarouselCards title="Péniches" :accomodationsData="accommodations.barges" />
  <CarouselCards title="Cabanes" :accomodationsData="accommodations.cabins" />
  <CarouselCards title="Wow !" :accomodationsData="accommodations.random" />
  <Footer />
</template>

<style scoped>
</style>
