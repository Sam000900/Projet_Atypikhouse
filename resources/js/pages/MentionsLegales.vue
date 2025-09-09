<script setup>
  import Header from '@/components/Header.vue'
  import Title from '@/components/small/Title.vue'
  import TitleText from '@/components/small/TitleText.vue'
  import Footer from '@/components/Footer.vue'

  import MentionsLegalesTexts from "@/../json/texts/MentionsLegalesTexts"
</script>

<template>
  <Header />
  <Title :text="MentionsLegalesTexts.title" />
  <template v-for="paragraph in MentionsLegalesTexts.paragraphs">
    <TitleText
      :title="paragraph.title"
      :texts="paragraph.texts"
    />
  </template>
  <Footer />
</template>

<style scoped>
</style>