<script setup>
  const modelValue = defineModel(); 
  const props = defineProps(['inputData', 'error']);
</script>

<template>
  <div class="select">
    <label :for="props.inputData.id" class="select-label">{{ props.inputData.label }}</label>
    <select
      :id="props.inputData.id"
      :name="props.inputData.id"
      :value="modelValue"
      class="select-input"
      :required="props.inputData.isRequired === true"
      autofocus
      :tabindex="props.inputData.tabindex"
      :autocomplete="props.inputData.id"
      :disabled="props.inputData.isDisabled === true"
      @input="$emit('update:modelValue', $event.target.value)"
    >
      <option v-for="(item, index) in props.inputData.options" :value="item.value" :key="index">
        {{ item.title }}
      </option>
    </select>
    <div v-if="error" class="select-error">
      <p>{{ error }}</p>
    </div>
  </div>
</template>

<style scoped>
  .select {
    display: flex;
    flex-direction: column;
  }

  .select-label {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: bold;
    color: #5D6679;
    margin-bottom: 10px;
  }

  .select-input {
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

  .select-error p {
    margin-top: 10px;
    color: crimson;
  }
</style>