<script setup>
  import { ref, onMounted, watchEffect, computed } from 'vue';
  import { usePage } from '@inertiajs/vue3';

  import { useExperienceUniqueStore } from '@/stores/experienceUniqueStore.js';
  import { getExperienceReservations } from '@/api/experienceApi.js';
  import { convertTimehmsTohm } from '@/lib/convertTimehmsTohm.js';

  import Header from '@/components/Header.vue';
  import BannerExperience from '@/components/BannerExperience.vue';
  import Faq from '@/components/Faq.vue';
  import Reservation from '@/components/Reservation.vue';
  import MapAccommodation from '@/components/MapAccommodation.vue';
  import Footer from '@/components/Footer.vue';

  const { props } = usePage();
  const experienceData = props.experienceData;
  const experienceReservations = ref([]);
  const experienceStore = useExperienceUniqueStore();

  async function loadDatabaseContent() {
    experienceReservations.value = await getExperienceReservations(experienceData.id);
  }

  onMounted(async () => {
    if (experienceData?.id) {
      loadDatabaseContent();
    }
  });

  watchEffect(() => {
    if (experienceData?.id) {
      loadDatabaseContent();
      experienceStore.setFaqData(experienceData);
    }
  });

  const bannerExperienceData = computed(() => ({
    name: experienceData.name,
    image_path: experienceData.image_path,
    address: experienceData.address,
    max_number_persons: experienceData.max_number_persons,
    service_duration: convertTimehmsTohm(experienceData.service_duration),
    price: experienceData.price
  }));

  const mapExperienceData = computed(() => ({
    latitude: parseFloat(experienceData.latitude),
    longitude: parseFloat(experienceData.longitude)
  }));
</script>

<template>
  <Header />
  <BannerExperience :bannerData="bannerExperienceData" />
  <Reservation :experienceId="experienceData.id" :reservationsData="experienceReservations"/>
  <Faq />
  <MapAccommodation :mapData="mapExperienceData" />
  <Footer />
</template>

<style scoped>
</style>