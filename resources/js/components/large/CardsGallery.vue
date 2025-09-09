<script setup>
  import HousingCardAlt from '@/components/medium/HousingCardAlt.vue';

  const props = defineProps(['accommodationsData', 'pageData']);
  const emit = defineEmits(['emitGoToPage']);

  function visiblePages() {
    const { current_page, last_page } = props.pageData;
    let pagesToDisplay = [1];

    if (current_page - 1 > 1) { pagesToDisplay.push(current_page - 1); }
    if (current_page > 1 ) { pagesToDisplay.push(current_page); }
    if (current_page + 1 < last_page) { pagesToDisplay.push(current_page + 1); }
    if (current_page < last_page) { pagesToDisplay.push(last_page); }

    return pagesToDisplay;
  };
</script>

<template>
  <div class="cardsgallery layout-container">
    <div class="cardsgallery-grid layout-container">
      <template v-for="accommodation in props.accommodationsData" :key="accommodation.id">
        <div class="cardsgallery-card-box">
          <HousingCardAlt :accommodationInfo="accommodation" />
        </div>
      </template>
    </div>

    <div class="cardsgallery-paging">
      <button
        v-for="page in visiblePages()"
        :key="page"
        @click="$emit('emitGoToPage', page)"
        :class="{ active: page === props.pageData.current_page }"
        class="cardsgallery-paging-button">
          {{ page }}
      </button>
    </div>
  </div>
</template>

<style scoped>
  .layout-container {
    min-width: unset;
  }

  .cardsgallery-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    width: fit-content;
    margin: 0 auto 40px auto;
  }

  .cardsgallery-card-box {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .cardsgallery-paging {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 5px;
  }

  .cardsgallery-paging-button {
    width: 35px;
    height: 35px;
    background-color: #ffffff;
    color: #000000;
    border: solid #DFE3E8 1px;
    border-radius: 4px;
    font-family: Calibri, sans-serif;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
  }

  .cardsgallery-paging-button.active {
    color: #296242;
    border: solid #296242 1px;
  }

  @media screen and (max-width: 1200px) {
    .cardsgallery-grid {
      grid-template-columns: repeat(2, 1fr);
    }

    .cardsgallery-grid > .cardsgallery-card-box:last-of-type {
      grid-column: 1 / -1;
    }
  }

  @media screen and (max-width: 750px) {
    .cardsgallery-grid {
      grid-template-columns: repeat(1, 1fr);
    }
  }

  @media screen and (max-width: 400px) {
    .cardsgallery-grid {
      width: auto;
    }
  }
</style>