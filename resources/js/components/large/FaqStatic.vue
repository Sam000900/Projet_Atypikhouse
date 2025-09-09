<script setup>
  import { usePageFaqStore } from '@/stores/pageFaqStore'
  const pageFaqStore = usePageFaqStore().faqData;
</script>

<template>
  <div class="faqstatic layout-container">
    <div class="faqstatic-left-box">
      <h2 class="faqstatic-title">Questions fréquentes</h2>
      <p class="faqstatic-text">{{ pageFaqStore.title }}</p>
    </div>
    <div class="faqstatic-right-box">
      <div class="faqstatic-grid">
        <div class="faqstatic-tab" v-for="(tab, index) in pageFaqStore.tabs" :key="index" @click="pageFaqStore.tabs[index].isOpen = !tab.isOpen">
          <div class="faqstatic-tab-top">
            <h3 class="faqstatic-tab-title">{{ tab.title }}</h3>
            <VsxIcon style="flex-shrink: 0;" v-if="!tab.isOpen" iconName="ArrowDown2" color="#296242" size="35" type="linear" />
            <VsxIcon style="flex-shrink: 0;" v-else iconName="ArrowUp2" color="#296242" size="35" type="linear" />
          </div>
          <div class="faqstatic-tab-content" :class="{ 'faqstatic-tab-content-open': tab.isOpen }">
            <div class="faqstatic-tab-content-box">
              <template v-for="(text, index) in tab.texts" :key="index">
                <p class="faqstatic-tab-content-text" v-html="text"></p>
              </template>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
  .faqstatic {
    display: flex;
    gap: 60px;
  }

  .faqstatic-title {
    font-family: "Larken-Medium";
    font-size: 40px;
    font-weight: 400;
    color: #296242;
    line-height: 100%;
    margin-bottom: 20px;
  }

  .faqstatic-text {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: 400;
    color: #000000;
  }

  .faqstatic-left-box {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  .faqstatic-right-box {
    display: flex;
    flex-direction: column;
    width: 55%;
  }

  .faqstatic-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2px;
    background-color: #DCDCDC;
  }

  .faqstatic-tab {
    background-color: white;
    padding: 25px 10px;
    cursor: pointer;
  }

  .faqstatic-tab-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
  }

  .faqstatic-tab-title {
    font-family: Calibri, sans-serif;
    font-size: 28px;
    font-weight: bold;
    color: #000000;
    line-height: 110%;
  }

  .faqstatic-tab-content {
    display: grid;
    grid-template-rows: 0fr;
    transition: grid-template-rows 0.25s;
  }

  .faqstatic-tab-content-box {
    margin-top: 0;
    transition: 0.25s;
    overflow: hidden;
  }
  
  .faqstatic-tab-content-open {
    grid-template-rows: 1fr;
  }

  .faqstatic-tab-content-open .faqstatic-tab-content-box {
    margin-top: 10px;
  }

  .faqstatic-tab-content-text {
    font-family: Calibri, sans-serif;
    font-size: 18px;
    font-weight: 400;
    color: #000000;
  }

  @media screen and (max-width: 1200px) {
    .faqstatic {
      flex-direction: column;
    }

    .faqstatic-left-box {
      align-items: center;
      text-align: center;
    }

    .faqstatic-right-box {
      width: 100%;
    }
  }
</style>