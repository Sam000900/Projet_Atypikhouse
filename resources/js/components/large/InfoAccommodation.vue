<script setup>
  import { ref, watch } from 'vue';
  const props = defineProps(['infoData', 'imagesData']);
  const imagesData = ref([]);

  watch(
    () => props.imagesData,
    (newValue) => { imagesData.value = newValue;},
    { immediate: true }
  );
</script>

<template>
  <div class="infoaccommodation layout-container">
    <h2 class="infoaccommodation-title">Informations sur le logement</h2>
    <div>
      <vueper-slides
        v-if="imagesData.length"
        class="no-shadow"
        :visible-slides="3"
        :dragging-distance="50"
        :touchable="true"
        :arrows="false"
        bullets-outside
        :gap="3"
        :slide-ratio="9 / 42"
        :breakpoints="{
          1450: { visibleSlides: 2, slideRatio: 9 / 28 },
          820: { visibleSlides: 1, slideRatio: 9/14 }
        }"
      >
        <vueper-slide v-for="image in imagesData" :key="image.id">
          <template #content>
            <div class="infoaccommodation-image-box">
              <img class="infoaccommodation-image" :src="image.image_path" alt="Image de l'hébergement" />
            </div>
          </template>
        </vueper-slide>
      </vueper-slides>

      <div class="infoaccommodation-content">
        <div class="infoaccommodation-left">
          <h3 class="infoaccommodation-content-title">{{ props.infoData.name }}</h3>
          <p class="infoaccommodation-content-text">{{ props.infoData.description }}</p>
        </div>
        <div class="infoaccommodation-right">
          <div class="infoaccommodation-area">
            Superficie : {{ props.infoData.area }} m²
          </div>
          <div
            class="infoaccommodation-equipment"
            :class="equipment.value === 'true' ? 'infoaccommodation-equipment-true' : 'infoaccommodation-equipment-false'"
            v-for="equipment in props.infoData.equipments"
            :key="equipment"
          >
              <VsxIcon v-if="equipment.value === 'true'" class="infoaccommodation-icon" iconName="TickCircle" :size="28" color="#296242" type="linear" />
              <VsxIcon v-else class="infoaccommodation-icon" iconName="CloseCircle" :size="28" color="#ed143d" type="linear" />
            <p>{{ equipment.text }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
  .infoaccommodation {
    position: relative;
    display: flex;
    flex-direction: column;
  }

  .infoaccommodation-title {
    font-family: "Larken-Medium";
    font-size: 40px;
    font-weight: 400;
    color: #296242;
    line-height: 100%;
    margin-bottom: 40px;
  }

  .infoaccommodation-image-box {
    width: 100%;
    height: 100%;
    border-radius: 20px;
    background-color: #747474;
  }

  .infoaccommodation-image {
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

  .infoaccommodation-content {
    display: flex;
    margin-top: 40px;
    gap: 40px;
  }

  .infoaccommodation-left {
    display: flex;
    flex-direction: column;
    width: 60%;
  }

  .infoaccommodation-right {
    flex: 1;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    gap: 10px;
    max-width: 550px;
  }

  .infoaccommodation-area {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 40px;
    padding: 10px 30px 10px 7px;
    border-radius: 100px;
    font-family: Calibri, sans-serif;
    font-size: 18px;
    font-weight: 400;
    line-height: 100%;
    background-color: #296242;
    color: #ffffff;
  }

  .infoaccommodation-equipment {
    display: flex;
    align-items: center;
    gap: 5px;
    height: 40px;
    padding: 10px 30px 10px 7px;
    border-width: 1px;
    border-style: solid;
    border-radius: 100px;
    font-family: Calibri, sans-serif;
    font-size: 16px;
    font-weight: 400;
    line-height: 100%;
    background-color: #D6D6D6;
    color: #000000;
  }

  .infoaccommodation-icon {
    flex-shrink: 0;
  }

  .infoaccommodation-equipment-true {
    border-color: #296242;
  }

  .infoaccommodation-equipment-false {
    border-color: #ed143d;
  }

  .infoaccommodation-equipment-shape {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 32px;
    width: 32px;
    border-radius: 32px;
    background-color: #ffffff;
  }

  .infoaccommodation-content-title {
    font-family: "Larken-Medium";
    font-size: 32px;
    font-weight: 400;
    color: #296242;
    line-height: 100%;
    margin-bottom: 20px;
  }

  .infoaccommodation-content-text {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: 400;
    color: #000000;
    line-height: 100%;
  }

  @media screen and (max-width: 1050px) {
    .infoaccommodation-content {
      flex-direction: column-reverse;
    }

    .infoaccommodation-left, .infoaccommodation-right {
      width: 100%;
      max-width: none;
    }
  }
</style>