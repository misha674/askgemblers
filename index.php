<?php 
// Массив доступных для выбора языков
$langArray = array("", "pt","ru","de","en","br", "fr", "el","es","fi","no");
// Получаея язык устройста и применяем его на случай если в coockie не прописано
$langDevice = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
// Массив  языков для отключения кнопки в хєдєре и попапа 
$langHidePopup = array("","ru","no","br"); 

// проверяем, если был передан язык в урле и присутствует ли он в массиве возможных языков, то записываем его в куку
if(isset($_GET['lang']) && array_search($_GET['lang'], $langArray)):
  // задаем язык сайту
  $activeLang = $_GET['lang'];
  // устанавливаем куку с языком сайта
  setcookie ("lang_site", $activeLang, time() + 3600*24*30, "/"); 
// проверяем наличие в cookie значения языка и присутствует ли он в массиве возможных языков, если есть то используем ее
elseif (isset($_COOKIE['lang_site']) && array_search($_COOKIE['lang_site'], $langArray)): 
 // получем язык сайта из куки
  $activeLang = $_COOKIE['lang_site'];
elseif($langDevice && array_search($langDevice, $langArray)): // если cookie и url пустые - применяем язык устроства
  $activeLang = $langDevice;
else:
  // default значение для языка сайта
  $activeLang = 'en'; 
endif;

// присваиваю переменной hidePopup ключ первого найденного элемента в случае успешного выполнения ф-и  array_search, которая ищет в langHidePopup значение activeLang.
$hidePopup = array_search($activeLang, $langHidePopup);

include_once ("languages/lang-".$activeLang.".php");

?>

<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
  <link rel="icon" type="image/x-icon" sizes="16x16" href="images/favicon/icon.ico">
  <link rel="mask-icon" href="images/favicon/icon.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#1e0b0b">
  <title>askgemblers | B&amp;U</title>
  <link rel="stylesheet" href="css/style.min.css">
</head>

<body>
  <header class="header">
    <div class="container">
      <div class="header__inner">
        <div class="header__left">
          <div class="logo"> <a href="#">
              <svg class="logo__svg">
                <use xlink:href="images/sprite.svg#icon-logo"></use>
              </svg></a>
            <div class="logo__slogan">
              <p class="logo__text min-font">best bets for you</p>
            </div>
            <div class="logo__hand">
              <svg class="logo__hand-icon">
                <use xlink:href="images/sprite.svg#icon-hand">
            </div>
          </div>
        </div>
            <?php 
              if($hidePopup) {?>
              <!-- no content -->
              <?php } else { ?>
                <div class="howreg">
                  <div class="howreg__content" data-modal="popup-modal">
                    <div class="howreg__icon">
                      <svg class="howreg__svg">
                        <use xlink:href="images/sprite.svg#icon-phone"></use>
                      </svg>
                    </div>
                    <p class="howreg__text"><span><?= $local['how_reg'] ?></span> <?= $local['how_reg_2'] ?></p>
                  </div>
                </div>
              <?php }
            ?>
        <ul class="socials">
          <li class="socials__item"> <a class="socials__link" href="https://www.facebook.com/betandyouinfo"
              target="_blanc">
              <svg class="socials__icon">
                <use xlink:href="images/sprite.svg#icon-fb"></use>
              </svg></a></li>
          <li class="socials__item"> <a class="socials__link" href="https://www.instagram.com/_betandyou_"
              target="_blanc">
              <svg class="socials__icon">
                <use xlink:href="images/sprite.svg#icon-instagramm"></use>
              </svg></a></li>
          <li class="socials__item"> <a class="socials__link" href="https://t.me/betandyouofficial" target="_blanc">
              <svg class="socials__icon">
                <use xlink:href="images/sprite.svg#icon-telegramm"></use>
              </svg></a></li>
        </ul>

        <div class="header__box">
          <div class="langCheck">
            <div class="langCheck__wrapper">

              <div class="langCheck__item langCheck__item-<?= $activeLang; ?> selected">
                <div class="icon icon-<?= $activeLang; ?>"></div>
                <span class="langContext"><?= $activeLang; ?></span>
                <span class="arrow"></span>
              </div>

              <?php 
                foreach ($langArray as $lang) {
                  if($lang != $activeLang) {?>
                    <div class="langCheck__item langCheck__item-<?= $lang; ?> ">
                      <div class="icon icon-<?= $lang; ?>"></div>
                        <a href="?lang=<?= $lang; ?>" class="langContext"><?= $lang; ?></a>
                    </div>
                  <?php }
                } 
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <div class="wrapper">
    <main class="main">
      <section class="page">
        <div class="container">
          <div class="page__inner">
            <div class="page__img-box"><img class="page__img" src="images/items.png"></div>
            <div class="page__top">
              <div class="page__bonus">
                <p class="page__appeal"> <?= $local['come_and_spin']?> !</p>
                <h1 class="page__call"><?= $local['take_bonus']?></h1>
                <p class="page__big-text"><span><?= $local['amount_discont1']?></span> <?= $local['amount_discont2']?>!</p>
                <p class="page__descr"><?= $local['cashback1']?> <span><?= $local['cashback2']?></span> 8%</p>
              </div>
            </div>
            <div class="btn-boxtop"><a class="btn-boxtop__new" id="getTop" href="https://betandyou.com/registration/"
                target="_blank"><?= $local['get_bonus']; ?></a>
              <p class="btn-boxtop__rules" id="rulesTop" data-modal="popup-modal"><?= $local['how_register_faq']?></p>
            </div>
          </div>
        </div>
        <div class="container container--fluid">
          <div class="instruction" id="load">
            <ul class="instruction__items">
              <li class="instruction__number" id="instructionNumberOne">
                <div class="instruction__article">
                  <p class="instruction__action"><?= $local['instruction1']?></p>
                </div>
              </li>
              <li class="instruction__number" id="instructionNumberTwo">
                <div class="instruction__article">
                  <?php 
                    if($activeLang === 'de') {?>
                        <p class="instruction__action">
                        <span><?= $local['instruction2-1']?></span><?= $local['instruction2']?> </p>
                    <?php }  else { ?>
                      <p class="instruction__action"><?= $local['instruction2']?><span><?= $local['instruction2-1']?></span> </p>
                    <?php }
                  ?>
                </div>
              </li>
              <li class="instruction__number" id="instructionNumberThree">
                <div class="instruction__article">
                  <p class="instruction__action"> <span><?= $local['instruction3']?></span><?= $local['instruction3-1']?></p>
                </div>
              </li>
              <li class="instruction__number" id="instructionNumberFour">
                <div class="instruction__article">
                  <p class="instruction__action"><span> </span><?= $local['instruction4']?></span></p>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <div class="container">
          <div class="btn-box"><a class="btn-box__new" id="get" href="https://betandyou.com/registration/"
              target="_blank"><?= $local['recive_bonus']?></a>
            <a class="btn-box__rules" href="https://betandyou.com/information/rules/" id="rules"><?= $local['therms_and_rules']?></a>
          </div>
          <ul class="socials socials--mobile">
            <li class="socials__item"> <a class="socials__link" href="https://www.facebook.com/betandyouinfo"
                target="_blanc">
                <svg class="socials__icon">
                  <use xlink:href="images/sprite.svg#icon-fb"></use>
                </svg></a></li>
            <li class="socials__item"> <a class="socials__link" href="https://www.instagram.com/_betandyou_"
                target="_blanc">
                <svg class="socials__icon">
                  <use xlink:href="images/sprite.svg#icon-instagramm"></use>
                </svg></a></li>
            <li class="socials__item"> <a class="socials__link" href="https://t.me/betandyouofficial" target="_blanc">
                <svg class="socials__icon">
                  <use xlink:href="images/sprite.svg#icon-telegramm"></use>
                </svg></a></li>
          </ul>
        </div>
      </section>
    </main>
  </div>
  <div class="popup modal" id="popup-modal">
    <div class="popup__wrapper">
      <div class="popup__close"> <span class="popup__close-btn"></span></div>
      <div class="popup__content">
        <div class="popup__image"> <img class="popup__img" src="images/pupup__gif.jpg" alt=""></div>
        <ul class="popup__list">
          <li class="popup__number">
            <?php 
              if($activeLang === 'pt' || $activeLang === 'de') {?>

                <p class="popup__text">
                  <?= $local['popup_rule1-1']?>
                  <span><?= $local['popup_rule1']?></span>  
                  <span><?= $local['popup_rule1-2']?></span>
                   <?= $local['popup_rule1-3']?>
                </p>
              <?php }  else { ?>

                  <p class="popup__text">
                  <span><?= $local['popup_rule1']?></span> <?= $local['popup_rule1-1']?> <span><?= $local['popup_rule1-2']?></span> <?= $local['popup_rule1-3']?>
                </p>
                
              <?php }
            ?>
          </li>
          <li class="popup__number">
            <p class="popup__text">
              <?= $local['popup_rule2']?> <span><?= $local['popup_rule2-1']?> </span> <?= $local['popup_rule2-2']?>
            </p>
          </li>
          <li class="popup__number">
            <p class="popup__text"><?= $local['popup_rule3']?> <span><?= $local['popup_rule3-1']?></span> <?= $local['popup_rule3-2']?>.
            </p>
          </li>
        </ul>
        <div class="popup__button"><a class="popup__btn" href="https://betandyou.com/registration/?no_fast_reg=1">
            <?= $local['popup_button']?>
          </a></div>
      </div>
    </div>
  </div>
</body>
<script src="js/main.min.js"></script>

</html>