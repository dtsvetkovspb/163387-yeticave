<form class="form form--add-lot container <?= count($errors) ? 'form--invalid' : ''; ?>" action="add.php" method="post" enctype="multipart/form-data">
    <h2>Добавление лота</h2>
    <div class="form__container-two">

       <?php $classname = isset($errors['lot-name']) ? "form__item--invalid" : "";
        $value = isset($lot['lot-name']) ? htmlspecialchars($lot['lot-name']) : "";?>
        <div class="form__item <?=$classname;?> ">
            <label for="lot-name">Наименование</label>
            <input id="lot-name" type="text"  name="lot-name" placeholder="Введите наименование лота" value="<?=$value;?>">
            <span class="form__error"><?=$dict['lot-name'];?>: <?=$errors['lot-name'];?></span>
        </div>

        <?php $classname = isset($errors['category']) ? "form__item--invalid" : "";
        $value = isset($lot['category']) ? htmlspecialchars($lot['category']) : "";?>
        <div class="form__item <?=$classname;?>">
            <label for="category">Категория</label>
            <select id="category" name="category" >

                <option value="<?= $value; ?>"><?= $value == '' ? 'Выберите категорию' : htmlspecialchars($categories[$value - 1]['name'])?></option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?=htmlspecialchars($cat['id'])?>"><?=htmlspecialchars($cat['name'])?></option>
                <?php endforeach; ?>
            </select>
            <span class="form__error"><?=$dict['category'];?>: <?=$errors['category'];?></span>
        </div>
    </div>

    <?php $classname = isset($errors['description']) ? "form__item--invalid" : "";
    $value = isset($lot['description']) ? htmlspecialchars($lot['description']) : "";?>
    <div class="form__item form__item--wide <?=$classname;?>">
        <label for="description">Описание</label>
        <textarea id="description" name="description" placeholder="Напишите описание лота"><?=$value;?></textarea>
        <span class="form__error">Напишите описание лота</span>
    </div>

    <?php $classname = isset($errors['file']) ? "form__item--invalid" : "";?>
    <div class="form__item form__item--file <?=$classname;?>"> <!-- form__item--uploaded -->
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
            <span class="form__error"><?=$dict['file'];?>: <?=$errors['file']?></span>
    </div>
    <div class="form__container-three">
        <?php $classname = isset($errors['lot-rate']) ? "form__item--invalid" : "";
        $value = isset($lot['lot-rate']) ? htmlspecialchars($lot['lot-rate']) : "";?>
        <div class="form__item form__item--small <?=$classname;?>">
            <label for="lot-rate">Начальная цена</label>
            <input id="lot-rate" type="number" name="lot-rate" placeholder="0" value="<?=$value;?>">
            <span class="form__error"><?=$dict['lot-rate'];?>: <?=$errors['lot-rate'];?></span>
        </div>

        <?php $classname = isset($errors['lot-step']) ? "form__item--invalid" : "";
        $value = isset($lot['lot-step']) ? htmlspecialchars($lot['lot-step']) : "";?>
        <div class="form__item form__item--small <?=$classname;?>">
            <label for="lot-step">Шаг ставки</label>
            <input id="lot-step" type="number" name="lot-step" placeholder="0" value="<?=$value;?>">
            <span class="form__error"><?=$dict['lot-step'];?>: <?=$errors['lot-step'];?></span>
        </div>

        <?php $classname = isset($errors['lot-date']) ? "form__item--invalid" : "";
        $value = isset($lot['lot-date']) ? htmlspecialchars($lot['lot-date']) : "";?>
        <div class="form__item <?=$classname;?>">
            <label for="lot-date">Дата окончания торгов</label>
            <input class="form__input-date" id="lot-date" type="date" name="lot-date" value="<?=$value;?>">
            <span class="form__error"><?=$dict['lot-date'];?>: <?=$errors['lot-date'];?></span>
        </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
</form>
