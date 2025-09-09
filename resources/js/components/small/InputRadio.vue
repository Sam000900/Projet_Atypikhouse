<script setup>
  const modelValue = defineModel(); 
  const props = defineProps(['inputData', 'error']);
</script>

<template>
  <label :for="props.inputData.name" class="inputradio-label">{{ props.inputData.label }}</label>
  <div class="inputradio-box">
    <div class="inputradio" v-for="(radioField, index) in props.inputData.radioFields" :key="index">
      <label :for="radioField.id" class="inputradio-label2">{{ radioField.value }}</label>
      <input
        :id="radioField.id"
        :name="props.inputData.name"
        :value="radioField.id"
        type="radio"
        class="inputradio-input"
        :required="props.inputData.isRequired === true"
        :tabindex="radioField.tabindex"
        v-model="modelValue"
      />
      <div v-if="error" class="inputradio-error">
        <p>{{ error }}</p>
      </div>
    </div>
  </div>
</template>

<style scoped>
  .inputradio-box {
    display: flex;
    flex-direction: row;
    gap: 50px;
  }

  .inputradio {
    display: flex;
    flex-direction: row;
    gap: 10px;
  }

  .inputradio-label, .inputradio-label2 {
    font-family: Calibri, sans-serif;
    font-size: 18px;
    font-weight: 400;
    color: #7F7E83;
    margin-bottom: 5px;
  }

  .inputradio-label2 {
    color: #000000;
  }

  .inputradio-error p {
    margin-top: 10px;
    color: crimson;
  }
</style>