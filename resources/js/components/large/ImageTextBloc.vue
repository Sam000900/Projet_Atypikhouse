<script setup>
  import { router } from '@inertiajs/vue3';
  import imgHommeSouriant from'@/../../public/images/img-homme-souriant-devant-logement.jpg';

  function goToBecomeHost() {
    router.get('devenir-hote');
  }
</script>

<template>
  <div class="imagetextblock layout-container">
    <div class="imagetextblock-box">
      <img :src="imgHommeSouriant" alt="homme souriant à coté de son logement" class="imagetextblock-image" />
      <div class="imagetextblock-text-box">
        <div class="imagetextblock-text-box-flex">
          <h2>Devenir hôte</h2>
          <p class="imagetextblock-text-box-text">Partagez votre espace et générez des revenus en rejoignant notre communauté d'hôtes passionnés.</p>
        </div>
        <input type="button" class="imagetextblock-text-box-button" value="Commencer à louer" @click="goToBecomeHost" />
      </div>
    </div>
  </div>
</template>

<style scoped>
  .imagetextblock {
    margin-bottom: 40px;
  }

  .imagetextblock-box {
    position: relative;
    display: flex;
    flex-direction: column;
  }

  .imagetextblock-image {
    width: 100%;
    border-radius: 60px;
  }

  .imagetextblock-text-box {
    position: absolute;
    -webkit-transform: translate(0, -50%);
    transform: translate(0, -50%);
    top: 50%;
    left: 160px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    padding: 30px 80px;
    border-radius: 40px;
    background-color: rgba(255, 255, 255, 0.8);
  }

  .imagetextblock-text-box-flex {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .imagetextblock-text-box-text {
    max-width: 400px;
    font-family: Calibri, sans-serif;
    font-size: 28px;
    font-weight: 400;
  }

  .imagetextblock-text-box-button {
    height: 60px;
    padding: 0 30px;
    margin-top: 50px;
    border: 0;
    border-radius: 8px;
    background-color: #296242;
    color: #ffffff;
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: 400;
    transition: 0.25s;
    cursor: pointer;
  }

  .imagetextblock-text-box-button:hover {
    background-color: #357d54;
  }

  @media screen and (max-width: 1300px) {
    .imagetextblock-text-box {
      left: 40px;
      padding: 20px 30px;
    }

    .imagetextblock-text-box-text {
      max-width: 300px;
      font-size: 20px;
    }

    .imagetextblock-text-box-button {
      height: 50px;
      padding: 0 20px;
      font-size: 20px;
    }
  }

  @media screen and (max-width: 1020px) {
    .imagetextblock-image, .imagetextblock-text-box {
      border-radius: 30px;
    }
  }

  @media screen and (max-width: 800px) {
    .imagetextblock {
      margin-bottom: 30px;
    }

    .imagetextblock-text-box {
      position: relative;
      flex-direction: row;
      justify-content: space-evenly;
      gap: 30px;
      margin-top: 30px;
      border: solid #296242 2px;
      box-shadow: 0 6px 12px rgba(19, 94, 172, 0.12);
      -webkit-transform: translate(0);
      transform: translate(0);
      left: 0;
    }

    .imagetextblock-text-box-flex {
      align-items: flex-start;
    }

    .imagetextblock-text-box-button {
      margin: 0;
    }
  }

  @media screen and (max-width: 600px) {
    .imagetextblock-text-box {
      flex-direction: column;
      margin-top: 20px;
    }

    .imagetextblock-image, .imagetextblock-text-box {
      border-radius: 12px;
    }
  }

</style>
