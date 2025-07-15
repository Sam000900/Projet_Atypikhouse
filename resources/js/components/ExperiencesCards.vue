<script setup>
  import { router } from '@inertiajs/vue3';
  import ExperienceCard from '@/components/ExperienceCard.vue';

  const props = defineProps(['experiencesdata']);

  function goToExperiences() {
    router.get('experiences');
  }
</script>

<template>
  <div class="experiencescards">
    <div class="experiencescards-container layout-container">

      <div class="experiencescards-top">
        <h2 class="experiencescards-title">Expériences uniques</h2>
        <div class="experiencescards-explore" @click="goToExperiences"> 
          <p class="experiencescards-explore-text">Explorer toutes les expériences</p>
          <VsxIcon iconName="ArrowRight" color="#ffffff" size="25" type="linear" />
        </div>
      </div>

      <div class="experiencescards-bottom">
        <div class="experiencescards-bottom-left">
          <ExperienceCard :cardData="experiencesdata.wellness" :cardConfig=0 :cardNumber="0" />
        </div>

        <div class="experiencescards-bottom-right">
          <ExperienceCard :cardData="experiencesdata.adventure" :cardConfig=1 :cardNumber="1" />
          <ExperienceCard :cardData="experiencesdata.gastronomy" :cardConfig=1 :cardNumber="2" />
        </div>
      </div>

    </div>
  </div>
</template>

<style scoped>
  .experiencescards {
    width: 100%;
    background-color: #3F5A54;
  }

  .experiencescards-container {
    display: flex;
    flex-direction: column;
    padding: 40px 0;
  }

  .experiencescards-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
  }

  .experiencescards-title {
    font-family: "Larken-Medium";
    font-size: 40px;
    font-weight: 400;
    color: #ffffff;
    line-height: 100%;
  }

  .experiencescards-explore {
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
  }

  .experiencescards-explore-text {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: 400;
    color: #ffffff;
  }

  .experiencescards-bottom {
    display: flex;
    justify-content: space-between;
    gap: 40px;
    margin-top: 30px;
  }

  .experiencescards-bottom-left {
    display: flex;
    width: 55%;
  }

  .experiencescards-bottom-right {
    display: flex;
    flex-direction: column;
    flex:1;
    gap: 40px;
  }

  @media screen and (max-width: 1200px) {
    .experiencescards-bottom {
      flex-direction: column;
    }

    .experiencescards-bottom-left {
      display: flex;
      width: 100%;
    }

    .experiencescards-bottom-right {
      flex-direction: row;
    }
  }

  @media screen and (max-width: 950px) {
    .experiencescards-bottom-right {
      flex-direction: column;
    }
  }

  @media screen and (max-width: 750px) {
    .experiencescards-top {
      align-items: flex-start;
      flex-direction: column;
    }
  }
</style>