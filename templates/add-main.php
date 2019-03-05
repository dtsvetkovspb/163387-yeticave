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
<form class="form form--add-lot container <?= count($errors) ? 'form--invalid' : ''; ?>" action="add.php" method="post" enctype="multipart/form-data">
    <h2>Добавление лота</h2>
    <div class="form__container-two">

       <?php $classname = isset($errors['lot-name']) ? "form__item--invalid" : "";
        $value = isset($lot['lot-name']) ? $lot['lot-name'] : "";?>
        <div class="form__item <?=$classname;?> ">
            <label for="lot-name">Наименование</label>
            <input id="lot-name" type="text"  name="lot-name" placeholder="Введите наименование лота" value="<?=$value;?>">
            <span class="form__error"><?=$dict['lot-name'];?>: <?=$errors['lot-name'];?></span>
        </div>

        <?php $classname = isset($errors['category']) ? "form__item--invalid" : "";
        $value = isset($lot['category']) ? $lot['category'] : "";?>
        <div class="form__item <?=$classname;?>">
            <label for="category">Категория</label>
            <select id="category" name="category" >

                <option value="<?= $value; ?>"><?= $value == '' ? 'Выберите категорию' : $categories[$value - 1]['name']?></option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?=$cat['id']?>"><?=$cat['name']?></option>
                <?php endforeach; ?>
            </select>
            <span class="form__error"><?=$dict['category'];?>: <?=$errors['category'];?></span>
        </div>
    </div>

    <?php $classname = isset($errors['description']) ? "form__item--invalid" : "";
    $value = isset($lot['description']) ? $lot['description'] : "";?>
    <div class="form__item form__item--wide <?=$classname;?>">
        <label for="description">Описание</label>
        <textarea id="description" name="description" placeholder="Напишите описание лота"><?=$value;?></textarea>
        <span class="form__error">Напишите описание лота</span>
    </div>
    <div class="form__item form__item--file"> <!-- form__item--uploaded -->
        <label>Изображение</label>
        <div class="preview">
            <button class="preview__remove" type="button">x</button>
            <div class="preview__img">
                <img src="img/avatar.jpg" width="113" height="113" alt="Изображение лота">
            </div>
        </div>
        <div class="form__input-file">
            <input class="visually-hidden" type="file" id="lot-img" value="" name="lot-img">
            <label for="lot-img">
                <span>+ Добавить</span>
            </label>
        </div>
            <span class="form__error">Заполните значение</span>
    </div>
    <div class="form__container-three">
        <?php $classname = isset($errors['lot-rate']) ? "form__item--invalid" : "";
        $value = isset($lot['lot-rate']) ? $lot['lot-rate'] : "";?>
        <div class="form__item form__item--small <?=$classname;?>">
            <label for="lot-rate">Начальная цена</label>
            <input id="lot-rate" type="number" name="lot-rate" placeholder="0" value="<?=$value;?>">
            <span class="form__error"><?=$dict['lot-rate'];?>: <?=$errors['lot-rate'];?></span>
        </div>

        <?php $classname = isset($errors['lot-step']) ? "form__item--invalid" : "";
        $value = isset($lot['lot-step']) ? $lot['lot-step'] : "";?>
        <div class="form__item form__item--small <?=$classname;?>">
            <label for="lot-step">Шаг ставки</label>
            <input id="lot-step" type="number" name="lot-step" placeholder="0" value="<?=$value;?>">
            <span class="form__error"><?=$dict['lot-step'];?>: <?=$errors['lot-step'];?></span>
        </div>

        <?php $classname = isset($errors['lot-date']) ? "form__item--invalid" : "";
        $value = isset($lot['lot-date']) ? $lot['lot-date'] : "";?>
        <div class="form__item <?=$classname;?>">
            <label for="lot-date">Дата окончания торгов</label>
            <input class="form__input-date" id="lot-date" type="date" name="lot-date" value="<?=$value;?>">
            <span class="form__error"><?=$dict['lot-date'];?>: <?=$errors['lot-date'];?></span>
        </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
</form>
