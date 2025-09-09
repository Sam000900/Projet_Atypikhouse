<script setup>
  import { ref } from 'vue';

  const modelValue = defineModel(); 
  const props = defineProps(['inputData', 'error']);
  const customClass = ref("inputtext");

  if (props.inputData.style === 1) { customClass.value = "inputtext2"}
</script>

<template>
  <div :class="customClass">
    <label :for="props.inputData.id" :class="customClass + '-label'">{{ props.inputData.label }}</label>
    <input
      :id="props.inputData.id"
      :name="props.inputData.id"
      :value="modelValue"
      :type="props.inputData.type"
      :class="customClass + '-input'"
      :required="props.inputData.isRequired === true"
      autofocus
      :tabindex="props.inputData.tabindex"
      :autocomplete="props.inputData.id"
      :placeholder="props.inputData.placeholder"
      :disabled="props.inputData.isDisabled === true"
      @input="$emit('update:modelValue', $event.target.value)"
    />
    <div v-if="error" :class="customClass + '-error'">
      <p>{{ error }}</p>
    </div>
  </div>
</template>

<style scoped>
  /* Default Style */
  .inputtext {
    display: flex;
    flex-direction: column;
  }

  .inputtext-label {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: bold;
    color: #5D6679;
    margin-bottom: 10px;
  }

  .inputtext-input {
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

  .inputtext-error p, .inputtext2-error p {
    margin-top: 10px;
    color: crimson;
  }

  /* Style 1 */
  .inputtext2 {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    width: 50%;
  }

  .inputtext2-label {
    font-family: Calibri, sans-serif;
    font-size: 18px;
    font-weight: 400;
    color: #7F7E83;
    margin-bottom: 5px;
  }

  .inputtext2-input {
    height: 40px;
    width: 100%;
    border: 0;
    border-radius: 10px;
    padding: 0 10px;
    background-color: #F4F4F4;
    font-family: Calibri, sans-serif;
    font-size: 18px;
    font-weight: 400;
    color: #000000;
  }

  @media screen and (max-width: 600px) {
    .inputtext2 {
      width: 100%;
    }
  }
</style>