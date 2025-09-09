<script setup>
  const modelValue = defineModel(); 
  const props = defineProps(['inputData', 'error']);
</script>

<template>
  <div class="inputtime">
    <label :for="props.inputData.id" class="inputtime-label">{{ props.inputData.label }}</label>
    <input
      :id="props.inputData.id"
      :name="props.inputData.id"
      :value="modelValue"
      type="time"
      class="inputtime-input"
      :required="props.inputData.isRequired === true"
      autofocus
      :tabindex="props.inputData.tabindex"
      :autocomplete="props.inputData.id"
      :disabled="props.inputData.isDisabled === true"
      @input="$emit('update:modelValue', $event.target.value)"
    />
    <div v-if="error" class="inputtime-error">
      <p>{{ error }}</p>
    </div>
  </div>
</template>

<style scoped>
  .inputtime {
    display: flex;
    flex-direction: column;
  }

  .inputtime-label {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: bold;
    color: #5D6679;
    margin-bottom: 10px;
  }

  .inputtime-input {
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

  .inputtime-error p {
    margin-top: 10px;
    color: crimson;
  }
</style>