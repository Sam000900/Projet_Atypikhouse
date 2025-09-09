<script setup>
  const modelValue = defineModel(); 
  const props = defineProps(['inputData', 'error']);

function handleFileChange(event) {
  const file = event.target.files[0];
  if (file) {
    modelValue.value = file;
  }
}
</script>

<template>
  <div class="inputfile">
    <label :for="props.inputData.id" class="inputfile-label">{{ props.inputData.label }}</label>
    <input
      :id="props.inputData.id"
      type="file"
      class="inputfile-input"
      :class="props.inputData.isDisabled === true && 'inputfile-input-disabled'"
      accept="image/*"
      :required="props.inputData.isRequired === true"
      :tabindex="props.inputData.tabindex"
      :autocomplete="props.inputData.id"
      :disabled="props.inputData.isDisabled === true"
      @change="handleFileChange"
    />
    <div v-if="error" class="inputtext-error">
      <p>{{ error }}</p>
    </div>
  </div>
</template>

<style scoped>
  .inputfile {
    display: flex;
    flex-direction: column;
  }

  .inputfile-label {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: bold;
    color: #5D6679;
    margin-bottom: 10px;
  }

  .inputfile-input {
    border: 0;
    border-radius: 10px;
    padding: 8px;
    background-color: #F4F4F4;
    font-family: Calibri, sans-serif;
    font-size: 16px;
    font-weight: 400;
    color: #000000;
    box-shadow: 2px 2px 4px #B6B6B6;
  }

  .inputfile-input::file-selector-button {
    height: 40px;
    padding: 0 20px;
    border: 0;
    border-radius: 8px;
    background-color: #296242;
    color: #ffffff;
    font-size: 16px;
    font-weight: 400;
    font-family: Calibri, sans-serif;
    cursor: pointer;
    transition: 0.25s;
  }

  .inputfile-input-disabled::file-selector-button {
    background-color: #B6B6B6;
    color: rgb(118, 118, 118);
  }

  .inputtext-error p {
    margin-top: 10px;
    color: crimson;
  }
</style>