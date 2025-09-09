<script setup>
  const props = defineProps(['articleInfo']);
  const emit = defineEmits(['emitModifyArticle', 'emitDeleteArticle']);
</script>

<template>
  <div class="dashboardarticlecard">
    <div class="dashboardarticlecard-left">
      <img :src="'/' + props.articleInfo.image_path" alt="Image de l'article" class="dashboardarticlecard-image"/>
    </div>

    <div class="dashboardarticlecard-right">
      <div class="dashboardarticlecard-options-box">
        <div class="dashboardarticlecard-status">
          <VsxIcon iconName="Eye" color="#296242" size="25" type="linear" />
          <p>Publié</p>
        </div>
        <button class="dashboardarticlecard-update" @click="emit('emitModifyArticle', props.articleInfo.id)">Modifier</button>
        <button class="dashboardarticlecard-delete" @click="emit('emitDeleteArticle', props.articleInfo.id)">Supprimer</button>
      </div>

      <h2 class="dashboardarticlecard-title">{{ props.articleInfo.name }}</h2>
    </div>
  </div>
</template>

<style scoped>
  .dashboardarticlecard {
    display: flex;
    width: 100%;
    max-width: 1000px;
    aspect-ratio: 12/3;
    border-radius: 24px;
    background-color: #ffffff;
  }

  .dashboardarticlecard-left {
    height: 100%;
    aspect-ratio: 1/1;
    flex-shrink: 0;
    border-radius: inherit;
    background-color: #747474;
  }

  .dashboardarticlecard-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: inherit;
    user-drag: none;
    -webkit-user-drag: none;
    user-select: none;
    -moz-user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;
  }

  .dashboardarticlecard-right {
    display: flex;
    flex-direction: column;
    width: 100%;
    padding: 30px;
    gap: 30px;
  }

  .dashboardarticlecard-options-box {
    display: flex;
    gap: 20px;
    width: 100%;
  }

  .dashboardarticlecard-title {
    flex: 1;
    font-family: Calibri, sans-serif;
    font-size: 32px;
    font-weight: bold;
    color: #000000;
    line-height: 100%;
    word-break: break-word;
    overflow-x: auto;
  }

  .dashboardarticlecard-status {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 50px;
    padding: 0 30px;
    background-color: #DCFCE7;
    border-radius: 10px;
    gap: 10px;
  }

  .dashboardarticlecard-status p {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: bold;
    color: #296242;
    line-height: 100%;
  }

  .dashboardarticlecard-update {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 50px;
    max-height: 100%;
    padding: 0 30px;
    border: solid 1px #5D6679;
    border-radius: 10px;
    background-color: transparent;
    color: #5D6679;
    text-decoration: none;
    font-size: 20px;
    font-weight: 400;
    font-family: Calibri, sans-serif;
    transition: 0.25s;
    cursor: pointer;
  }

  .dashboardarticlecard-update:hover {
    background-color: #5D6679;
    color: #ffffff;
  }

  .dashboardarticlecard-delete {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 50px;
    max-height: 100%;
    padding: 0 30px;
    border: solid 1px crimson;
    border-radius: 10px;
    background-color: #ffffff;
    color: crimson;
    text-decoration: none;
    font-size: 20px;
    font-weight: 400;
    font-family: Calibri, sans-serif;
    transition: 0.25s;
    cursor: pointer;
  }

  .dashboardarticlecard-delete:hover {
    color: #ffffff;
    background-color: crimson;
  }

  @media screen and (max-width: 1200px) {
    .dashboardarticlecard-options-box {
      flex-wrap: wrap;
      gap: 10px;
    }

    .dashboardarticlecard-status, .dashboardarticlecard-update, .dashboardarticlecard-delete {
      height: 40px;
      padding: 0 15px;
      font-size: 16px;
    }

    .dashboardarticlecard-status p {
      font-size: 16px;
    }
  }

  @media screen and (max-width: 750px) {
    .dashboardarticlecard-left {
      aspect-ratio: auto;
      width: 100px;
    }

    .dashboardarticlecard-right {
      padding: 15px;
    }
  }
</style>