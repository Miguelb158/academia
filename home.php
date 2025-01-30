<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Web Design Mastery | Rayal Park</title>
  </head>
  <body>
    <header class="header">
      <nav>
        <div class="nav__bar">
          <div class="logo">
            <a href="#">   <img src="./img/logoo.jpg" alt=""></a>
          </div>
          <div class="nav__menu__btn" id="menu-btn">
            <i class="ri-menu-line"></i>
          </div>
        </div>
        <ul class="nav__links" id="nav-links">
          <li><a href="#home">Home</a></li>
          <li><a href="#about">Aluno</a></li>
          <li><a href="#service">Instrutor</a></li>
          <li><a href="#explore">Aulas</a></li>
        
        </ul>
       
      </nav>
      <div class="section__container header__container" id="home">
        <p>Bem-vindo</p>
        <h1>Venha treinar na maior<br />rede de <span>Academia</span>.</h1>
      </div>
    </header>

    <section class="section__container booking__container">
      <form action="/" class="booking__form">
        <div class="input__group">
          <span><i class="bi bi-person-fill"></i></span>
          <div>
            <label for="check-in">Aluno</label>
            <input type="text" placeholder="Clique aqui" />
          </div>
        </div>
        <div class="input__group">
          <span><i class="bi bi-people-fill"></i></i></span>
          <div>
            <label for="check-out">Instrutor</label>
            <input type="text" placeholder="Clique aqui" />
          </div>
        </div>
        <div class="input__group">
          <span><i class="bi bi-calendar4-week"></i></span>
          <div>
            <label for="guest">Aulas</label>
            <input type="text" placeholder="Clique aqui" />
          </div>
        </div>
        <div class="input__group input__btn">
         
        </div>
      </form>
    </section>
    <section class="section__container about__container" id="about">
      <div class="about__image">
      <img src="./img/mulheres-academia.jpg" alt="">
      </div>
      <div class="about__content">
        <p class="section__subheader">Quem somos?</p>
      
        <p class="section__description">
         
A Academia Bradock é o lugar ideal para quem busca força, disciplina e superação. Com equipamentos modernos e treinos personalizados, oferecemos musculação, funcional e lutas para todos os níveis. Nossa equipe qualificada te ajuda a alcançar seus objetivos com foco e motivação. Venha treinar e transforme seu corpo e mente!
        </p>
        <div class="about__btn">

        </div>
      </div>
    </section>

    <script src="./js/script.js"></script>

    </body>
</html>