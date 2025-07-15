<script setup>
  const props = defineProps(['formData']);
</script>

<template>
  <div class="housingrules">
    <h2 class="housingrules-title">Règles du logement</h2>

    <div class="housingrules-content">
      <div class="housingrules-input-box">
        <label for="arrival_time" class="housingrules-label">Heure d'arrivée</label>
        <input
          id="arrival_time"
          type="time"
          class="housingrules-input-text"
          required
          autofocus
          :tabindex="1"
          v-model="props.formData.arrival_time"
          autocomplete="arrival_time"
        />
      </div>

      <div class="housingrules-input-box">
        <label for="departure_time" class="housingrules-label">Heure de départ</label>
        <input
          id="departure_time"
          type="time"
          class="housingrules-input-text"
          required
          autofocus
          :tabindex="2"
          v-model="props.formData.departure_time"
          autocomplete="departure_time"
        />
      </div>

      <div class="housingrules-input-box">
        <label for="minimum_age" class="housingrules-label">Age minimum du locataire</label>
        <input
          id="minimum_age"
          type="number"
          class="housingrules-input-text"
          required
          autofocus
          :tabindex="3"
          v-model="props.formData.minimum_age"
          autocomplete="minimum_age"
        />
      </div>
    </div>

    <div class="housingrules-checkboxes-container">
      <div class="housingrules-checkbox-box">
        <input
          id="smokers_allowed"
          type="checkbox"
          class="housingrules-input-checkbox"
          :tabindex="4"
          v-model="props.formData.smokers_allowed"
          autocomplete="smokers_allowed"
        />
        <label for="smokers_allowed" class="housingrules-label-checkbox">Fumeurs autorisés</label>
      </div>

      <div class="housingrules-checkbox-box">
        <input
          id="pets_allowed"
          type="checkbox"
          class="housingrules-input-checkbox"
          :tabindex="5"
          v-model="props.formData.pets_allowed"
          autocomplete="pets_allowed"
        />
        <label for="pets_allowed" class="housingrules-label-checkbox">Animaux acceptés</label>
      </div>

      <div class="housingrules-checkbox-box">
        <input
          id="events_allowed"
          type="checkbox"
          class="housingrules-input-checkbox"
          :tabindex="6"
          v-model="props.formData.events_allowed"
          autocomplete="events_allowed"
        />
        <label for="events_allowed" class="housingrules-label-checkbox">Evénements autorisés</label>
      </div>
    </div>

    <div class="housingrules-sub-content">
      <label for="additional_rules" class="housingrules-label">Règles supplémentaires</label>
      <textarea
        id="additional_rules"
        class="housingrules-textarea"
        required
        autofocus
        :tabindex="7"
        v-model="props.formData.additional_rules"
        autocomplete="additional_rules"
        placeholder="Ajoutez des règles supplémentaires..."
      ></textarea>
    </div>
  </div>
</template>

<style scoped>
  .housingrules {
    display: flex;
    flex-direction: column;
  }

  .housingrules-title {
    font-family: Calibri, sans-serif;
    font-size: 32px;
    font-weight: bold;
    color: #000000;
  }

  .housingrules-content {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    row-gap: 20px;
    column-gap: 50px;
    margin-top: 40px;
  }

  .housingrules-input-box {
    display: flex;
    flex-direction: column;
  }

  .housingrules-label {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: bold;
    color: #5D6679;
    margin-bottom: 10px;
  }

  .housingrules-input-text {
    height: 40px;
    border: 0;
    border-radius: 10px;
    padding: 0 10px;
    background-color: #F4F4F4;
    font-family: Calibri, sans-serif;
    font-size: 16px;
    font-weight: 400;
    color: #000000;
    box-shadow: 2px 2px 4px #B6B6B6;
  }
  
  .housingrules-label-checkbox {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: bold;
    color: #5D6679;
  }

  .housingrules-checkboxes-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin: 20px 0;
  }

  .housingrules-checkbox-box {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .housingrules-input-checkbox {
    width: 20px;
    height: 20px;
  }

  .housingrules-sub-content {
    display: flex;
    flex-direction: column;
    margin-top: 20px;
  }

  .housingrules-textarea {
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
    box-shadow: 2px 2px 4px #B6B6B6;
  }
</style>