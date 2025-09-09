<script setup>
  const modelValue = defineModel(); 
  const props = defineProps(['inputData', 'error']);
</script>

<template>
  <div class="textarea">
    <label :for="props.inputData.id" class="textarea-label">{{ props.inputData.label }}</label>

    <textarea
      :id="props.inputData.id"
      :name="props.inputData.id"
      :value="modelValue"
      class="textarea-field"
      :required="props.inputData.isRequired === true"
      autofocus
      :tabindex="props.inputData.tabindex"
      :autocomplete="props.inputData.id"
      :placeholder="props.inputData.placeholder"
      :disabled="props.inputData.isDisabled === true"
      @input="$emit('update:modelValue', $event.target.value)"
    ></textarea>
    <div v-if="error" class="textarea-error">
      <p>{{ error }}</p>
    </div>
  </div>
</template>

<style scoped>
  .textarea {
    display: flex;
    flex-direction: column;
  }

  .textarea-label {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: bold;
    color: #5D6679;
    margin-bottom: 10px;
  }

  .textarea-field {
    height: 120px;
    max-width: 100%;
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

  .textarea-error p {
    margin-top: 10px;
    color: crimson;
  }
</style>