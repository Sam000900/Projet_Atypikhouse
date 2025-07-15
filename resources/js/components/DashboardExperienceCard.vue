<script setup>
  const props = defineProps(['experienceInfo']);
  const emit = defineEmits(['emitModifyExperience', 'emitDeleteExperience']);
</script>

<template>
  <div class="dashboardexperiencecard">
    <div class="dashboardexperiencecard-left">
      <img :src="'/' + props.experienceInfo.image_path" alt="Image de l'expérience" class="dashboardexperiencecard-image"/>
    </div>

    <div class="dashboardexperiencecard-right">
      <div class="dashboardexperiencecard-options-box">
        <div class="dashboardexperiencecard-status">
          <VsxIcon iconName="Eye" color="#296242" size="25" type="linear" />
          <p>Publié</p>
        </div>
        <button class="dashboardexperiencecard-update" @click="emit('emitModifyExperience', props.experienceInfo.id)">Modifier</button>
        <button class="dashboardexperiencecard-delete" @click="emit('emitDeleteExperience', props.experienceInfo.id)">Supprimer</button>
      </div>

      <div class="dashboardexperiencecard-content">
        <h2 class="dashboardexperiencecard-title">{{ props.experienceInfo.name }}</h2>
        <p class="dashboardexperiencecard-text">Adresse: {{ props.experienceInfo.address }}</p>
        <p class="dashboardexperiencecard-text">Type: {{ props.experienceInfo.type }}</p>
        <p class="dashboardexperiencecard-text">Durée: {{ props.experienceInfo.service_duration.slice(0, 5) }}</p>
        <p class="dashboardexperiencecard-text">Nombre de personnes maximum: {{ props.experienceInfo.max_number_persons }}</p>
        <p class="dashboardexperiencecard-price">Prix: {{ props.experienceInfo.price }} €</p>
      </div>
    </div>
  </div>
</template>

<style scoped>
  .dashboardexperiencecard {
    display: flex;
    width: 100%;
    max-width: 1000px;
    aspect-ratio: 12/4;
    border-radius: 24px;
    background-color: #ffffff;
  }

  .dashboardexperiencecard-left {
    height: 100%;
    aspect-ratio: 1/1;
    flex-shrink: 0;
    border-radius: inherit;
    background-color: #747474;
  }

  .dashboardexperiencecard-image {
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

  .dashboardexperiencecard-right {
    display: flex;
    flex-direction: column;
    width: 100%;
    padding: 30px;
    gap: 30px;
  }

  .dashboardexperiencecard-options-box {
    display: flex;
    gap: 20px;
    width: 100%;
  }

  .dashboardexperiencecard-content {
    display: flex;
    flex-direction: column;
    overflow-y: auto;
  }

  .dashboardexperiencecard-title {
    flex: 1;
    font-family: Calibri, sans-serif;
    font-size: 32px;
    font-weight: bold;
    color: #000000;
    line-height: normal;
    word-break: break-word;
  }

  .dashboardexperiencecard-text {
    font-family: Calibri, sans-serif;
    font-size: 18px;
    font-weight: 400;
    color: #5D6679;
    line-height: normal;
  }

  .dashboardexperiencecard-price {
    font-family: Calibri, sans-serif;
    font-size: 28px;
    font-weight: bold;
    color: #000000;
    line-height: normal;
  }

  .dashboardexperiencecard-status {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 50px;
    padding: 0 30px;
    background-color: #DCFCE7;
    border-radius: 10px;
    gap: 10px;
  }

  .dashboardexperiencecard-status p {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: bold;
    color: #296242;
    line-height: 100%;
  }

  .dashboardexperiencecard-update {
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

  .dashboardexperiencecard-update:hover {
    background-color: #5D6679;
    color: #ffffff;
  }

  .dashboardexperiencecard-delete {
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

  .dashboardexperiencecard-delete:hover {
    color: #ffffff;
    background-color: crimson;
  }

  @media screen and (max-width: 1200px) {
    .dashboardexperiencecard {
      aspect-ratio: 12 / 5;
    }

    .dashboardexperiencecard-left {
      aspect-ratio: auto;
      width: 100px;
    }

    .dashboardexperiencecard-options-box {
      flex-wrap: wrap;
      gap: 10px;
    }

    .dashboardexperiencecard-status, .dashboardexperiencecard-update, .dashboardexperiencecard-delete {
      height: 40px;
      padding: 0 15px;
      font-size: 16px;
    }

    .dashboardexperiencecard-status p {
      font-size: 16px;
    }
  }

  @media screen and (max-width: 750px) {
    .dashboardexperiencecard-left {
      display: none;
    }
  }
</style>