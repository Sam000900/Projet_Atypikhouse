<script setup>
  const props = defineProps(['accommodationInfo']);
  const emit = defineEmits(['emitModifyAccommodation', 'emitDeleteAccommodation']);
</script>

<template>
  <div class="dashboardhousingcard">
    <div class="dashboardhousingcard-left">
      <img
        :src="'/' + props.accommodationInfo.main_image"
        :alt="props.accommodationInfo.imageAlt"
        class="dashboardhousingcard-image"
      />
    </div>

    <div class="dashboardhousingcard-right">

      <div class="dashboardhousingcard-main-info-box">
        <div class="dashboardhousingcard-main-info">
          <h2 class="dashboardhousingcard-title">{{ props.accommodationInfo.name }}</h2>
          <div class="dashboardhousingcard-location">
            <VsxIcon iconName="Location" color="#5D6679" size="20" type="linear" />
            <p class="dashboardhousingcard-text">
              {{ props.accommodationInfo.address }}
            </p>
          </div>
        </div>
        <div class="dashboardhousingcard-status-box">
          <div class="dashboardhousingcard-status">
            <VsxIcon iconName="Eye" color="#296242" size="25" type="linear" />
            <p>Publié</p>
          </div>
        </div>
      </div>

      <div class="dashboardhousingcard-secondary-info-box">
        <div class="dashboardhousingcard-secondary-info">
          <VsxIcon iconName="House" color="#5D6679" size="25" type="linear" />
          <p class="dashboardhousingcard-text">{{ props.accommodationInfo.type }}</p>
        </div>
        <div class="dashboardhousingcard-secondary-info">
          <VsxIcon iconName="People" color="#5D6679" size="25" type="linear" />
          <p class="dashboardhousingcard-text">{{ props.accommodationInfo.capacity }} personnes</p>
        </div>
        <div class="dashboardhousingcard-secondary-info">
          <VsxIcon iconName="Moon" color="#5D6679" size="25" type="linear" />
          <p class="dashboardhousingcard-text">{{ props.accommodationInfo.bedrooms }} chambres</p>
        </div>
      </div>

      <div class="dashboardhousingcard-last-info">
        <p class="dashboardhousingcard-text">
          <span class="dashboardhousingcard-title">{{ props.accommodationInfo.price_night }} €</span> / nuit
        </p>
        <div class="dashboardhousingcard-buttons-box">
          <button class="dashboardhousingcard-delete" @click="emit('emitDeleteAccommodation', props.accommodationInfo.id)">Supprimer</button>
          <button class="dashboardhousingcard-update" @click="emit('emitModifyAccommodation', props.accommodationInfo.id)">Modifier</button>
        </div>
      </div>

    </div>
  </div>
</template>

<style scoped>
  .dashboardhousingcard {
    display: flex;
    width: 100%;
    max-width: 1000px;
    aspect-ratio: 10/4;
    border-radius: 24px;
    background-color: #ffffff;
  }

  .dashboardhousingcard-left {
    height: 100%;
    aspect-ratio: 1/1;
    border-radius: inherit;
    background-color: #747474;
  }

  .dashboardhousingcard-image {
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

  .dashboardhousingcard-right {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    width: 100%;
    padding: 30px;
    gap: 30px;
  }

  .dashboardhousingcard-main-info-box {
    display: flex;
    justify-content: space-between;
    width: 100%;
  }

  .dashboardhousingcard-main-info {
    display: flex;
    flex-direction: column;
    gap: 5px;
  }

  .dashboardhousingcard-location {
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .dashboardhousingcard-title {
    font-family: Calibri, sans-serif;
    font-size: 32px;
    font-weight: bold;
    color: #000000;
    line-height: 100%;
  }

  .dashboardhousingcard-text {
    font-family: Calibri, sans-serif;
    font-size: 18px;
    font-weight: 400;
    color: #5D6679;
    line-height: 100%;
  }

  .dashboardhousingcard-status-box {
    display: flex;
    flex-direction: column;
  }

  .dashboardhousingcard-status {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 10px 15px;
    background-color: #DCFCE7;
    border-radius: 10px;
    gap: 10px;
  }

  .dashboardhousingcard-status p {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: bold;
    color: #296242;
    line-height: 100%;
  }

  .dashboardhousingcard-secondary-info-box {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
  }

  .dashboardhousingcard-secondary-info {
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .dashboardhousingcard-last-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
  }

  .dashboardhousingcard-buttons-box {
    display: flex;
    gap: 20px;
  }

  .dashboardhousingcard-delete {
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

  .dashboardhousingcard-delete:hover {
    color: #ffffff;
    background-color: crimson;
  }

  .dashboardhousingcard-update {
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

  .dashboardhousingcard-update:hover {
    background-color: #5D6679;
    color: #ffffff;
  }

  @media screen and (max-width: 1250px) {
    .dashboardhousingcard-update, .dashboardhousingcard-delete {
      height: 40px;
      padding: 0 15px;
      font-size: 16px;
    }

  }

  @media screen and (max-width: 1150px) {
    .dashboardhousingcard-left {
      aspect-ratio: 4/6;
    }
  }

  @media screen and (max-width: 1000px) {
    .dashboardhousingcard-left {
      aspect-ratio: 1/1;
    }
  }

  @media screen and (max-width: 850px) {
    .dashboardhousingcard-left {
      aspect-ratio: 4/6;
    }
  }

  @media screen and (max-width: 750px) {
    .dashboardhousingcard {
      flex-direction: column;
      max-width: none;
      aspect-ratio: 14 / 4;
    }

    .dashboardhousingcard-left {
      aspect-ratio: 3/1;
      border-bottom-left-radius: 0;
      border-bottom-right-radius: 0;
    }
  }

  @media screen and (max-width: 650px) {
    .dashboardhousingcard-secondary-info-box {
      flex-direction: column;
      align-items: flex-start;
      gap: 10px;
    }
  }

  @media screen and (max-width: 500px) {
    .dashboardhousingcard-main-info-box {
      flex-direction: column-reverse;
      gap: 10px;
    }

    .dashboardhousingcard-last-info {
      flex-direction: column;
      align-items: flex-start;
      gap: 10px;
    }
  }
</style>