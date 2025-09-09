<script setup>
  import { router } from '@inertiajs/vue3'

  const props = defineProps(['experiencesData']);

  function goToExperience() {
    router.get('experience-unique', { data: props.experiencesData });
  }
</script>

<template>
  <div class="housingcard-card" v-if="experiencesData">
    <div class="housingcard-card-image-box">
      <img :src="props.experiencesData.image_path" alt="image de l'expérience" class="housingcard-card-image"/>
    </div>
    <div class="housingcard-card-text-box">
      <div class="housingcard-card-text-box-left">
        <div class="housingcard-card-rating">
          <VsxIcon
            v-for="star in 5"
            iconName="Star1"
            size="16"
            type="linear"
          />
        </div>
        <div class="housingcard-card-location">
          <p class="housingcard-card-location-title">{{ props.experiencesData.name }}</p>
          <p class="housingcard-card-location-text">{{ props.experiencesData.location }}</p>
          <p class="housingcard-card-location-price-text">
            <span class="housingcard-card-location-price">{{ props.experiencesData.price }} €</span>
          </p>
        </div>
      </div>
      <div class="housingcard-card-text-box-right">
        <VsxIcon class="housingcard-card-nav" iconName="ArrowRight" color="#000000" size="25" type="linear" @click="goToExperience" />
      </div>
    </div>
  </div>
</template>

<style scoped>
  .housingcard-card {
    display: flex;
    flex-direction: column;
    height: 100%;
    border-radius: 40px;
    box-shadow: 0 6px 12px #B6B6B6;
    transition: 0.5s;
  }

  .vueperslide--active .housingcard-card {
    box-shadow: 0 6px 16px #3F5A54;
  }

  .housingcard-card-image-box {
    position: relative;
    height: 65%;
    background-color: #747474;
    border-top-left-radius: inherit;
    border-top-right-radius: inherit;
  }

  .housingcard-card-image {
    position: absolute;
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-top-left-radius: inherit;
    border-top-right-radius: inherit;
    overflow: hidden;
    user-drag: none;
    -webkit-user-drag: none;
    user-select: none;
    -moz-user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;
  }

  .housingcard-card-text-box {
    height: 35%;
    position: relative;
    display: flex;
    flex: 1;
    padding: 15px 20px;
    border-bottom-left-radius: inherit;
    border-bottom-right-radius: inherit;
    background-color: #ffffff;
  }

  .housingcard-card-text-box-left {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .housingcard-card-text-box-right {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
  }

  .housingcard-card-nav {
    cursor: pointer;
  }

  .housingcard-card-rating {
    display: flex;
    align-items: center;
    gap: 2px;
  }

  .housingcard-card-location {
    display: flex;
    flex-direction: column;
  }

  .housingcard-card-location-title {
    font-family: "Larken-Medium";
    font-size: 28px;
    font-weight: 400;
    color: #000000;
    line-height: 80%;
  }

  .housingcard-card-location-price-text {
    margin-top: 3%;
  }

  .housingcard-card-location-price {
    font-size: 24px;
    font-weight: bold;
  }

  @media screen and (max-width: 1020px) {
    .housingcard-card {
      border-radius: 30px;
    }
  }

  @media screen and (max-width: 800px) {
    .housingcard-card-location-title {
      font-size: 24px;
    }
  }

  @media screen and (max-width: 600px) {
    .housingcard-card {
      border-radius: 12px;
    }
  }

  @media screen and (max-width: 400px) {
    .housingcard-card-image-box {
      height: 60%;
    }

    .housingcard-card-text-box {
      height: 40%;
    }
  }

  @media screen and (max-width: 350px) {
    .housingcard-card-image-box {
      height: 50%;
    }

    .housingcard-card-text-box {
      height: 50%;
    }
  }
</style>