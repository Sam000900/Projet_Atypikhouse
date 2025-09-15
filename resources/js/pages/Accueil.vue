<script setup>
  import { ref, onMounted  } from 'vue';

  import { getLastThreeAccommodations } from '@/api/accommodationApi.js';
  import { getUniqueExperienceByTypes } from '@/api/experienceApi.js';
  import { getLastSixArticles } from '@/api/articleApi.js';

  import Header from '@/components/Header.vue';
  import Banner from '@/components/large/Banner.vue';
  import TrioCards from '@/components/large/TrioCards.vue';
  import ImageTextBloc from '@/components/large/ImageTextBloc.vue';
  import Gallery from '@/components/large/Gallery.vue';
  import ExperiencesCards from '@/components/large/ExperiencesCards.vue';
  import Footer from '@/components/Footer.vue';

  import bannerImage from '@/../../public/images/img-logement-insolite.jpg';

  const accommodations = ref([]);
  const experiences = ref([]);
  const articles = ref([]);
  const isComponentsSwitched = ref(false);

  async function loadDatabaseContent() {
    try {
      const [acc, exp, arts] = await Promise.all([
        getLastThreeAccommodations(),
        getUniqueExperienceByTypes(),
        getLastSixArticles(),
      ]);
      accommodations.value = acc;
      experiences.value = exp;
      articles.value = arts;
    } catch (error) {
      console.error('Failed to load database content:', error);
    }
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
  <Banner :image="bannerImage" title="Accueil" @switch-components="switchComponents" @cancel-search="cancelSearch" />
  <div v-if="!isComponentsSwitched">
    <TrioCards :accommodationsData="accommodations" />
    <ExperiencesCards :experiencesData="experiences" />
    <ImageTextBloc />
    <Gallery :articleData="articles" />
    <Footer />
  </div>
</template>