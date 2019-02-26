<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
    <ul class="promo__list">
        <?php foreach ($categories as $cat): ?>
            <li class="promo__item promo__item--boards">
                <a class="promo__link" href="pages/all-lots.html"><?=$cat['name'];?></a>
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
                    <img src="<?=$val['picture'];?>" width="350" height="260" alt="<?=$val['name'];?>">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?=$val['cat_name'];?></span>
                    <h3 class="lot__title"><a class="text-link" href="pages/lot.html"><?=$val['name'];?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <!--<span class="lot__amount"><?/*=$val['Price'];*/?></span>-->
                            <span class="lot__cost"><?=formattedNum($val['start_price']);?></span>
                        </div>
                        <div class="lot__timer timer">
                            <?=timeToNextDay();?>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</section>