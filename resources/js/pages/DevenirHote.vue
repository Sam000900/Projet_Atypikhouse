<script setup>
  import Header from '@/components/Header.vue'
  import BannerAlt from '@/components/large/BannerAlt.vue'
  import GridStats from '@/components/large/GridStats.vue'
  import FormInfoAccommodation from '@/components/large/FormInfoAccommodation.vue'
  import TextImageGrid from '@/components/large/TextImageGrid.vue'
  import Steps from '@/components/large/Steps.vue'
  import FaqStatic from '@/components/large/FaqStatic.vue'
  import Support from '@/components/large/Support.vue'
  import Footer from '@/components/Footer.vue'
  import imgHommeSouriant from '@/../../public/images/img-homme-souriant-devant-logement-2.jpg'
</script>

<template>
  <Header />
  <BannerAlt :image="imgHommeSouriant" title="Devenir Hôte" />
  <GridStats />
  <FormInfoAccommodation />
  <TextImageGrid />
  <Steps />
  <FaqStatic />
  <Support />
  <Footer />
</template>

<style scoped>
</style>