<script setup>
  import { router } from '@inertiajs/vue3'
  
  const props = defineProps(['articleData']);

  function goToArticle(article) {
    router.get('article-unique', { data: article });
  }
</script>

<template>
  <div class="gallery layout-container">
    <h2>Laissez-vous inspirer</h2>
    <div class="gallery-content">
      <div class="gallery-content-column" v-for="column in 3" :key="column">
        <template v-for="(article, index) in props.articleData" :key="article.name">
          <div
            class="gallery-image-box"
            :class="index % 2 === 0 ? 'gallery-image-box-even' : 'gallery-image-box-odd'"
            v-if="index % 3 === (column - 1)"
          >
            <img :src="article.image_path" alt="Image d'article" class="gallery-image"/>
            <div class="gallery-image-box-text">
              <p class="gallery-text">{{ article.name }}</p>
              <div class="gallery-redirect-box">
                <div class="gallery-redirect">
                  <VsxIcon iconName="ArrowRight" color="black" size="25" type="linear" class="gallery-redirect-icon" @click="() => goToArticle(article)" />
                </div>
              </div>
            </div>
          </div>
        </template>
      </div>
    </div>
  </div>
</template>

<style scoped>
  .gallery {
    display: flex;
    align-items: center;
    flex-direction: column;
  }

  .gallery-content {
    display: flex;
    gap: 20px;
    width: 100%;
    margin-top: 40px;
  }

  .gallery-content-column {
    width: 100%;
  }

  .gallery-image-box-odd {
    aspect-ratio: 5/7;
  }

  .gallery-image-box-even {
    aspect-ratio: 1/1;
  }

  .gallery-image-box {
    position: relative;
    display: flex;
    justify-content: center;
    width: 100%;
    margin-bottom: 20px;
    background-color: #747474;
    border-radius: 40px;
    overflow: hidden;
    transition: 0.25s;
  }

  .gallery-image-box:hover {
    transform: scale(1.025);
    box-shadow: 6px 6px 8px #B6B6B6;
  }

  .gallery-image {
    position: absolute;
    object-fit: cover;
    border-radius: inherit;
    width: 100%;
    height: 100%;   
  }

  .gallery-image-box-text {
    position: absolute;
    bottom: 0;
    display: flex;
    align-items: center;
    width: 100%;
    padding: 10px 30px 25px 30px;
  }

  .gallery-text {
    flex: 1;
    font-family: Calibri, sans-serif;
    font-weight: Bold;
    font-size: 24px;
    color: #ffffff;
    line-height: 100%;
    text-shadow: 0 0 4px black;
  }

  .gallery-redirect {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 40px;
    height: 40px;
    margin-left: 10px;
    border-radius: 50px;
    background-color: #ffffff;
    cursor: pointer;
  }

  .gallery-redirect-icon {
    transform: rotate(-45deg);
  }

  @media screen and (max-width: 1200px) {
    .gallery-text {
      font-size: 16px;
    }

    .gallery-redirect {
      width: 30px;
      height: 30px;
    }

    .gallery-redirect-icon {
      height: 20px;
    }

    .gallery-image {
      border-radius: 30px;
    }
  }

  @media screen and (max-width: 1000px) {
    .gallery-image-box {
      margin-bottom: 10px;
      border-radius: 20px;
    }

    .gallery-image {
      border-radius: inherit;
    }

    .gallery-content {
        gap: 10px;
    }
  }

  @media screen and (max-width: 800px) {
    .gallery-image-box-text {
      width: 100%;
    }

    .gallery-content {
      flex-wrap: wrap;
    }

    .gallery-content-column {
      width: calc(50% - 5px);
    }

    .gallery-content-column:last-child {
      display: flex;
      align-items: flex-start;
      width: 100%;
      gap: 10px;
    }

    .gallery-image-box:last-child {
      margin-bottom: 0;
    }
  }

  @media screen and (max-width: 600px) {
    .gallery-image-box {
      border-radius: 12px;
    }

    .gallery-image-box-text {
      padding: 10px 10px 15px 10px;
    }
  }

  @media screen and (max-width: 500px) {
    .gallery-content {
      flex-direction: column;
    }

    .gallery-content-column {
      width: 100%;
    }

    .gallery-image-box-even, .gallery-image-box-odd {
      aspect-ratio: 3/1;
    }

    .gallery-content-column:last-child {
      display: initial;
    }

    .gallery-text {
      font-size: 20px;
    }

    .gallery-image-box-text {
      padding: 10px 30px 20px 30px;
    }
  }

  @media screen and (max-width: 400px) {
    .gallery-image-box-text {
      padding: 10px;
    }

    .gallery-text {
      font-size: 16px;
    }
  }

</style>