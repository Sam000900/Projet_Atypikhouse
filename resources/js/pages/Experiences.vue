<script setup>
  import { ref, onMounted } from 'vue';
  import { getExperiencesByTypes } from '@/api/experienceApi.js';
  import Header from '@/components/Header.vue';
  import Banner from '@/components/large/Banner.vue';
  import CarouselCardsExperiences from '@/components/large/CarouselCardsExperiences.vue';
  import Footer from '@/components/Footer.vue';
  
  import imgExperiences from '@/../../public/images/img-homme-au-milieu-de-ballons.jpg';

  const experiences = ref([]);
  const isComponentsSwitched = ref(false);

  async function loadDatabaseContent() {
    experiences.value = await getExperiencesByTypes();
  };

  function switchComponents(isSwitched) {
    console.log(isSwitched)
    isComponentsSwitched.value = isSwitched;
  }

  function cancelSearch() {
    isComponentsSwitched.value = false;
  }

  onMounted(() => {
    loadDatabaseContent();
  });
</script>

<template>
  <Header />
  <Banner :image="imgExperiences" title="Expériences" @switch-components="switchComponents" @cancel-search="cancelSearch" />
  <div v-if="!isComponentsSwitched">
    <CarouselCardsExperiences title="Séjours bien-êtres" :experiencesData="experiences.wellness" />
    <CarouselCardsExperiences title="Aventures" :experiencesData="experiences.adventure" />
    <CarouselCardsExperiences title="Gastronomie locale" :experiencesData="experiences.gastronomy" />
  </div>
  <Footer />
</template>

<style scoped>
</style>
