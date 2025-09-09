<script setup>
  const props = defineProps(['bannerData']);
  const emit = defineEmits(['go-to-reservation']);
</script>

<template>
  <div class="bannerexperience layout-container">
    <h1 class="bannerexperience-title">{{ props.bannerData.name }}</h1>
    <div class="bannerexperience-main">
      <div class="bannerexperience-left">
        <div class="bannerexperience-image-box">
          <img class="bannerexperience-image" :src="props.bannerData.image_path" alt="image utilisateur" />
        </div>
      </div>
      <div class="bannerexperience-right">
        <div class="bannerexperience-right-content">

          <div class="bannerexperience-flex-container">
            <div class="bannerexperience-top-box">
              <p class="bannerexperience-text">{{ props.bannerData.address }}</p>
              <VsxIcon iconName="Heart" color="#FF1C7B" size="30" type="bold" />
            </div>

            <div class="bannerexperience-info-box">
              <div class="bannerexperience-number-box">
                <p class="bannerexperience-number">{{ props.bannerData.max_number_persons }}</p>
                <p class="bannerexperience-text">personnes</p>
              </div>
              <div class="bannerexperience-number-box">
                <p class="bannerexperience-number">{{ props.bannerData.service_duration }}</p>
                <p class="bannerexperience-text">durée</p>
              </div>
            </div>

            <div class="bannerexperience-price-box">
              <p class="bannerexperience-text"><span class="bannerexperience-price">{{ props.bannerData.price }} €</span> Prix</p>
            </div>
          </div>

          <div class="bannerexperience-flex-container">
            <div class="bannerexperience-owner-box">
              <div class="bannerexperience-owner-left-box">
                <div class="bannerexperience-owner-image-box">
                  <img class="bannerexperience-image" :src="props.bannerData.user.image_path" alt="image utilisateur" />
                </div>
                <p class="bannerexperience-text-white">{{ props.bannerData.user.firstname }} {{ props.bannerData.user.lastname }}</p>
              </div>
              
              <div class="bannerexperience-owner-right-box">
                <p class="bannerexperience-text-white">Hôte depuis 7 ans</p>
                <div class="bannerexperience-rating-box">
                  <p class="bannerexperience-text-yellow">5</p>
                  <VsxIcon iconName="Star1" color="#DD6318" size="20" type="linear" />
                </div>
                <button class="bannerexperience-contact-button">Contact</button>
              </div>
            </div>

            <button class="bannerexperience-booking-button" @click="$emit('go-to-reservation')">Réserver</button>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
  .bannerexperience {
    position: relative;
    display: flex;
    flex-direction: column;
  }

  .bannerexperience-title {
    font-family: "Larken-Medium";
    font-size: 40px;
    font-weight: 400;
    color: #296242;
    line-height: 100%;
  }

  .bannerexperience-main {
    display: flex;
    gap: 20px;
    margin-top: 40px;
  }

  .bannerexperience-left {
    flex: 1;
    display: flex;
  }

  .bannerexperience-image-box {
    width: 100%;
    height: 100%;
    aspect-ratio: 16/9;
    border-radius: 20px;
    background-color: #747474;
  }

  .bannerexperience-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: inherit
  }

  .bannerexperience-right {
    display: flex;
    align-items: center;
  }

  .bannerexperience-right-content {
    display: flex;
    flex-direction: column;
    width: 30%;
    min-width: 350px;
    border-radius: 20px;
    padding: 30px 20px;
    box-shadow: 0px 4px 8px rgba(0,0,0,0.25);
    background-color: #F3EEE7;
  }

  .bannerexperience-top-box {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .bannerexperience-info-box, .bannerexperience-price-box {
    display: flex;
    justify-content: center;
    gap: 60px;
    margin-top: 20px;
  }

  .bannerexperience-number-box {
    display: flex;
    align-items: center;
    flex-direction: column;
    gap: 5px;
  }

  .bannerexperience-owner-box {
    display: flex;
    justify-content: center;
    gap: 80px;
    padding: 15px;
    margin-top: 20px;
    border-radius: 8px;
    background-color: #49635D;
  }

  .bannerexperience-owner-left-box {
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    text-align: center;
    gap: 10px;
  }

  .bannerexperience-owner-right-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    gap: 10px;
  }

  .bannerexperience-owner-image-box {
    width: 50px;
    height: 50px;
    border-radius: 50px;
    background-color: #747474;
  }

  .bannerexperience-rating-box {
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .bannerexperience-flex-container {
    display: flex;
    flex-direction: column;
  }

  .bannerexperience-contact-button {
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

  .bannerexperience-booking-button {
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

  .bannerexperience-booking-button:hover {
    background-color: #357d54;
  }

  .bannerexperience-number {
    font-family: Calibri, sans-serif;
    font-size: 36px;
    font-weight: 400;
    color: #000000;
    line-height: 100%;
  }

  .bannerexperience-text {
    font-family: Calibri, sans-serif;
    font-size: 16px;
    font-weight: 400;
    color: #000000;
    line-height: 100%;
  }

  .bannerexperience-price {
    font-family: Calibri, sans-serif;
    font-size: 28px;
    font-weight: 400;
    color: #000000;
    line-height: 100%;
  }

  .bannerexperience-text-white {
    font-family: Calibri, sans-serif;
    font-size: 16px;
    font-weight: 400;
    color: #ffffff;
    line-height: 100%;
  }

  .bannerexperience-text-yellow {
    font-family: Calibri, sans-serif;
    font-size: 28px;
    font-weight: 400;
    color: #DD6318;
    line-height: 100%;
  }

  @media screen and (max-width: 1050px) {
    .bannerexperience-main {
      flex-direction: column;
    }

    .bannerexperience-right {
      justify-content: center;
    }

    .bannerexperience-right-content {
      justify-content: center;
      flex-direction: row;
      gap: 30px;
      width: 100%;
      min-width: auto;
    }

    .bannerexperience-top-box {
      justify-content: center;
      gap: 30px;
    }

    .bannerexperience-flex-container:first-child {
      flex: 1;
      justify-content: center;
    }

    .bannerexperience-owner-box {
      margin-top: 0;
    }
  }

  @media screen and (max-width: 700px) {
    .bannerexperience-right-content {
      flex-direction: column;
    }
  }
</style>