<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Be With Us, Fly With Us</title>
    <meta charset="utf-8">
    <link rel="icon" href="/images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/stylesheet/titlePage.css">
    <link rel="stylesheet" type="text/css" href="/stylesheet/animate.css">
    <link rel="stylesheet" type="text/css" href="/stylesheet/hover.css" media="all">
    <link href="http://fonts.googleapis.com/earlyaccess/hanna.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/earlyaccess/nanumgothic.css" rel="stylesheet">
  	<meta name="author" content="Kwonkyu Park">
  	<meta name="description" content="Main page of Boong-Boong venture company.">
    <meta http-equiv="X-UA-Compatible" content="IE=9"/>
  </head>
  <body>
    <header>
      <?php include("./navbar.html"); ?>
    </header>
    <section>
      <div class="section1">
        <article class="intro">
          <br><br><br>
          <div class="wow title-text center-text">
            Fly With Us, Be With Us : FLYAWAY
          </div>
          <!-- Main Title text(above) and image(below) -->
          <div class="center-image">
            <<img src="/images/icon/drone5.png" width="250px;">
          </div>

          <div class="center-text medium-text">
            <a href="#section2" class="hvr-grow-shadow"><i>저희와 함께하세요!</i></a>
          </div>
        </article>
      </div>

      <div class="section2">
        <a name="section2"></a>
        <div class="articles">
          <article id="features-drone" class="wow bounceInLeft">
            <!-- <div class="wow bounceInLeft"> -->
              <table>
                <tr class="table-head">
                  <td>보장되고 안전한 배송</td>
                </tr>
                <tr class="table-box box-250 small-image hover-scaleup small-text">
                  <td><img src="/images/icon/drone1.png"></td>
                </tr>
                <tr class="table-box small-text">
                  <td>안전한 드론으로 원하는 곳까지<br>배송을 수행합니다.</td>
                </tr>
              </table>
            <!-- </div> -->
          </article>

          <article id="features-fly" class="wow bounceInUp">
            <!-- <div class="wow bounceInUp"> -->
              <table>
                <tr class="table-head">
                  <td>하늘을 이용한 배송</td>
                </tr>
                <tr class="table-box box-250 small-image">
                  <td><img class="hvr-bob" src="/images/icon/drone-flying.png"></td>
                </tr>
                <tr class="table-box small-text">
                  <td>지상을 누비던 기존과 달리<br>저희는 하늘을 누비고 다닙니다.</td>
                </tr>
              </table>
            <!-- </div> -->
          </article>

          <article id="features-insurance" class="wow bounceInRight">
            <!-- <div class="wow bounceInRight"> -->
              <table>
                <tr class="table-head">
                  <td>신뢰할 수 있는 배송</td>
                </tr>
                <tr class="table-box box-250 small-image">
                  <td><img class="hvr-buzz-out" src="/images/fixer.png"></td>
                </tr>
                <tr class="table-box small-text">
                  <td>고객이 만족할 수 있도록 배송 후<br>사후 처리까지 확실히 지원합니다.</td>
                </tr>
              </table>
            <!-- </div> -->
          </article>
        </div>

        <br><br>
        <article id="join-us">
          <a href="#section3">
            <div class="center-text hvr-grow">
            저희가 어떤 일을 이루었을까요?
            </div>
          </a>
        </article>
      </div>

      <div class="section3">
        <a name="section3"></a>
        <div class="articles">
          <article id="records">

          </article>
        </div>

      </div>

    </section>

    <footer>
      <span>
        Icons made by
        <a href="https://www.flaticon.com/authors/photo3idea-studio" title="photo3idea_studio">photo3idea_studio</a>,
        <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a>,
        <a href="https://www.flaticon.com/authors/pixel-perfect" title="Pixel perfect">Pixel perfect</a>,
        <a href="https://www.flaticon.com/authors/icongeek26" title="Icongeek26">Icongeek26</a>,
        from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a>
        is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a>
        <br>
        Photo by asoggetti, Annie Spratt, JJ Ying on Unsplash, <a href="https://startupstockphotos.com/">Startup Stock Photo</a> on CC0 License, <a href="https://picjumbo.com/author/viktorhanacek/">Viktor Hanacek</a> on picjumbo<br>

        Font by NanumGothic, Ever Looser(Azetype Std).<br>
        Design inspired by <a href="http://pha1155.cafe24.com/portfolio/">Hyeonah Park</a>.
      </span>
      <br><br>
      <span onclick="alert('Facebook!');">
        <img src="https://image.flaticon.com/icons/svg/1051/1051360.svg" width="30px">
      </span>
      <span onclick="alert('Instagram!');">
        <img src="https://image.flaticon.com/icons/svg/733/733614.svg" width="30px">
      </span>
      <span onclick="alert('Twitter!');">
        <img src="https://image.flaticon.com/icons/svg/1051/1051382.svg" width="30px">
      </span>
    </footer>

    <script src="scripts/wow.min.js"></script>
    <script> new WOW().init();</script>
  </body>
</html>
