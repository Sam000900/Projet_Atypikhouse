<script setup>
  const props = defineProps(['uniqueArticleData']);
  const date = new Date(props.uniqueArticleData.created_at)
  const formattedDate = date.toLocaleDateString('fr-FR');
</script>

<template>
  <div class="articlecontent layout-container">
    <div class="articlecontent-main-box">
      <h1 class="articlecontent-title">{{ props.uniqueArticleData.name }}</h1>
      <p class="articlecontent-text">{{ props.uniqueArticleData.text }}</p>
    </div>
    <div class="articlecontent-conclusion-box">
      <h2 class="articlecontent-conclusion-title">Conclusion</h2>
      <p class="articlecontent-conclusion-content">{{ props.uniqueArticleData.conclusion }}</p>
    </div>
    <div class="articlecontent-separator"></div>
    <div class="articlecontent-user-box">
      <div class="articlecontent-user-box-texts">
        <p class="articlecontent-text">De  {{ props.uniqueArticleData.user.firstname }} {{ props.uniqueArticleData.user.lastname }}</p>
        <p class="articlecontent-text">Réalisé le : {{ formattedDate }}</p>
      </div>
      <div>
        <a href="https://www.facebook.com/share/1G9iJs4gxC/">
          <VsxIcon iconName="Facebook" color="#495057" size="35" type="bold" />
        </a>
      </div>
    </div>
  </div>
</template>

<style scoped>
  .articlecontent {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
  }

  .articlecontent-main-box {
    display: flex;
    flex-direction: column;
    width: 100%;
  }

  .articlecontent-title {
    font-family: "Larken-Medium";
    font-size: 40px;
    font-weight: 400;
    color: #296242;
    line-height: 100%;
    margin-bottom: 40px;
  }

  .articlecontent-text {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: 400;
    color: #000000;
  }

  .articlecontent-conclusion-box {
    display: flex;
    flex-direction: column;
    gap: 20px;
    width: 100%;
    padding: 20px 30px;
    border-radius: 14px;
    background-color: #58897d;
    margin-top: 40px;
    margin-bottom: 60px;
  }

  .articlecontent-conclusion-title {
    font-family: Calibri, sans-serif;
    font-size: 28px;
    font-weight: 400;
    color: #ffffff;
  }

  .articlecontent-conclusion-content {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: 400;
    color: #000000;
  }

  .articlecontent-separator {
    width: 80%;
    height: 1px;
    background-color: #C4C4C4;
    margin-bottom: 40px;
  }

  .articlecontent-user-box {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    padding: 0 10%;
  }

  .articlecontent-user-box-texts {
    display: flex;
    flex-direction: column;
    gap: 5px;
  }
</style>
