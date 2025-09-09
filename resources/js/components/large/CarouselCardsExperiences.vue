<script setup>
  import ExperienceCardAlt from '@/components/medium/ExperienceCardAlt.vue';

  const props = defineProps(['title', 'experiencesData'])
</script>

<template>
  <div class="carouselcards layout-container-bis">
    <div class="carouselcards-info-box">
      <h2>{{ title }}</h2>
    </div>

    <vueper-slides
      class="no-shadow carouselcards-content"
      :visible-slides="3"
      :gap="3"
      :slide-ratio="13 / 32"
      :dragging-distance="50"
      :touchable="true"
      :arrows="false"
      bullets-outside
      :breakpoints="{
        1100: { slideRatio: 19 / 32, visibleSlides: 2, slideMultiple: false, touchable: true, infinite: true },
        750: { slideRatio: 24 / 32, visibleSlides: 1, slideMultiple: false, touchable: true, infinite: false },
        600: { slideRatio: 28 / 32, visibleSlides: 1, slideMultiple: false, touchable: true, infinite: false },
        480: { slideRatio: 18 / 16, visibleSlides: 1, slideMultiple: false, touchable: true, infinite: false }
      }"
    >
      <vueper-slide class="carouselcards-vueper-slide" v-for="card in props.experiencesData" :key="card" :title="card.toString()">
        <template #content>
          <ExperienceCardAlt :experiencesData="card" />
        </template>
      </vueper-slide>
    </vueper-slides>
  </div>
</template>

<style scoped>
  .carouselcards {
    display: flex;
    flex-direction: column;
    font-weight: 400;
  }

  .carouselcards-info-box {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
  }

  .carouselcards-content {
    margin: 10px 0 10px 0;
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