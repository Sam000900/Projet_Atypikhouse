<script setup>
  import { router } from '@inertiajs/vue3';

  const props = defineProps(['cardData', 'cardConfig', 'cardNumber']);

  function goToExperience() {
    router.get('experience-unique', { data: props.cardData });
  }
</script>

<template>
  <div class="experiencecard-card" :class="cardConfig === 0 ? 'experiencecard-card-config-0' : 'experiencecard-card-config-1'">
    <div class="experiencecard-card-image-box">
      <img v-if="cardData" :src="props.cardData.image_path" alt="image de l'expérience" class="experiencecard-card-image" />
    </div>
    <div class="experiencecard-card-content">
      <div class="experiencecard-card-tag">
        <p class="experiencecard-card-tag-text">Tag</p>
      </div>
      <h3 v-if="cardData" class="experiencecard-card-title">{{ props.cardData.type }}</h3>
      <div class="experiencecard-card-more" @click="goToExperience" >
        <p class="experiencecard-card-more-text">Explorer</p>
        <VsxIcon iconName="ArrowRight" color="#000000" size="25" type="linear" />
      </div>
    </div>
  </div>
</template>

<style scoped>

  .experiencecard-card-config-0 {
    aspect-ratio: 700/480;
  }

  .experiencecard-card-config-1 {
    height: calc(100% / 2);
  }

  .experiencecard-card {
    display: flex;
    width: 100%;
    border-radius: 40px;
    background-color: #ffffff;
  }

  .experiencecard-card-image-box {
    position: relative;
    height: 100%;
    aspect-ratio: 1/1;
    border-radius: inherit;
    background-color: #747474;
  }

  .experiencecard-card-image {
    position: absolute;
    height: 100%;
    aspect-ratio: 1/1;
    border-radius: inherit;
    object-fit: cover;
  }

  .experiencecard-card-content {
    flex: 1;
    display: flex;
    justify-content: space-between;
    flex-direction: column;
    padding: 20px 30px;
    overflow-wrap: break-word;
  }

  .experiencecard-card-title {
    font-family: "Larken-Medium";
    font-size: 36px;
    font-weight: 400;
    color: #000000;
  }

  .experiencecard-card-tag {
    /*display: flex;*/
    display: none;
    justify-content: center;
    align-items: center;
    width: fit-content;
    padding: 5px 20px;
    border-radius: 10px;
    background-color: #3F5A54;
  }

  .experiencecard-card-tag-text {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: 400;
    color: #ffffff;
  }

  .experiencecard-card-more {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 10px;
    cursor: pointer;
  }

  .experiencecard-card-more-text {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: 400;
    color: #000000;
  }

  @media screen and (max-width: 1200px) {
    .experiencecard-card-config-0 {
      height: 250px;
    }

    .experiencecard-card-config-1 {
      min-height: 180px;
      height: auto;
    }

    .experiencecard-card-content {
      gap: 15px;
      padding: 10px 15px;
    }

    .experiencecard-card-title {
      font-size: 24px;
    }
  }

  @media screen and (max-width: 1020px) {
    .experiencecard-card-config-0, .experiencecard-card-config-1 {
      border-radius: 30px;
    }
  }

  @media screen and (max-width: 950px) {
    .experiencecard-card-config-0, .experiencecard-card-config-1 {
      min-height: unset;
      height: 200px;
    }
  }

  @media screen and (max-width: 600px) {
    .experiencecard-card-config-0, .experiencecard-card-config-1 {
      border-radius: 12px;
    }
  }

  @media screen and (max-width: 550px) {
    .experiencecard-card-config-0, .experiencecard-card-config-1 {
      min-height: unset;
      height: 160px;
    }

    .experiencecard-card-more {
      justify-content: flex-start;
    }
  }

  @media screen and (max-width: 400px) {
    .experiencecard-card-image-box, .experiencecard-card-image {
      aspect-ratio: 1 / 2;
    }
  }
</style>