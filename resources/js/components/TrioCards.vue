<script setup>
  import { router } from '@inertiajs/vue3';
  import HousingCard from '@/components/HousingCard.vue';

  const props = defineProps(['accommodationsData']);

  function goToAccommodations() {
    router.get('hebergement');
  }
</script>

<template>
  <div class="triocards layout-container">
    <div class="triocards-info-box">
      <h2 class="triocards-info-title">Nos logements insolites</h2>
      <div class="triocards-info-discover" @click="goToAccommodations">
        <p>Découvrir plus</p>
        <VsxIcon iconName="ArrowRight" color="#000000" size="30" type="linear" />
      </div>
    </div>

    <vueper-slides
      class="no-shadow triocards-content"
      :visible-slides="3"
      slide-multiple
      fixed-height="440px"
      :dragging-distance="50"
      :touchable="false"
      :arrows="false"
      bullets-outside
      :breakpoints="{
        1280: { visibleSlides: 2, slideMultiple: false, touchable: true, infinite: true },
        820: { visibleSlides: 1, slideMultiple: false, touchable: true, infinite: false }
      }">
      <vueper-slide class="triocards-vueper-slide" v-for="card in props.accommodationsData" :key="card" :title="card.toString()">
        <template #content>
          <HousingCard :accommodationInfo="card" />
        </template>
      </vueper-slide>
    </vueper-slides>
  </div>
</template>

<style scoped>
  .triocards {
    display: flex;
    flex-direction: column;
    font-family: Calibri, sans-serif;
    font-weight: 400;
  }

  .triocards-info-box {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
  }

  .triocards-info-title {
    font-family: "Larken-Medium";
    font-size: 40px;
    font-weight: 400;
    color: #296242;
  }

  .triocards-info-discover {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 20px;
    cursor: pointer;
  }

  .triocards-content {
    margin: 40px 0 40px 0;
  }

  .triocards-vueper-slide {
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

  @media screen and (min-width: 1280px) {
    .vueperslide--active .housingcard-card {
      box-shadow: 0 6px 12px #B6B6B6;
    }
  }

  @media screen and (max-width: 750px) {
    .triocards-info-box {
        align-items: flex-start;
        flex-direction: column;
    }
  }
</style>