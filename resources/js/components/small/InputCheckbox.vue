<script setup>
  const modelValue = defineModel(); 
  const props = defineProps(['inputData', 'error']);
</script>

<template>
  <div class="inputcheckbox">
    <div class="inputcheckbox-main">
      <input
        :id="props.inputData.id"
        :name="props.inputData.id"
        :checked="modelValue"
        type="checkbox"
        class="inputcheckbox-input"
        :required="props.inputData.isRequired === true"
        autofocus
        :tabindex="props.inputData.tabindex"
        :disabled="props.inputData.isDisabled === true"
        @change="$emit('update:modelValue', $event.target.checked)"
      />
      <label :for="props.inputData.id" class="inputcheckbox-label">{{ props.inputData.label }}</label>
    </div>
    <div v-if="error" class="inputcheckbox-error">
      <p>{{ error }}</p>
    </div>
  </div>
</template>

<style scoped>
  .inputcheckbox {
    display: flex;
    flex-direction: column;
  }

  .inputcheckbox-main {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .inputcheckbox-input {
    flex-shrink: 0;
    width: 20px;
    height: 20px;
    cursor: pointer;
  }

  .inputcheckbox-label {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: bold;
    color: #5D6679;
    cursor: pointer;
  }

  .inputcheckbox-error p {
    margin-top: 10px;
    color: crimson;
  }
</style>