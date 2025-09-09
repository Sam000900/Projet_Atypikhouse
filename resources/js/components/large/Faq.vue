<script setup>
  import { useLogementUniqueStore } from '@/stores/logementUniqueStore'
  const logementUniqueStore = useLogementUniqueStore().faqData;
</script>

<template>
  <div class="faq layout-container">
    <div class="faq-left-box">
      <h2 class="faq-title">Questions fréquentes</h2>
      <p class="faq-text">{{ logementUniqueStore.title }}</p>
    </div>
    <div class="faq-right-box">
      <div class="faq-grid">
        <div class="faq-tab" v-for="(tab, index) in logementUniqueStore.tabs" :key="tab.title" @click="logementUniqueStore.tabs[index].isOpen = !tab.isOpen">
          <div class="faq-tab-top">
            <h3 class="faq-tab-title">{{ tab.title }}</h3>
            <VsxIcon style="flex-shrink: 0;" v-if="!tab.isOpen" iconName="ArrowDown2" color="#296242" size="35" type="linear" />
            <VsxIcon style="flex-shrink: 0;" v-else iconName="ArrowUp2" color="#296242" size="35" type="linear" />
          </div>
          <div class="faq-tab-content" :class="{ 'faq-tab-content-open': tab.isOpen }">
            <div class="faq-tab-content-box">
              <template v-for="text in tab.texts">
                <br v-if="text.length === 0"/>
                <p v-else class="faq-tab-content-text">{{ text }}</p>
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

  .faq-title {
    font-family: "Larken-Medium";
    font-size: 40px;
    font-weight: 400;
    color: #296242;
    line-height: 100%;
    margin-bottom: 20px;
  }

  .faq-text {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: 400;
    color: #000000;
  }

  .faq-left-box {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  .faq-right-box {
    display: flex;
    flex-direction: column;
    width: 55%;
  }

  .faq-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2px;
    background-color: #DCDCDC;
  }

  .faq-tab {
    background-color: white;
    padding: 25px 10px;
    cursor: pointer;
  }

  .faq-tab-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
  }

  .faq-tab-title {
    font-family: Calibri, sans-serif;
    font-size: 28px;
    font-weight: bold;
    color: #000000;
    line-height: 110%;
  }

  .faq-tab-content {
    display: grid;
    grid-template-rows: 0fr;
    transition: grid-template-rows 0.25s;
  }

  .faq-tab-content-box {
    margin-top: 0;
    transition: 0.25s;
    overflow: hidden;
  }
  
  .faq-tab-content-open {
    grid-template-rows: 1fr;
  }

  .faq-tab-content-open .faq-tab-content-box {
    margin-top: 10px;
  }

  .faq-tab-content-text {
    font-family: Calibri, sans-serif;
    font-size: 18px;
    font-weight: 400;
    color: #000000;
  }

  @media screen and (max-width: 1200px) {
    .faq {
      flex-direction: column;
    }

    .faq-left-box {
      align-items: center;
      text-align: center;
    }

    .faq-right-box {
      width: 100%;
    }
  }
</style>