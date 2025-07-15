<script setup>
</script>

<template>
  <div class="contactform layout-container">
    <h2 class="contactform-title">Nous contacter</h2>
    <div class="contactform-content">

      <div class="contactform-input-box">
        <label for="surname" class="contactform-label">Nom</label>
        <input
          id="surname"
          type="text"
          class="contactform-input-text"
          required
          autofocus
          :tabindex="1"
          autocomplete="surname"
          placeholder="Nom"
        />
      </div>

      <div class="contactform-input-box">
        <label for="firstname" class="contactform-label">Prénom</label>
        <input
          id="firstname"
          type="text"
          class="contactform-input-text"
          required
          autofocus
          :tabindex="2"
          autocomplete="firstname"
          placeholder="Prénom"
        />
      </div>

      <div class="contactform-input-box">
        <label for="email" class="contactform-label">Email</label>
        <input
          id="email"
          type="email"
          class="contactform-input-text"
          required
          autofocus
          :tabindex="3"
          autocomplete="email"
          placeholder="Email"
        />
      </div>

      <div class="contactform-input-box">
        <label for="phone" class="contactform-label">Téléphone</label>
        <input
          id="phone"
          type="tel"
          class="contactform-input-text"
          required
          autofocus
          :tabindex="4"
          autocomplete="phone"
          placeholder="Téléphone"
        />
      </div>

      <div class="contactform-input-box">
        <label for="message" class="contactform-label">Message</label>
        <textarea
          id="message"
          class="contactform-textarea"
          required
          autofocus
          :tabindex="5"
          autocomplete="message"
          placeholder="Message"
        ></textarea>
      </div>
    </div>

    <p class="contactform-text">En soumettant ce formulaire, j'accepte que mes informations soient utilisées uniquement dans le cadre de ma demande et de la relation commerciale éthique et personnalisé qui peut en découler.</p>

    <div class="contactform-button-box">
        <button class="contactform-button">Envoyer</button>
    </div>

  </div>
</template>

<style scoped>
  .contactform {
    display: flex;
    flex-direction: column;
    padding: 60px 60px 30px 60px;
    border-radius: 30px;
    background-color: #3F5A54;
  }

  .contactform-title {
    font-family: "Larken-Medium";
    font-size: 36px;
    font-weight: 400;
    color: #ffffff;
    line-height: 100%;
    text-align: center;
  }

  .contactform-text {
    font-family: Calibri, sans-serif;
    font-size: 16px;
    font-weight: 400;
    color: #ffffff;
    line-height: 100%;
  }

  .contactform-content {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    row-gap: 30px;
    column-gap: 50px;
    margin: 40px 0;
  }

  .contactform-input-box {
    display: flex;
    flex-direction: column;
  }

  .contactform-input-box:last-child {
    grid-column: span 2;
  }

  .contactform-label {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: bold;
    color: #ffffff;
    margin-bottom: 10px;
  }

  .contactform-input-text {
    height: 40px;
    border: 0;
    border-radius: 10px;
    padding: 0 10px;
    background-color: #F4F4F4;
    font-family: Calibri, sans-serif;
    font-size: 16px;
    font-weight: 400;
    color: #000000;
  }

  .contactform-textarea {
    height: 120px;
    border: 0;
    border-radius: 10px;
    padding: 10px;
    background-color: #F4F4F4;
    font-family: Calibri, sans-serif;
    font-size: 16px;
    font-weight: 400;
    color: #000000;
    line-height: 130%;
  }

  .contactform-button-box {
    display: flex;
    justify-content: center;
    margin-top: 30px;
  }

  .contactform-button {
    height: 40px;
    padding: 0 60px;
    border: 0;
    border-radius: 8px;
    background-color: #ffffff;
    color: #296242;
    font-size: 20px;
    font-weight: 400;
    font-family: Calibri, sans-serif;
    cursor: pointer;
    transition: 0.25s;
  }

  .contactform-button:hover {
    background-color: #F4F4F4;
  }

  @media screen and (max-width: 1000px) {
    .contactform-content {
      display: flex;
      flex-direction: column;
      row-gap: 15px;
    }
  }

  @media screen and (max-width: 800px) {
    .contactform {
      padding: 30px 20px;
    }
  }
</style>