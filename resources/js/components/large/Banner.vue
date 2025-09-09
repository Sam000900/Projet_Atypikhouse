<script setup>
  const props = defineProps(['image', 'title']);
</script>

<template>
  <div class="banner layout-container">
    <div class="banner-image-box">
      <img :src="props.image" alt="maison en haut d'un arbre" class="banner-image" />
      <div v-if="props.title" class="banner-filter">
        <h1>{{ props.title }}</h1>
      </div>
    </div>

    <div class="banner-search-bar-box">
      <div class="banner-search-bar">
        <div class="banner-search-bar-part">
          <VsxIcon iconName="Location" color="#747474" size="32" type="linear" />
          <div class="banner-search-input-box">
            <p class="banner-search-text">Où allez-vous ?</p>
            <input type="text" placeholder="Annecy" class="banner-search-input" />
          </div>
        </div>
        <div class="banner-separator"></div>
        <div class="banner-search-bar-part">
          <VsxIcon iconName="Calendar" color="#747474" size="32" type="linear" />
          <div class="banner-search-input-box">
            <p class="banner-search-text">Dates ?</p>
            <input type="text" placeholder="Mardi 14 février" class="banner-search-input" />
          </div>
        </div>
        <div class="banner-separator"></div>
        <div class="banner-search-bar-part">
          <VsxIcon iconName="People" color="#747474" size="32" type="linear" />
          <div class="banner-search-input-box">
            <p class="banner-search-text">Combien de personnes ?</p>
            <input type="text" placeholder="2 personnes" class="banner-search-input" />
          </div>
        </div>
        <input type="button" value="Recherche" class="banner-search-button">
      </div>
    </div>
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