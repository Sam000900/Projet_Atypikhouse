<script setup>
  import { ref, useTemplateRef } from "vue";
  import { searchAccommodations } from "@/api/accommodationApi.js";
  import CardsGallery from '@/components/large/CardsGallery.vue';

  const props = defineProps(['image', 'title']);
  const emit = defineEmits(["switch-components", "cancel-search"]);

  const location = ref("");
  const capacity = ref("");
  const arrivalDate = ref("");
  const departureDate = ref("");

  const accommodations = ref([]);
  const pageInfos = ref({ current_page: 1, last_page: 1 });
  const section = useTemplateRef('search');
  const searchParams = ref({});
  const searchActive = ref(false);

  async function handleSearch() {
    searchParams.value = {
      location: location.value || null,
      capacity: capacity.value || null,
      arrival_date: arrivalDate.value || null,
      departure_date: departureDate.value || null,
      page: 1,
    };

    await performSearch(searchParams.value);
  }

  async function performSearch(params) {
    params.page = params.page || 1;
    const result = await searchAccommodations(params, params.page);
    accommodations.value = result.data;
    pageInfos.value.current_page = result.current_page ?? 1;
    pageInfos.value.last_page = result.last_page ?? 1;
    searchActive.value = true;
    section.value?.scrollIntoView({behavior: "instant", block: "start"});
    window.scrollBy({ top: -200, behavior: "instant" });

    emit("switch-components", true);
  }

  async function goToPage(page) {
    if (page < 1 || page > pageInfos.value.last_page) return;
    searchParams.value.page = page;
    await performSearch(searchParams.value);
  }

  function cancelSearch() {
    searchActive.value = false;
    emit('cancel-search');
  }
</script>

<template>
  <div class="banner layout-container">
    <div class="banner-image-box">
      <img :src="props.image" alt="image de bannière" class="banner-image" />
      <div v-if="props.title" class="banner-filter">
        <h1>{{ props.title }}</h1>
      </div>
    </div>

    <div ref="search" class="banner-search-bar-box">
      <div class="banner-search-bar">
        <div class="banner-search-bar-part">
          <VsxIcon iconName="Location" color="#747474" size="32" type="linear" />
          <div class="banner-search-input-box">
            <p class="banner-search-text">Où allez-vous ?</p>
            <input v-model="location" type="text" placeholder="Annecy" class="banner-search-input" />
          </div>
        </div>
        <div class="banner-separator"></div>
        <div class="banner-search-bar-part">
          <VsxIcon iconName="Calendar" color="#747474" size="32" type="linear" />
          <div class="banner-search-input-box">
            <p class="banner-search-text">Dates d'arrivée et de départ</p>
            <div>
              <input v-model="arrivalDate" type="date" class="banner-search-input" />
              <input v-model="departureDate" type="date" class="banner-search-input" />
            </div>
          </div>
        </div>
        <div class="banner-separator"></div>
        <div class="banner-search-bar-part">
          <VsxIcon iconName="People" color="#747474" size="32" type="linear" />
          <div class="banner-search-input-box">
            <p class="banner-search-text">Combien de personnes ?</p>
            <input v-model="capacity" type="number" min="1" placeholder="2 personnes" class="banner-search-input" />
          </div>
        </div>
        <div class="banner-buttons-box">
          <button v-if="searchActive" class="banner-cancel-button" @click="cancelSearch">╳</button>
          <input type="button" value="Recherche" class="banner-search-button" @click="handleSearch" />
        </div>
      </div>
    </div>

  </div>
  <div v-if="searchActive" class="search-results mt-4">
    <CardsGallery
      :accommodationsData="accommodations"
      :pageData="pageInfos"
      @emitGoToPage="(page) => goToPage(page)"
    />
  </div>
</template>

<style scoped>
  .banner {
    position: relative;
    display: flex;
    flex-direction: column;
  }

  .banner-image-box {
    position: relative;
    display: flex;
    width: 100%;
    height: 100%;
    max-height: 850px;
    aspect-ratio: 13/7;
    border-radius: 60px;
  }

  .banner-image {
    width: 100%;
    object-fit: cover;
    border-radius: inherit;
  }

  .banner-filter {
    position: absolute;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
    border-radius: 60px;
    background-color: rgba(96, 96, 96, 0.5);
  }

  .banner-filter h1 {
    font-family: "Larken-Medium";
    font-size: 120px;
    font-weight: 400;
    line-height: 100%;
    text-align: center;
    color: white;
    text-shadow: 0px 0px 4px rgb(92, 92, 92);
  }

  .banner-search-bar-box {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .banner-search-bar {
    position: absolute;
    bottom: 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
    width: 85%;
    min-height: 70px;
    border-radius: 12px;
    padding: 10px 20px;
    background-color: #ffffff;
    box-shadow: 0 6px 12px rgba(19, 94, 172, 0.12);
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: 400;
  }

  .banner-search-bar-part {
    flex: 1;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .banner-search-input-box, input[type="text"] {
    width: 100%;
  }

  .banner-search-text {
    color: #3E3E3E;
    line-height: 100%;
  }

  .banner-search-input {
    font-family: Calibri, sans-serif;
    font-size: 16px;
    font-weight: 400;
    border: 0;
  }

  .banner-search-input::placeholder {
    color: #B6B6B6;
  }

  .banner-buttons-box {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
  }

  .banner-search-button {
    height: 100%;
    min-height: 45px;
    padding: 0 30px;
    border: 0;
    border-radius: 8px;
    margin: auto;
    background-color: #296242;
    color: #ffffff;
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: 400;
    cursor: pointer;
    transition: 0.25s;
  }

  .banner-search-button:hover {
    background-color: #357d54;
  }

  .banner-separator {
    width: 1px;
    height: 40px;
    background-color: #B6B6B6;
  }

  .banner-cancel-button {
    height: 100%;
    aspect-ratio: 1/1;
    min-height: 45px;
    border: 0;
    border-radius: 8px;
    margin: auto;
    background-color: crimson;
    color: #ffffff;
    font-family: Calibri, sans-serif;
    font-size: 16px;
    font-weight: 400;
    cursor: pointer;
    transition: 0.25s;
  }

  .banner-cancel-button:hover {
    background-color: rgb(218, 53, 83);
  }

  @media screen and (max-width: 1260px) {
    .banner-search-bar {
      position: relative;
      width: 100%;
      margin-top: 20px;
      border: solid #296242 2px;
    }
  }
  
  @media screen and (max-width: 1200px) {
    .banner-filter h1 {
      font-size: 80px;
    }
  }

  @media screen and (max-width: 1020px) {
    .banner-image {
      border-radius: 30px;
    }

    .banner-filter {
      border-radius: 30px;
    }

    .banner-search-bar {
      display: grid;
      width: 100%;
      justify-content: initial;
      grid-template: 
        "a a"
        "b c"
        "d d";
        gap: 10px;
    }

    .banner-search-input-box {
      padding: 5px;
      border: solid #296242 1px;
      border-radius: 12px;
    }

    .banner-search-bar-part {
      width: 100%;
    }

    .banner-search-bar-part:first-child {
      grid-area: a;
    }

    .banner-search-bar-part:nth-child(3) {
      grid-area: b;
    }

    .banner-search-bar-part:nth-child(2) {
      grid-area: c;
    }

    .banner-search-button {
      grid-area: d;
    }

    .banner-separator {
      display: none;
    }

    .banner-buttons-box {
      grid-column: 1 / span 2;
    }
  }

  @media screen and (max-width: 850px) {
    .banner-filter h1 {
      font-size: 64px;
    }
  }

  @media screen and (max-width: 600px) {
    .banner-search-bar {
      display: flex;
      flex-direction: column;
    }
  }

  @media screen and (max-width: 600px) {
    .banner-image {
      border-radius: 12px;
    }

    .banner-filter {
      border-radius: 12px;
    }

    .banner-filter h1 {
      font-size: 42px;
    }
  }

  @media screen and (max-width: 400px) {
    .banner-search-bar {
      padding: 10px;
    }

    .banner-search-input-box[data-v-91d9a111] {
      padding: 3px 5px;
    }
  }
</style>