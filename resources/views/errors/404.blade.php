<div class="notfound">
    <img src="{{ asset('images/img-page-introuvable.jpg') }}" alt="cette page est introuvable" class="notfound-image" />
    <p class="notfound-title">PAGE INTROUVABLE</p>
    <p class="notfound-text">Nous ne trouvons pas la page que vous recherchez... !</p>
    <a href="{{ url('/') }}" class="notfound-button">Retour à l'accueil</a>
</div>

<style>
  .notfound {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 10px;
    height: 100%;
    text-align: center;
    background-color: #ffffff;
  }

  .notfound-image {
    width: 100%;
    max-width: 800px;
  }

  .notfound-title {
    margin: 30px 0 10px 0;
    font-family: "Larken-Medium", sans-serif;
    font-size: 54px;
    font-weight: 400;
    color: #000000;
    letter-spacing: 5px;
  }

  .notfound-text {
    font-family: Calibri, sans-serif;
    font-size: 18px;
    font-weight: 400;
    color: #000000;
  }

  .notfound-button {
    display: inline-block;
    text-decoration: none;
    text-align: center;
    height: 60px;
    padding: 0 30px;
    margin-top: 20px;
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: 400;
    border: 0;
    border-radius: 8px;
    background-color: #DD6318;
    color: #ffffff;
    cursor: pointer;
    line-height: 60px;
  }

  @media screen and (max-width: 700px) {
    .notfound-title {
      font-size: 36px;
      letter-spacing: 2px;
    }
  }
</style>