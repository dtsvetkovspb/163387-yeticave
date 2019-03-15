<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
    <ul class="promo__list">
        <?php foreach ($categories as $cat): ?>
            <li class="promo__item promo__item--boards">
                <a class="promo__link" href="pages/all-lots.html"><?=isset($cat['name']) ? htmlspecialchars($cat['name']) : "";?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
<section class="lots">
    <div class="lots__header">
        <h2>Открытые лоты</h2>
    </div>
    <ul class="lots__list">
        <?php foreach ($lots as $key => $val): ?>
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="<?=isset($val['picture']) ? htmlspecialchars($val['picture']) : "#";?>" width="350" height="260" alt="<?=isset($val['name']) ? htmlspecialchars($val['name']) : "";?>">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?=isset($val['cat_name']) ? htmlspecialchars($val['cat_name']) : "";?></span>
                    <h3 class="lot__title"><a class="text-link" href="lot.php?id=<?=isset($val['id']) ? htmlspecialchars($val['id']) : ""?>"><?=isset($val['name']) ? htmlspecialchars($val['name']) : "";?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__cost"><?=isset($val['start_price']) ? formattedNum($val['start_price']) : "";?></span>
                        </div>
                        <div class="lot__timer timer">
                            <?=isset($val['UNIX_TIMESTAMP(exp_date)']) ? getHoursMinsDiff($val['UNIX_TIMESTAMP(exp_date)']) : ""?>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</section>