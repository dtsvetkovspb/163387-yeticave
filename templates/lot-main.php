<nav class="nav">
    <ul class="nav__list container">
        <li class="nav__item">
            <a href="all-lots.html">Доски и лыжи</a>
        </li>
        <li class="nav__item">
            <a href="all-lots.html">Крепления</a>
        </li>
        <li class="nav__item">
            <a href="all-lots.html">Ботинки</a>
        </li>
        <li class="nav__item">
            <a href="all-lots.html">Одежда</a>
        </li>
        <li class="nav__item">
            <a href="all-lots.html">Инструменты</a>
        </li>
        <li class="nav__item">
            <a href="all-lots.html">Разное</a>
        </li>
    </ul>
</nav>
<section class="lot-item container">
    <h2><?=$lot[0]['name']?></h2>
    <div class="lot-item__content">
        <div class="lot-item__left">
            <div class="lot-item__image">
                <img src="<?=$lot[0]['picture']?>" width="730" height="548" alt="Сноуборд">
            </div>
            <p class="lot-item__category">Категория: <span><?=$lot[0]['cat_name']?></span></p>
            <p class="lot-item__description">Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив
                снег
                мощным щелчкоми четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот
                снаряд
                отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом
                кэмбер
                позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется,
                просто
                посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла
                равнодушным.</p>
        </div>
        <div class="lot-item__right">
            <div class="lot-item__state">
                <div class="lot-item__timer timer">
                    <?=getHoursMinsDiff($lot[0]['UNIX_TIMESTAMP(exp_date)'])?>
                </div>
                <div class="lot-item__cost-state">
                    <div class="lot-item__rate">
                        <span class="lot-item__amount">Текущая цена</span>
                        <span class="lot-item__cost"><?=$resPrice;?></span>
                    </div>
                    <div class="lot-item__min-cost">
                        Мин. ставка <span><?=$resPrice + $betStep?></span>
                    </div>
                </div>
            <?php if (isset($_SESSION['user'])): ?>
                <form class="lot-item__form" action="lot.php?id=<?=$lotId?>" method="post" enctype="application/x-www-form-urlencoded">
                    <p class="lot-item__form-item form__item form__item--invalid">
                        <label for="cost">Ваша ставка</label>
                        <input id="lotId" type="hidden" name="lotId" value="<?=htmlspecialchars($_GET['id'])?>" >
                        <input id="cost" type="text" name="cost" placeholder="<?=$resPrice + $betStep?>" required>
                        <?php if (!empty($errors)): ?>
                            <span class="form__error"><?=$errors['cost']?></span>
                        <?php endif; ?>
                    </p>
                    <button type="submit" class="button">Сделать ставку</button>
                </form>
            <?php endif; ?>
            </div>
            <div class="history">
                <h3>История ставок (<span><?=$betsCount?></span>)</h3>
                <table class="history__list">
                    <?php foreach ($bets as $key => $val): ?>
                        <tr class="history__item">
                            <td class="history__name"><?=$val['name']?></td>
                            <td class="history__price"><?=$val['offer_price']?> р</td>
                            <td class="history__time"><?=timeDiff($val['UNIX_TIMESTAMP(date_add)'])?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</section>