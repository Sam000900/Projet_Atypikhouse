<script setup>
  const props = defineProps(['image', 'title']);
</script>

<template>
  <div class="banneralt layout-container">
    <div class="banneralt-image-box">
      <img :src="props.image" alt="image de bannière" class="banneralt-image" />
      <div v-if="props.title" class="banneralt-filter">
        <h1>{{ props.title }}</h1>
      </div>
    </div>
  </div>
</template>

<style scoped>
  .banneralt {
    position: relative;
    display: flex;
    flex-direction: column;
  }

  .banneralt-image-box {
    position: relative;
    display: flex;
    width: 100%;
    height: 100%;
    max-height: 850px;
    aspect-ratio: 13/7;
    border-radius: 60px;
  }

  .banneralt-image {
    width: 100%;
    object-fit: cover;
    border-radius: inherit;
  }

  .banneralt-filter {
    position: absolute;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
    border-radius: 60px;
    background-color: rgba(96, 96, 96, 0.5);
  }

  .banneralt-filter h1 {
    font-family: "Larken-Medium";
    font-size: 120px;
    font-weight: 400;
    line-height: 100%;
    text-align: center;
    color: white;
    text-shadow: 0px 0px 4px rgb(92, 92, 92);
  }

  @media screen and (max-width: 1200px) {
    .banneralt-filter h1 {
      font-size: 80px;
    }
  }

  @media screen and (max-width: 1020px) {
    .banneralt-image {
      border-radius: 30px;
    }

    .banneralt-filter {
      border-radius: 30px;
    }
  }

  @media screen and (max-width: 850px) {
    .banneralt-filter h1 {
      font-size: 64px;
    }
  }

  @media screen and (max-width: 600px) {
    .banneralt-image {
      border-radius: 12px;
    }

    .banneralt-filter {
      border-radius: 12px;
    }

    .banneralt-filter h1 {
      font-size: 42px;
    }
  }
</style>