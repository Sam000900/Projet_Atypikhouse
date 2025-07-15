<script setup>
  const props = defineProps(['title', 'texts', 'image', 'index']);
</script>

<template>
  <div class="duotextimage layout-container" :class="(props.index % 2 === 0) ? 'duotextimage-row' : 'duotextimage-row-reverse'">
    <div class="duotextimage-left-box">
      <div class="duotextimage-texts-box">
        <h2 class="duotextimage-title">{{ props.title }}</h2>
        <p v-for="text in props.texts" class="duotextimage-text">{{ text }}</p>
      </div>
    </div>
    <div class="duotextimage-right-box">
      <div class="duotextimage-image-box">
        <img :src="props.image" alt="" class="duotextimage-image" />
      </div>
    </div>
  </div>
</template>

<style scoped>
  .duotextimage {
    position: relative;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 40px;
  }

  .duotextimage-row {
    flex-direction: row;
  }

    .duotextimage-row-reverse {
    flex-direction: row-reverse;
  }

  .duotextimage-left-box {
    flex: 1;
    display: flex;
    justify-content: center;
  }

  .duotextimage-texts-box {
    display: flex;
    flex-direction: column;
    max-width: 600px;
    gap: 30px;
  }

  .duotextimage-title {
    font-family: "Larken-Medium";
    font-size: 36px;
    font-weight: 400;
    color: #49635D;
    line-height: 100%;
    text-align: center;
  }

  .duotextimage-text {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: 400;
    color: #000000;
    line-height: 100%;
  }

  .duotextimage-right-box {
    display: flex;
    width: 35%;
  }

  .duotextimage-image-box {
    display: flex;
    width: 100%;
    aspect-ratio: 1/1;
    border-radius: 30px;
  }

  .duotextimage-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: inherit;
  }


  @media screen and (max-width: 1000px) {
    .duotextimage {
      flex-direction: column;
    }

    .duotextimage-texts-box {
      max-width: none;
    }

    .duotextimage-right-box {
      justify-content: center;
      width: 100%;
    }

    .duotextimage-image-box {
      max-width: 500px;
    }
  }
</style>