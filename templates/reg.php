<form class="form container <?= count($errors) ? 'form--invalid' : ''; ?>" action="register.php" method="post" enctype="multipart/form-data">
    <h2>Регистрация нового аккаунта</h2>

    <?php $classname = isset($errors['email']) ? "form__item--invalid" : "";
    $value = isset($form['email']) ? htmlspecialchars($form['email']) : "";?>
    <div class="form__item <?= $classname; ?>"> <!-- form__item--invalid -->
        <label for="email">E-mail*</label>
        <input id="email" type="text" name="signup[email]" placeholder="Введите e-mail" value="<?=$value;?>" >
        <span class="form__error"><?=$dict['email'];?>: <?=$errors['email'];?></span>
    </div>

    <?php $classname = isset($errors['password']) ? "form__item--invalid" : "";
    $value = isset($form['password']) ? htmlspecialchars($form['password']) : "";?>
    <div class="form__item <?= $classname; ?>">
        <label for="password">Пароль*</label>
        <input id="password" type="text" name="signup[password]" placeholder="Введите пароль" >
        <span class="form__error">Введите пароль</span>
    </div>

    <?php $classname = isset($errors['name']) ? "form__item--invalid" : "";
    $value = isset($form['name']) ? htmlspecialchars($form['name']) : "";?>
    <div class="form__item <?= $classname; ?>">
        <label for="name">Имя*</label>
        <input id="name" type="text" name="signup[name]" placeholder="Введите имя" value="<?=$value;?>" >
        <span class="form__error">Введите имя</span>
    </div>

    <?php $classname = isset($errors['message']) ? "form__item--invalid" : "";
    $value = isset($form['message']) ? htmlspecialchars($form['message']) : "";?>
    <div class="form__item <?= $classname; ?>">
        <label for="message">Контактные данные*</label>
        <textarea id="message" name="signup[message]" placeholder="Напишите как с вами связаться" ><?=$value;?></textarea>
        <span class="form__error">Напишите как с вами связаться</span>
    </div>
    <div class="form__item form__item--file form__item--last">
        <label>Аватар</label>
        <div class="preview">
            <button class="preview__remove" type="button">x</button>
            <div class="preview__img">
                <img src="img/avatar.jpg" width="113" height="113" alt="Ваш аватар">
            </div>
        </div>
        <div class="form__input-file">
            <input class="visually-hidden" type="file" id="photo2" value="" name="avatar">
            <label for="photo2">
                <span>+ Добавить</span>
            </label>
        </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Зарегистрироваться</button>
    <a class="text-link" href="login.php">Уже есть аккаунт</a>
</form>