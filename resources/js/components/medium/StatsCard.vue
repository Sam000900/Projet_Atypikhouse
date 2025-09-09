<script setup>
  import { useWindowSize } from '@vueuse/core';

  const { width } = useWindowSize();
  const props = defineProps(['cardData']);

  const iconColorMap = {
    green: '#1FA151',
    blue: '#3477E5',
    violet: '#9D42DD',
    orange: '#D3591A'
  };

</script>

<template>
  <div class="statscard">
    <div class="statscard-top">
      <h2 class="statscard-title" v-if="width > 600">{{ props.cardData.title }}</h2>
      <div class="statscard-title-info-box-mobile" v-if="width < 600">
        <h2 class="statscard-title">{{ props.cardData.title }}</h2>
        <p class="statscard-info-mobile" v-if="width < 600">{{ props.cardData.text }}</p>
      </div>
      <div class="statscard-icon-box" :class="'statscard-icon-box-' + props.cardData.color">
        <VsxIcon class="statscard-icon" :iconName="props.cardData.icon" size="35" :color="iconColorMap[props.cardData.color]" type="linear" />
      </div>
    </div>
    <div class="statscard-content" v-if="width > 600">
      <p class="statscard-info">{{ props.cardData.text }}</p>
    </div>
  </div>
</template>

<style scoped>
  .statscard {
    display: flex;
    flex-direction: column;
    background-color: white;
    width: 100%;
    height: 250px;
    border-radius: 24px;
    padding: 30px;
    box-shadow: 0 4px 6px #B6B6B6;
  }

  .statscard-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    gap: 10px;
  }

  .statscard-title {
    flex: 1;
    font-family: Calibri, sans-serif;
    font-size: 28px;
    font-weight: bold;
    color: #5D6679;
    line-height: 100%;
  }

  .statscard-icon-box {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 60px;
    height: 60px;
    border-radius: 20px;
  }

  .statscard-icon-box-green { background-color: #DCFCE7; }
  .statscard-icon-box-blue { background-color: #DBEAFE; }
  .statscard-icon-box-violet { background-color: #F3E8FF; }
  .statscard-icon-box-orange { background-color: #FFEDD5; }

  .statscard-content {
    display: flex;
    flex-direction: column;
    justify-content: center;
    height: 100%;
    padding: 0 20px;
  }

  .statscard-info, .statscard-info-mobile {
    font-family: Calibri, sans-serif;
    font-size: 48px;
    font-weight: bold;
    color: #000000;
    line-height: 100%;
  }

  .statscard-info-mobile {
    font-size: 20px;
  }

  .statscard-title-info-box-mobile {
    order: 1;
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 5px;
  }

  @media screen and (max-width: 1200px) {
    .statscard {
      padding: 20px;
    }

    .statscard-title {
      font-size: 22px;
    }

    .statscard-icon-box {
      width: 50px;
      height: 50px;
      border-radius: 50px;
    }

    .statscard-icon {
      width: 30px;
      height: 30px;
    }

    .statscard-content {
      align-items: center;
      padding: 0;
    }
  }

  @media screen and (max-width: 1000px) {
    .statscard {
      flex-direction: row;
      gap: 20px;
      height: 80px;
      border-radius: 80px;
      padding: 15px 40px 15px 15px;
    }

    .statscard-top {
      flex: 1;
      gap: 20px;
    }

    .statscard-title {
      order: 1;
    }

    .statscard-icon-box {
      order: 0;
    }

    .statscard-info {
      font-size: 28px;
    }
  }

  @media screen and (max-width: 600px) {
    .statscard {
      gap: 10px;
    }

    .statscard-title {
      font-size: 18px;
    }

    .statscard-info {
      font-size: 24px;
    }

    .statscard-title {
      order: initial;
    }
  }
</style>