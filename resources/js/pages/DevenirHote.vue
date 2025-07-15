<script setup>
  import Header from '@/components/Header.vue'
  import Banner from '@/components/Banner.vue'
  import GridStats from '@/components/GridStats.vue'
  import FormInfoAccommodation from '@/components/FormInfoAccommodation.vue'
  import TextImageGrid from '@/components/TextImageGrid.vue'
  import Steps from '@/components/Steps.vue'
  import Faq from '@/components/Faq.vue'
  import Support from '@/components/Support.vue'
  import Footer from '@/components/Footer.vue'
  import imgHommeSouriant from '@/../../public/images/img-homme-souriant-devant-logement-2.jpg'
</script>

<template>
  <Header />
  <Banner :image="imgHommeSouriant" />
  <GridStats />
  <FormInfoAccommodation />
  <TextImageGrid />
  <Steps />
  <Faq />
  <Support />
  <Footer />
</template>

<style scoped>
</style>