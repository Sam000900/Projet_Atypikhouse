<script setup>
  import { usePageFaqStore } from '@/stores/pageFaqStore.js'
  const pageFaqStore = usePageFaqStore().faqData;
</script>

<template>
  <div class="faqfull layout-container">
    <div class="faqfull-left-box">
      <h2 class="faqfull-title">Questions fréquentes</h2>
      <p class="faqfull-text">{{ pageFaqStore.title }}</p>
    </div>
    <div class="faqfull-right-box">
      <div class="faqfull-grid">
        <div class="faqfull-tab" v-for="(tab, index) in pageFaqStore.tabs" :key="tab.title" @click="pageFaqStore.tabs[index].isOpen = !tab.isOpen">
          <div class="faqfull-tab-top">
            <h3 class="faqfull-tab-title">{{ tab.title }}</h3>
            <VsxIcon style="flex-shrink: 0;" v-if="!tab.isOpen" iconName="ArrowDown2" color="#296242" size="35" type="linear" />
            <VsxIcon style="flex-shrink: 0;" v-else iconName="ArrowUp2" color="#296242" size="35" type="linear" />
          </div>
          <div class="faqfull-tab-content" :class="{ 'faqfull-tab-content-open': tab.isOpen }">
            <div class="faqfull-tab-content-box">
              <template v-for="text in tab.texts">
                <br v-if="text.length === 0"/>
                <p v-else class="faqfull-tab-content-text" v-html="text"></p>
              </template>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
  .faq {
    display: flex;
    gap: 60px;
  }

  .faqfull-title {
    font-family: "Larken-Medium";
    font-size: 40px;
    font-weight: 400;
    color: #296242;
    line-height: 100%;
    margin-bottom: 20px;
  }

  .faqfull-text {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: 400;
    color: #000000;
  }

  .faqfull-left-box {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin-bottom: 30px;
  }

  .faqfull-right-box {
    display: flex;
    flex-direction: column;
  }

  .faqfull-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2px;
    background-color: #DCDCDC;
  }

  .faqfull-tab {
    background-color: white;
    padding: 25px 10px;
    cursor: pointer;
  }

  .faqfull-tab-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
  }

  .faqfull-tab-title {
    font-family: Calibri, sans-serif;
    font-size: 28px;
    font-weight: bold;
    color: #000000;
    line-height: 110%;
  }

  .faqfull-tab-content {
    display: grid;
    grid-template-rows: 0fr;
    transition: grid-template-rows 0.25s;
  }

  .faqfull-tab-content-box {
    margin-top: 0;
    transition: 0.25s;
    overflow: hidden;
  }
  
  .faqfull-tab-content-open {
    grid-template-rows: 1fr;
  }

  .faqfull-tab-content-open .faqfull-tab-content-box {
    margin-top: 10px;
  }

  .faqfull-tab-content-text {
    font-family: Calibri, sans-serif;
    font-size: 18px;
    font-weight: 400;
    color: #000000;
  }

  @media screen and (max-width: 1200px) {
    .faqfull-left-box {
      margin-bottom: 10px;
    }
  }
</style>