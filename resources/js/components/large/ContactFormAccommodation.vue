<script setup>
  const props = defineProps(['imageData']);
</script>

<template>
  <div class="contactformaccommodation">
    <div class="contactformaccommodation-left-box">
      <h2 class="contactformaccommodation-title">Vous avez des questions ?</h2>
      <form class="contactformaccommodation-form">
        <div class="contactformaccommodation-form-grid">
          <div>
            <label class="contactformaccommodation-form-label" for="lastname">Nom</label><br>
            <input class="contactformaccommodation-form-input-text" type="text" id="lastname" name="lastname" placeholder="Nom" required />
          </div>

          <div>
            <label class="contactformaccommodation-form-label" for="firstname">Prénom</label><br>
            <input class="contactformaccommodation-form-input-text" type="text" id="firstname" name="firstname" placeholder="Prénom" required />
          </div>
        </div>

        <label class="contactformaccommodation-form-label" for="email">Email</label>
        <input class="contactformaccommodation-form-input-text" type="email" id="email" name="email" placeholder="Email" required />
        
        <label class="contactformaccommodation-form-label" for="message">Votre demande...</label>
        <textarea class="contactformaccommodation-form-textarea" id="textarea" name="textarea" placeholder="message" required></textarea>
        

        <div class="contactformaccommodation-submit-box">
          <button class="contactformaccommodation-submit">Envoyer</button>
        </div>
      </form>
    </div>
    <div class="contactformaccommodation-right-box">
      <img :src="props.imageData" alt="Homme accueillant devant son logement" class="contactformaccommodation-image" />
    </div>
  </div>
</template>

<style scoped>
  .contactformaccommodation {
    display: flex;
    background-color: #F3EEE7;
    margin-top: 20px;
    margin-bottom: 40px;
    max-height: 600px;
  }

  .contactformaccommodation-left-box {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 30px 60px;
    flex: 1;
  }

  .contactformaccommodation-title {
    font-family: "Larken-Medium";
    font-size: 32px;
    font-weight: 400;
    color: #296242;
    line-height: 100%;
  }

  .contactformaccommodation-form {
    display: flex;
    flex-direction: column;
    width: 100%;
    margin-top: 60px;
  }

  .contactformaccommodation-form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    width: 100%;
  }

  .contactformaccommodation-form-label {
    font-family: Calibri, sans-serif;
    font-size: 18px;
    font-weight: 400;
    color: #000000;
  }

  .contactformaccommodation-form-input-text {
    width: 100%;
    height: 40px;
    margin-top: 5px;
    border: 0;
    border-radius: 10px;
    margin-bottom: 20px;
    padding: 0 10px;
    background-color: #F4F4F4;
    font-family: Calibri, sans-serif;
    font-size: 18px;
    font-weight: 400;
    color: #000000;
  }

  .contactformaccommodation-form-textarea {
    width: 100%;
    resize: vertical;
    height: 150px;
    margin-top: 5px;
    border: 0;
    border-radius: 10px;
    margin-bottom: 20px;
    padding: 10px;
    background-color: #F4F4F4;
    font-family: Calibri, sans-serif;
    font-size: 18px;
    font-weight: 400;
    color: #000000;
  }

  .contactformaccommodation-submit-box {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
  }

  .contactformaccommodation-submit {
    height: 50px;
    padding: 0 30px;
    margin-top: 20px;
    border: 0;
    border-radius: 8px;
    background-color: #296242;
    color: #ffffff;
    font-family: Calibri, sans-serif;
    font-size: 18px;
    font-weight: 400;
    transition: 0.25s;
    cursor: pointer;
  }

  .contactformaccommodation-submit:hover {
    background-color: #357d54;
  }

  .contactformaccommodation-right-box {
    width: 50%;
    display: flex;
    background-color: #747474;
  }

  .contactformaccommodation-image {
    width: 100%;
    object-fit: cover;
  }

  @media screen and (max-width: 1250px) {
    .contactformaccommodation-right-box {
      width: 40%;
    }
  }

  @media screen and (max-width: 1000px) {
    .contactformaccommodation-right-box {
      width: 30%;
    }
  }

  @media screen and (max-width: 800px) {
    .contactformaccommodation {
      max-height: none;
    }

    .contactformaccommodation-right-box {
      display: none;
    }
  }

  @media screen and (max-width: 600px) {
    .contactformaccommodation-title {
      font-size: 28px;
    }

    .contactformaccommodation-form {
      margin-top: 30px;
    }

    .contactformaccommodation-form-grid {
      grid-template-columns: 1fr;
      gap: 0;
    }
  }

  @media screen and (max-width: 500px) {
    .contactformaccommodation-left-box {
      padding: 30px 20px;
    }
  }
</style>