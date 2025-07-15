<script setup>
  import { ref, onMounted, watchEffect, computed } from 'vue';
  import { usePage } from '@inertiajs/vue3';
  import { useLogementUniqueStore } from '@/stores/logementUniqueStore'

  import { getAccommodationsImages, getAccommodationReservations } from '@/api/accommodationApi.js';
  import { getUniqueExperienceByTypes } from '@/api/experienceApi.js';

  import Header from '@/components/Header.vue';
  import BannerAccommodation from '@/components/BannerAccommodation.vue';
  import InfoAccommodation from '@/components/InfoAccommodation.vue';
  import Faq from '@/components/Faq.vue';
  import Reservation from '@/components/Reservation.vue';
  import MapAccommodation from '@/components/MapAccommodation.vue';
  import ContactFormAccommodation from '@/components/ContactFormAccommodation.vue';
  import ExperiencesCards from '@/components/ExperiencesCards.vue';
  import Footer from '@/components/Footer.vue';

  const { props } = usePage();
  const accommodationData = props.accommodationData;
  const accommodationImages = ref([]);
  const accommodationReservations = ref([]);
  const experiences = ref([]);
  const logementStore = useLogementUniqueStore();

  async function loadDatabaseContent() {
    accommodationImages.value = await getAccommodationsImages(accommodationData.id);
    accommodationReservations.value = await getAccommodationReservations(accommodationData.id);
    experiences.value = await getUniqueExperienceByTypes();
  };

  onMounted(async () => {
    if (accommodationData?.id) {
      loadDatabaseContent();
    }
  });

  watchEffect(() => {
    if (accommodationData?.id) {
      loadDatabaseContent();
      logementStore.setFaqData(accommodationData);
    }
  });

  const bannerAccommodationData = computed(() => ({
    name: accommodationData.name,
    main_image: accommodationData.main_image,
    address: accommodationData.address,
    capacity: accommodationData.capacity,
    bedrooms: accommodationData.bedrooms,
    price_night: accommodationData.price_night
  }));

  const infoAccommodationData = computed(() => ({
    name: accommodationData.name,
    description: accommodationData.description,
    area: accommodationData.area,
    equipments: {
      bathroom: { text: "Salle de bain", value: accommodationData.bathroom },
      equipped_kitchen: { text: "Cuisine équipée", value: accommodationData.equipped_kitchen },
      wifi: { text: "Wifi", value: accommodationData.wifi },
      air_conditioning: { text: "Climatisation", value: accommodationData.air_conditioning },
      household_linen_provided: { text: "Linge de maison fourni", value: accommodationData.household_linen_provided },
      parking: { text: "Parking", value: accommodationData.parking },
      spa: { text: "SPA", value: accommodationData.spa },
    },
    events_allowed: accommodationData.events_allowed,
    pets_allowed: accommodationData.pets_allowed,
    smokers_allowed: accommodationData.smokers_allowed
  }));

  const reservationsData = computed(() => ({
    accommodation_id: accommodationData.id,
    accommodation_price_night: accommodationData.price_night,
    reservations: accommodationReservations,
  }));

  const mapAccommodationData = computed(() => ({
    latitude: parseFloat(accommodationData.latitude),
    longitude: parseFloat(accommodationData.longitude)
  }));
</script>

<template>
  <Header />
  <BannerAccommodation :bannerData="bannerAccommodationData" />
  <InfoAccommodation :infoData="infoAccommodationData" :imagesData="accommodationImages" />
  <Faq />
  <Reservation :reservationsData="reservationsData"/>
  <MapAccommodation :mapData="mapAccommodationData" />
  <ContactFormAccommodation :imageData="accommodationData.main_image" />
  <ExperiencesCards :experiencesdata="experiences" />
  <Footer />
</template>

<style scoped>
</style>