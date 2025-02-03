<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./css/styles.css">
    <title>Web Design Mastery | Pastry World</title>
  </head>
  <body>
    <header>
      <nav>
        <div class="nav__header">
          <div class="nav__logo">
            <a href="#">
              <img src="assets/logo.png" alt="logo" />
            </a>
          </div>
          <div class="nav__menu__btn" id="menu-btn">
            <i class="ri-menu-3-line"></i>
          </div>
        </div>
        <ul class="nav__links" id="nav-links">
          <li><a href="#home">Home</a></li>
          <li><a href="#menu">Aluno</a></li>
          <li><a href="#about">Instrutor</a></li>
          <li><a href="">Aulas</a></li>
        </ul>
      </nav>

      <div class="section__container header__container" id="home">
        <h1>Fitness Center</h1>
        <p>
         Venha fazer história, transpire resultados.
        </p>
        <div class="header__btns">
         
        </div>
      </div>
    </header>

    <section class="section__container about__container" id="about">
      <div class="about__image">
      <img src="./img/mulheres-academia.jpg" alt="">
      </div>
      <div class="about__content">
        <h2 class="section__header">Sobre nós</h2>
        <div>
          <p>
          A Fitness Center surgiu num mercado emergente e desafiador, buscou a inovação por necessidade. Hoje se iguala a grandes marcas, porém com preços acessíveis.
          </p>
          <p>
          Sendo altamente inovadora e resiliente, a Fitness Center tem todos os ingredientes para expandir exponencialmente e trazer qualidade de vida aos seus clientes.
          </p>
          <div class="about__btn">
    
          </div>
        </div>
      </div>
    </section>

    <section class="menu" id="menu">
      <div class="section__container menu__container">
        <h2 class="section__header">Conheça as
nossas modalidades

</h2>
        <a href="#">
        Serviços
          <i class="ri-arrow-right-long-line"></i>
        </a>
        <div class="menu__grid">
          <div class="menu__card">
          <img src="./img/yoga.jpg" alt="">
            <div class="menu__card__content">
            
              <h3>Yoga</h3>
            
            </div>
          </div>
          <div class="menu__card">
          <img src="./img/musculação.jpg" alt="">
            <div class="menu__card__content">
        
              <h3>Musculação</h3>
            </div>
          </div>
          <div class="menu__card">
          <img src="./img/crossfit.jpg" alt="">
            <div class="menu__card__content">
         
              <h3>Crossfit</h3>
            </div>
          </div>
          <div class="menu__card">
          <img src="./img/aerobico.jpg" alt="">
            <div class="menu__card__content">
        
              <h3>Aeróbico</h3>
            </div>
          </div>
        </div>
      </div>
    </section>

 



    <footer>
      <div class="section__container footer__container">
        <div class="footer__col">
          <a href="#" class="footer__logo">
            <img src="assets/logo.png" alt="logo" />
          </a>
        </div>
        <div class="footer__col">
          <h4>Entre em Contato</h4>
          <ul class="footer__links">
            <li>
              <a href="#">
              (12)98878-4567
              </a>
            </li>
            
          </ul>
        </div>
     
        <div class="footer__col">
          <h4>Social Media</h4>
          <ul class="footer__links">
            <li><a href="#">Twitter</a></li>
            <li><a href="#">Youtube</a></li>
            <li><a href="#">Instagram</a></li>
          </ul>
        </div>
      </div>
      <div class="footer__bar">
        Fitness Center © 2025 Academia.
      </div>
    </footer>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="./js/script.js"></script>
  </body>
</html>