<script setup>
  import Header from '@/components/Header.vue';
  import BannerAlt from '@/components/large/BannerAlt.vue';
  import DuoTextImage from '@/components/large/DuoTextImage.vue';
  import ContactForm from '@/components/large/ContactForm.vue';
  import Footer from '@/components/Footer.vue';
  import imgBanner from '@/../../public/images/img-wooden-planks.jpg';

  import imgDuoTextImageData1 from '@/../../public/images/img-logement-ruche.jpg';
  import imgDuoTextImageData2 from '@/../../public/images/img-logement-train.jpg';
  import imgDuoTextImageData3 from '@/../../public/images/img-logement-avec-jet.jpg';

  const DuoTextImageData = [
    {
      title: "Notre Histoire",
      texts: [
        "Atypik Home est une société jeune et dynamique, fondée par trois associés passionnés par les voyages, l'habitat alternatif et la nature. Notre objectif est simple : offrir à chacun l'opportunité de s'évader de l'ordinaire en séjournant dans des logements insolites, tels que des cabanes dans les arbres, des yourtes ou des cabanes flottantes.",
        "Ensemble, nous avons réuni nos compétences techniques et financières, mais aussi notre amitié, pour créer un projet qui reflète nos valeurs communes de respect de l'environnement, de simplicité et d'authenticité. Atypik Home est née de ce rêve : offrir une alternative aux vacances traditionnelles, en harmonie avec la nature et en toute sérénité."
      ],
      image: imgDuoTextImageData1,
    },
    {
      title: "Nos valeurs",
      texts: [
        "Chez Atypik Home, nous croyons que le logement temporaire peut être bien plus qu'un simple endroit où dormir. Il doit être une expérience unique, un retour aux sources, une aventure en soi. Nous nous engageons à offrir des habitats atypiques qui respectent l'environnement et permettent à chacun de vivre une expérience immersive en pleine nature.",
        "Nous mettons un point d'honneur à travailler avec des propriétaires qui partagent cette vision et qui, comme nous, souhaitent créer des espaces chaleureux et respectueux de leur environnement. Chaque lieu que nous proposons est une invitation à découvrir une autre manière de vivre, loin du stress quotidien, au cœur de paysages magnifiques."
      ],
      image: imgDuoTextImageData2,
    },
        {
      title: "Notre Mission",
      texts: [
        "Atypik Home propose un service de mise en relation et de réservation pour la location d'habitations insolites en France et en Europe. Notre plateforme permet à ceux qui cherchent une escapade différente de trouver facilement des logements alternatifs, que ce soit pour un week-end, des vacances en famille ou un séjour romantique.",
        "Nous voulons faciliter l'accès à des expériences de voyage uniques, tout en apportant une sécurité et une simplicité dans les réservations. Notre équipe travaille sans relâche pour garantir une expérience fluide et agréable, de la recherche du logement à la réservation finale."
      ],
      image: imgDuoTextImageData3,
    }
  ];

</script>

<template>
  <Header />
  <BannerAlt :image="imgBanner" title="À propos" />
  <DuoTextImage
    v-for="(item, index) in DuoTextImageData"
    :title="item.title"
    :texts="item.texts"
    :image="item.image" 
    :index="index"
  />
  <ContactForm />
  <Footer />
</template>

<style scoped>
</style>