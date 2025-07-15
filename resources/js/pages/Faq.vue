<script setup>
  import Header from '@/components/Header.vue';
  import Banner from '@/components/Banner.vue';
  import FaqFull from '@/components/FaqFull.vue';
  import ContactForm from '@/components/ContactForm.vue';
  import Footer from '@/components/Footer.vue';
  import imgBanner from '@/../../public/images/img-logement-cabane-en-haut-d-un-arbre.jpg';
</script>

<template>
  <Header />
  <Banner :image="imgBanner" />
  <FaqFull />
  <ContactForm />
  <Footer />
</template>

<style scoped>
</style>