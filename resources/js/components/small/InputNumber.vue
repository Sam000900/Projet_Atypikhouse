<script setup>
  const modelValue = defineModel(); 
  const props = defineProps(['inputData', 'error']);
</script>

<template>
  <div class="inputnumber">
    <label :for="props.inputData.id" class="inputnumber-label">{{ props.inputData.label }}</label>
    <input
      :id="props.inputData.id"
      :name="props.inputData.id"
      :value="modelValue"
      type="number"
      :step="props.inputData.step"
      class="inputnumber-input"
      :required="props.inputData.isRequired === true"
      autofocus
      :tabindex="props.inputData.tabindex"
      :autocomplete="props.inputData.id"
      :placeholder="props.inputData.placeholder"
      :disabled="props.inputData.isDisabled === true"
      @input="$emit('update:modelValue', $event.target.value)"
    />
    <div v-if="error" class="inputnumber-error">
      <p>{{ error }}</p>
    </div>
  </div>
</template>

<style scoped>
  .inputnumber {
    display: flex;
    flex-direction: column;
  }

  .inputnumber-label {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: bold;
    color: #5D6679;
    margin-bottom: 10px;
  }

  .inputnumber-input {
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

  .inputnumber-error p {
    margin-top: 10px;
    color: crimson;
  }
</style>