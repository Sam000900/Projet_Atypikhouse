<script setup>
  const props = defineProps(['bannerData']);
</script>

<template>
  <div class="banneraccommodation layout-container">
    <h1 class="banneraccommodation-title">{{ props.bannerData.name }}</h1>
    <div class="banneraccommodation-main">
      <div class="banneraccommodation-left">
        <div class="banneraccommodation-image-box">
          <img class="banneraccommodation-image" :src="props.bannerData.main_image" alt="image du logement" />
        </div>
      </div>
      <div class="banneraccommodation-right">
        <div class="banneraccommodation-right-content">

          <div class="banneraccommodation-flex-container">
            <div class="banneraccommodation-top-box">
              <p class="banneraccommodation-text">{{ props.bannerData.address }}</p>
              <VsxIcon iconName="Heart" color="#FF1C7B" size="30" type="bold" />
            </div>

            <div class="banneraccommodation-info-box">
              <div class="banneraccommodation-number-box">
                <p class="banneraccommodation-number">{{ props.bannerData.bedrooms }}</p>
                <p class="banneraccommodation-text">Chambres</p>
              </div>
              <div class="banneraccommodation-number-box">
                <p class="banneraccommodation-number">{{ props.bannerData.capacity }}</p>
                <p class="banneraccommodation-text">personnes</p>
              </div>
            </div>

            <div class="banneraccommodation-price-box">
              <p class="banneraccommodation-text"><span class="banneraccommodation-price">{{ props.bannerData.price_night }} €</span> Prix/Nuit</p>
            </div>
          </div>

          <div class="banneraccommodation-flex-container">
            <div class="banneraccommodation-owner-box">
              <div class="banneraccommodation-owner-left-box">
                <div class="banneraccommodation-owner-image-box">
                  <img class="banneraccommodation-image" :src="props.bannerData.user_image_path" alt="image utilisateur" />
                </div>
                <p class="banneraccommodation-text-white">{{ props.bannerData.user_firstname }} {{ props.bannerData.user_lastname }}</p>
              </div>

              <div class="banneraccommodation-owner-right-box">
                <p class="banneraccommodation-text-white">Hôte depuis 7 ans</p>
                <div class="banneraccommodation-rating-box">
                  <p class="banneraccommodation-text-yellow">5</p>
                  <VsxIcon iconName="Star1" color="#DD6318" size="20" type="linear" />
                </div>
                <button class="banneraccommodation-contact-button">Contact</button>
              </div>
            </div>

            <button class="banneraccommodation-booking-button" @click="$emit('go-to-reservation')">Réserver</button>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
  .banneraccommodation {
    position: relative;
    display: flex;
    flex-direction: column;
  }

  .banneraccommodation-title {
    font-family: "Larken-Medium";
    font-size: 40px;
    font-weight: 400;
    color: #296242;
    line-height: 100%;
  }

  .banneraccommodation-main {
    display: flex;
    gap: 20px;
    margin-top: 40px;
  }

  .banneraccommodation-left {
    flex: 1;
    display: flex;
  }

  .banneraccommodation-image-box {
    width: 100%;
    height: 100%;
    aspect-ratio: 16/9;
    border-radius: 20px;
    background-color: #747474;
  }

  .banneraccommodation-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: inherit
  }

  .banneraccommodation-right {
    display: flex;
    align-items: center;
  }

  .banneraccommodation-right-content {
    display: flex;
    flex-direction: column;
    width: 30%;
    min-width: 350px;
    border-radius: 20px;
    padding: 30px 20px;
    box-shadow: 0px 4px 8px rgba(0,0,0,0.25);
    background-color: #F3EEE7;
  }

  .banneraccommodation-top-box {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .banneraccommodation-info-box, .banneraccommodation-price-box {
    display: flex;
    justify-content: center;
    gap: 60px;
    margin-top: 20px;
  }

  .banneraccommodation-number-box {
    display: flex;
    align-items: center;
    flex-direction: column;
    gap: 5px;
  }

  .banneraccommodation-owner-box {
    display: flex;
    justify-content: center;
    gap: 40px;
    padding: 15px;
    margin-top: 20px;
    border-radius: 8px;
    background-color: #49635D;
  }

  .banneraccommodation-owner-left-box {
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    text-align: center;
    gap: 10px;
  }

  .banneraccommodation-owner-right-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    gap: 10px;
  }

  .banneraccommodation-owner-image-box {
    width: 50px;
    height: 50px;
    border-radius: 50px;
    background-color: #747474;
  }

  .banneraccommodation-rating-box {
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .banneraccommodation-flex-container {
    display: flex;
    flex-direction: column;
  }

  .banneraccommodation-contact-button {
    height: 35px;
    padding: 5px 30px;
    border: 0;
    border-radius: 8px;
    background-color: #ffffff;
    color: #000000;
    font-size: 16px;
    font-weight: 400;
    font-family: Calibri, sans-serif;
    cursor: pointer;
    transition: 0.25s;
  }

  .banneraccommodation-booking-button {
    height: 40px;
    padding: 5px 30px;
    border: 0;
    border-radius: 8px;
    margin-top: 20px;
    background-color: #296242;
    color: #ffffff;
    font-size: 20px;
    font-weight: 400;
    font-family: Calibri, sans-serif;
    cursor: pointer;
    transition: 0.25s;
  }

  .banneraccommodation-booking-button:hover {
    background-color: #357d54;
  }

  .banneraccommodation-number {
    font-family: Calibri, sans-serif;
    font-size: 36px;
    font-weight: 400;
    color: #000000;
    line-height: 100%;
  }

  .banneraccommodation-text {
    font-family: Calibri, sans-serif;
    font-size: 16px;
    font-weight: 400;
    color: #000000;
    line-height: 100%;
  }

  .banneraccommodation-price {
    font-family: Calibri, sans-serif;
    font-size: 28px;
    font-weight: 400;
    color: #000000;
    line-height: 100%;
  }

  .banneraccommodation-text-white {
    font-family: Calibri, sans-serif;
    font-size: 16px;
    font-weight: 400;
    color: #ffffff;
    line-height: 100%;
  }

  .banneraccommodation-text-yellow {
    font-family: Calibri, sans-serif;
    font-size: 28px;
    font-weight: 400;
    color: #DD6318;
    line-height: 100%;
  }

  @media screen and (max-width: 1050px) {
    .banneraccommodation-main {
      flex-direction: column;
    }

    .banneraccommodation-right {
      justify-content: center;
    }

    .banneraccommodation-right-content {
      justify-content: center;
      flex-direction: row;
      gap: 30px;
      width: 100%;
      min-width: auto;
    }

    .banneraccommodation-top-box {
      justify-content: center;
      gap: 30px;
    }

    .banneraccommodation-flex-container:first-child {
      flex: 1;
      justify-content: center;
    }

    .banneraccommodation-owner-box {
      margin-top: 0;
    }
  }

  @media screen and (max-width: 700px) {
    .banneraccommodation-right-content {
      flex-direction: column;
    }
  }
</style>