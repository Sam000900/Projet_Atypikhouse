<script setup>
  import { Link } from '@inertiajs/vue3';
  import logoAtypikHouseAlt from'@/../../public/images/logo-atypik-house-alt.png'
</script>

<template>
    <footer class="all-footer">
    <div class="footer">
      <div class="footer-logo-box">
        <img :src="logoAtypikHouseAlt" alt="logo atypik house" />
      </div>

      <div class="footer-coords">
        <div class="footer-coords-sections">
          <div class="footer-coords-sections-icon-box">
            <VsxIcon iconName="Location" color="#ffffff" size="25" type="linear" />
          </div>
          <p>25566 Hc 1, Glenallen,<br> Alaska, 99588, USA</p>
        </div>
        <div class="footer-coords-sections">
          <div class="footer-coords-sections-icon-box">
            <VsxIcon iconName="Call" color="white" size="25" type="linear" />
          </div>
          <p>+603 4784 273 12</p>
        </div>
        <div class="footer-coords-sections">
          <div class="footer-coords-sections-icon-box">
            <VsxIcon iconName="Sms" color="white" size="25" type="linear" />
          </div>
          <p>AtypiqueHouse@gmail.com</p>
        </div>
      </div>

      <div class="footer-menu">
        <div class="footer-menu-column">
          <p class="footer-menu-title">A propos</p>
          <ul>
            <li><Link :href="route('contact')" class="footer-link">Notre histoire</Link></li>
            <li><Link :href="route('contact')" class="footer-link">Engagement Éco-responsable</Link></li>
            <li><Link :href="route('contact')" class="footer-link">Presse</Link></li>
          </ul>
        </div>
        <div class="footer-menu-column">
          <p class="footer-menu-title">Hôtes</p>
          <ul>
            <li><Link :href="route('devenir-hote')" class="footer-link">Devenir hôte</Link></li>
            <li><Link :href="route('contact')" class="footer-link">Centre d'aide</Link></li>
            <li><Link :href="route('conditions-generales-utilisation')" class="footer-link">Conditions</Link></li>
          </ul>
        </div>
        <div class="footer-menu-column">
          <p class="footer-menu-title">Aide</p>
          <ul>
            <li><Link :href="route('faq')" class="footer-link">FAQ</Link></li>
            <li><Link :href="route('contact')" class="footer-link">Contact</Link></li>
            <li><Link :href="route('conditions-generales-ventes')" class="footer-link">Politique d'annulation</Link></li>
          </ul>
        </div>
      </div>

      <div class="footer-media">
        <p class="footer-menu-title">Réseaux sociaux</p>
        <div class="footer-icon-box">
          <a href="https://www.facebook.com"><VsxIcon iconName="Facebook" color="white" size="25" type="linear" /></a>
          <a href="https://www.instagram.com"><VsxIcon iconName="Instagram" color="white" size="25" type="linear" /></a>
          <a href="https://www.youtube.com"><VsxIcon iconName="Youtube" color="white" size="25" type="linear" /></a>
        </div>
        <form class="footer-newsletter-form">
          <input type="text" class="footer-newsletter-input" placeholder="Inscription avec email" />
          <input type="submit" class="footer-newsletter-submit" value="S'abonner" />
        </form>
      </div>
    </div>
    <div class="subfooter">
      <p><Link :href="route('mentions-legales')" class="footer-link">Mentions légales</Link> et <Link :href="route('conditions-generales-utilisation')" class="footer-link">CGU</Link> ・ Copyright 2025 ・ Droit Réserver AtypiqueHouse  </p>
    </div>
  </footer>
</template>

<style scoped>

.footer {
    display: flex;
    gap: 80px;
    width: 100%;
    min-height: 280px;
    padding: 50px 80px 20px 80px;
    background-color: #3F5A54;
    color: #ffffff;
    font-family: Calibri, sans-serif;
    font-weight: 400;
  }

  .footer-logo-box {
    margin: auto 0px;
    height: 140px;
  }

  .footer-logo-box img {
    height: 100%;
  }

  .footer-coords {
    margin: auto 0px;
  }

  .footer-coords-sections {
    display: flex;
    align-items: center;
    margin: 20px 0;
    font-size: 14px;
  }

  .footer-coords-sections-icon-box {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-right: 15px;
  }

  .footer-menu {
    display: flex;
    gap: 50px;
  }

  .footer-menu-title {
    margin-bottom: 30px;
    font-size: 20px;
    font-weight: bold;
  }

  .footer-menu-column ul {
    list-style: none;
    padding: 0;
    font-size: 16px;
  }

  .footer-menu-column li {
    margin: 10px 0;
  }

  .footer-link {
    text-decoration: none;
    color: #ffffff;
  }

  .footer-icon-box {
    display: flex;
    gap: 15px;
    cursor: pointer;
    margin-bottom: 30px;
  }

  .footer-newsletter-form {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
  }

  .footer-newsletter-input {
    height: 50px;
    width: 200px;
    padding: 5px 10px;
    border-radius: 8px;
    border: solid #ffffff 1px;
    background-color: #3F5A54;
    color: #ffffff;
    font-size: 16px;
    font-weight: 400;
    font-family: Calibri, sans-serif;
  }

  .footer-newsletter-input::placeholder {
    color: #ffffff;
  }

  .footer-newsletter-submit {
    background-color: #ffffff;
    color: #3F5A54;
    font-size: 20px;
    height: 50px;
    padding: 0 20px;
    border: 0;
    border-radius: 8px;
  }

  .subfooter {
    display: flex;
    justify-content: center;
    padding: 20px 0;
    background-color: #3F5A54;
    color: white;
    font-size: 12px;
    font-weight: 400;
    font-family: Calibri, sans-serif;
  }

  @media screen and (max-width: 1250px) {
    .footer {
      flex-direction: column;
      padding: 30px 40px 10px 40px;
      gap: 10px;
    }

    .footer-logo-box {
      height: 80px;
    }

    .subfooter {
      padding: 20px 40px;
      justify-content:flex-start;
    }
  }

  @media screen and (max-width: 800px) {
    .footer {
      padding: 30px 10px 10px 10px;
    }

    .footer-menu {
      flex-direction: column;
      gap: 15px;
    }

    .footer-menu-title {
      margin-bottom: 10px;
    }

    .footer-menu-column li {
      margin: 5px 0;
    }

    .footer-media {
      margin-top: 10px;
    }

    .subfooter {
      padding: 20px 10px;
    }
  }
</style>
