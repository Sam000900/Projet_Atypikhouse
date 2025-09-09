<script setup>
  import Header from '@/components/Header.vue'
  import Title from '@/components/small/Title.vue'
  import TitleText from '@/components/small/TitleText.vue'
  import Footer from '@/components/Footer.vue'

  import ConditionsGeneralesUtilisationTexts from "@/../json/texts/ConditionsGeneralesUtilisationTexts"
</script>

<template>
  <Header />
  <Title :text="ConditionsGeneralesUtilisationTexts.title" />
  <template v-for="paragraph in ConditionsGeneralesUtilisationTexts.paragraphs">
    <TitleText
      :title="paragraph.title"
      :texts="paragraph.texts"
    />
  </template>
  <Footer />
</template>

<style scoped>
</style>