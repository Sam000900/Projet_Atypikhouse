<script setup>
  import { ref, onMounted, watchEffect, computed } from 'vue';
  import { usePage } from '@inertiajs/vue3';

  import { useExperienceUniqueStore } from '@/stores/experienceUniqueStore.js';
  import { getExperienceReservations } from '@/api/experienceApi.js';
  import { convertTimehmsTohm } from '@/lib/convertTimehmsTohm.js';

  import Header from '@/components/Header.vue';
  import BannerExperience from '@/components/large/BannerExperience.vue';
  import Faq from '@/components/large/Faq.vue';
  import Reservation from '@/components/large/Reservation.vue';
  import MapAccommodation from '@/components/large/MapAccommodation.vue';
  import Footer from '@/components/Footer.vue';

  const { props } = usePage();
  const experienceData = props.experienceData;
  const experienceReservations = ref([]);
  const experienceStore = useExperienceUniqueStore();
  const reservationSection = ref(null);

  async function loadDatabaseContent() {
    experienceReservations.value = await getExperienceReservations(experienceData.id);
  }

  function goToReservation() {
    if (reservationSection.value?.$el) {
      const element = reservationSection.value.$el;
      const top = element.getBoundingClientRect().top + window.scrollY + (-100);
      window.scrollTo({ top: top, behavior: 'smooth' });
    }
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
    price: experienceData.price,
    user: experienceData.user
  }));

  const mapExperienceData = computed(() => ({
    latitude: parseFloat(experienceData.latitude),
    longitude: parseFloat(experienceData.longitude)
  }));
</script>

<template>
  <Header />
  <BannerExperience :bannerData="bannerExperienceData" @go-to-reservation="goToReservation" />
  <Reservation ref="reservationSection" :experienceId="experienceData.id" :reservationsData="experienceReservations"/>
  <Faq />
  <MapAccommodation :mapData="mapExperienceData" />
  <Footer />
</template>

<style scoped>
</style>