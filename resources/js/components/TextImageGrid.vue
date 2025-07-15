<script setup>
  import imgFemmeSouriante from '@/../../public/images/img-femme-souriante-devant-logement.jpg'
</script>

<template>
  <div class="textimagegrid">
    <div class="textimagegrid-description">
      <h2 class="textimagegrid-description-title">Pourquoi Devenir Hôte ?</h2>
      <p class="textimagegrid-description-text">Louer votre logement à des voyageurs peut être une excellente opportunité pour générer des revenus tout en partageant votre espace avec des passionnés de découvertes. Que vous possédiez une cabane en forêt, une tiny house ou un loft en ville, devenez hôte offrant de nombreux avantages. Découvrez pourquoi c'est une aventure aussi louable qu'enrichissante !</p>
    </div>
    <div class="textimagegrid-bottom">
      <div class="textimagegrid-image-box">
        <img :src="imgFemmeSouriante" alt="Femme souriante devant son logement" class="textimagegrid-image" />
      </div>
      <div class="textimagegrid-grid">
        <div class="textimagegrid-grid-element">
          <h3 class="textimagegrid-grid-element-title">Assurance et Sécurité</h3>
          <p class="textimagegrid-grid-element-text">Louez en toute sérénité grâce à une assurance contre les dommages, une assistance 24h/24 et 7j/7 et un système de prudence sécurisé.</p>
        </div>
        <div class="textimagegrid-grid-element">
          <h3 class="textimagegrid-grid-element-title">Visibilité maximale</h3>
          <p class="textimagegrid-grid-element-text">Attirez des milliers de voyageurs en quête d'expériences uniques, qu'ils soient aventuriers ou familles en quête de confort.</p>
        </div>
        <div class="textimagegrid-grid-element">
          <h3 class="textimagegrid-grid-element-title">Revenus complémentaires</h3>
          <p class="textimagegrid-grid-element-text">
            Louez votre logement pour générer un revenu passif, rembourser un crédit ou financer vos projets, tout en fixant librement vos tarifs.</p>
        </div>
        <div class="textimagegrid-grid-element">
          <h3 class="textimagegrid-grid-element-title">Flexibilité totale</h3>
          <p class="textimagegrid-grid-element-text">Devenez hôte en toute liberté : choisissez vos périodes de location, la durée des séjours et fixez vos propres tarifs.</p>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
  .textimagegrid {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .textimagegrid-description {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 40px 80px;
  }

  .textimagegrid-description-title {
    font-family: "Larken-Medium";
    font-size: 40px;
    font-weight: 400;
    color: #296242;
    line-height: 100%;
    margin-bottom: 20px;
    text-align: center;
  }

  .textimagegrid-description-text {
    max-width: 900px;
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: 400;
    color: #000000;
    text-align: center;
  }

  .textimagegrid-bottom {
    display: flex;
    width: 100%;
  }

  .textimagegrid-image-box {
    display: flex;
    flex: 1;
  }

  .textimagegrid-image {
    width: 100%;
    object-fit: cover;
  }

  .textimagegrid-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    width: 70%;
    gap: 2px;
    background-color: #DCDCDC;
    padding: 2px 0;
  }

  .textimagegrid-grid-element {
    display: flex;
    flex-direction: column;
    min-height: 150px;
    padding: 20px;
    background-color: #ffffff;
  }

  .textimagegrid-grid-element-title {
    font-family: "Larken-Medium";
    font-size: 20px;
    font-weight: bold;
    color: #296242;
    line-height: 100%;
    margin-bottom: 10px;
  }

  .textimagegrid-grid-element-text {
    font-family: Calibri, sans-serif;
    font-size: 18px;
    font-weight: 400;
    color: #000000;
  }

  @media screen and (max-width: 1000px) {
    .textimagegrid-image-box {
      display: none;
    }

    .textimagegrid-grid {
      width: 100%;
    }

    .textimagegrid-description-text {
      font-size: 18px;
    }
  }

  @media screen and (max-width: 800px) {
    .textimagegrid-description {
      margin: 40px 80px;
    }

    .textimagegrid-description-title {
      font-size: 30px;
    }
  }

  @media screen and (max-width: 600px) {
    .textimagegrid-description {
      margin: 30px 20px;
    }

    .textimagegrid-grid {
      grid-template-columns: 1fr;
    }

    .textimagegrid-grid-element {
      min-height: 100px;
    }
  }

</style>