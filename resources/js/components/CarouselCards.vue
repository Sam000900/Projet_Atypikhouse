<script setup>
  import { router } from '@inertiajs/vue3';
  import HousingCard from '@/components/HousingCard.vue';

  const props = defineProps(['title', 'accomodationsData']);

  function goToAccommodations() {
    router.get('hebergement');
  }
</script>

<template>
  <div class="carouselcards layout-container-bis">
    <div class="carouselcards-info-box">
      <h2 class="carouselcards-info-title">{{ title }}</h2>
      <div class="carouselcards-info-discover" @click="goToAccommodations">
        <p>Découvrir plus</p>
        <VsxIcon iconName="ArrowRight" color="#000000" size="30" type="linear" />
      </div>
    </div>

    <vueper-slides
      class="no-shadow carouselcards-content"
      :visible-slides="3"
      fixed-height="440px"
      :dragging-distance="50"
      :touchable="true"
      :arrows="false"
      bullets-outside
      :breakpoints="{
        1280: { visibleSlides: 2, slideMultiple: false, touchable: true, infinite: true },
        820: { visibleSlides: 1, slideMultiple: false, touchable: true, infinite: false }
      }"
    >
      <vueper-slide class="carouselcards-vueper-slide" v-for="card in props.accomodationsData" :key="card" :title="card.toString()">
        <template #content>
          <HousingCard :accommodationInfo="card" />
        </template>
      </vueper-slide>
    </vueper-slides>
  </div>
</template>

<style scoped>
  .carouselcards {
    display: flex;
    flex-direction: column;
    font-family: Calibri, sans-serif;
    font-weight: 400;
  }

  .carouselcards-info-box {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
  }

  .carouselcards-info-title {
    font-family: "Larken-Medium";
    font-size: 40px;
    font-weight: 400;
    color: #296242;
  }

  .carouselcards-info-discover {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 20px;
    cursor: pointer;
  }

  .carouselcards-content {
    margin: 40px 0 40px 0;
  }

  .carouselcards-vueper-slide {
    display: flex;
    justify-content: center;
  }

  .vueperslides__bullets {
    margin: 0;
  }

  .vueperslides--fixed-height.vueperslides--bullets-outside {
    margin: 40px 0 40px 0;
  }

  .vueperslides__bullets:not(.vueperslides__bullets--outside) {
    position: relative;
  }

  @media screen and (max-width: 750px) {
    .carouselcards-info-box {
        align-items: flex-start;
        flex-direction: column;
    }
  }
</style>