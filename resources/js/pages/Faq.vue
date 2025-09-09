<script setup>
  import Header from '@/components/Header.vue';
  import BannerAlt from '@/components/large/BannerAlt.vue';
  import FaqFull from '@/components/large/FaqFull.vue';
  import ContactForm from '@/components/large/ContactForm.vue';
  import Footer from '@/components/Footer.vue';
  import imgBanner from '@/../../public/images/img-logement-cabane-en-haut-d-un-arbre.jpg';
</script>

<template>
  <Header />
  <BannerAlt :image="imgBanner" title="FAQ" />
  <FaqFull />
  <ContactForm />
  <Footer />
</template>

<style scoped>
</style>