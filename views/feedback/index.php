<?php
use yii\helpers\Url;
/**
 * @var $list \app\models\News[]
 */
?>
<div class='wrapper'><!-- Боковая навигация и контентная часть -->
    <div class="group">
        <div class="couch">
            <aside class="sidebar-login">
                <div class="formLog form-push active">
                    <div class="login js-push-form">
                        <a href="#"><i class="fa fa-sign-in"></i> <span>Войти</span></a>
                    </div>
                    <h3>Регистрация</h3>
                    <form action="<?\yii\helpers\Url::toRoute('form/vacancy')?>" class="style-form aggregator-vacancy js-ajax-form" id="vacancy-form" method="post" enctype="multipart/form-data"
                          data-title="Спасибо за регистрацию!" data-content="Ваш логин и пароль выслан вам на почту.">
                        <input type="hidden" name="form" value="" />
                        <div class="fieldInput section_Input required">
                            <input type="text" required="" name="name" class="block-field__input block-field__input--required"
                                   placeholder="ФИО">
                        </div>
                        <div class="fieldInput section_Input required">
                            <input type="tel" name="phone" required="" class="block-field__input block-field__input--required"
                                   placeholder="Телефон">
                        </div>
                        <div class="fieldInput  section_Input required">
                            <input type="email" name="email" required="" class="block-field__input" placeholder="Email">
                        </div>
                        <div class="fieldInput section_Input required">
                            <input type="password" name="password" required="" class="block-field__input" placeholder="Пароль">
                        </div>
                        <div class="fieldInput section_Input" <?=($promoCode != false ? 'style="display: none;"' : '')?>>
                            <input type="text" name="promoCode" value="<?=($promoCode != false ? $promoCode : '')?>" class="block-field__input" placeholder="Промо-код">
                        </div>
                        <div class="fieldInput section_Input">
                            <input type="text" name="vk_profile" class="block-field__input" placeholder="Профиль VK">
                        </div>
                        <div class="fieldInput section_Input">
                            <input type="text" name="instagram_profile" class="block-field__input" placeholder="Профиль Instagram">
                        </div>
                        <div class="button_link--default">
                            <button class="block-field__button--uppercase button_link">
                                <span>Зарегистрироваться</span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="formLog form-push">
                    <div class="reg js-push-form">
                        <a href="#"><i class="fa fa-sign-in"></i> <span>зарегистрироваться</span></a>
                    </div>
                    <h3>Личный кабинет</h3>
                    <form id="login-form" class="form-horizontal enterLk" action="<?=Url::to('/site/login')?>" method="post">
                        <div class="form-group field-loginform-username required">
                            <input type="text" id="loginform-username" class="form-control" name="LoginForm[username]" autofocus placeholder="Логин">
                            <div class="help-block"></div>
                        </div>
                        <div class="form-group field-loginform-password required">
                            <input type="password" id="loginform-password" class="form-control" name="LoginForm[password]" placeholder="Пароль">
                            <div class="help-block"></div>
                        </div>
                        <br>
                        <div class="reg">
                            <a href="<?=Url::to(['/site/reset-password'])?>"><span>Восстановить пароль</span></a>
                        </div>
                        <div class="button_link--default">
                            <button class="block-field__button--uppercase button_link" name="login-button">
                                <span>Авторизоваться</span>
                            </button>
                        </div>
                    </form>
                </div>
            </aside>
            <article class="content"><!-- Контент -->
                <?php if (isset($this->context->h1) && !empty($this->context->h1)) { ?>
                    <h1><?=\yii\helpers\Html::encode($this->context->h1)?></h1>
                <?php } else { ?>
                    <h1>Спортсменам</h1>
                <?php } ?>
                <div class="tabLogin">
                    <div class="tabs">
                        <span data-tab="one">Регистрация</span>
                        <span data-tab="two">Войти</span>
                    </div>
                    <div class="tabsCont">
                        <div class="tabForm" data-cont="one">
                            <form action="<?\yii\helpers\Url::toRoute('form/vacancy')?>" class="style-form aggregator-vacancy js-ajax-form" id="vacancy-form" method="post" enctype="multipart/form-data"
                                  data-title="Спасибо за регистрацию!" data-content="Ваш логин и пароль выслан вам на почту.">
								<input type="hidden" name="form" value="" />
								<div class="fieldInput section_Input required">
									<input type="text" required="" name="name" class="block-field__input block-field__input--required"
										   placeholder="ФИО">
								</div>
								<div class="fieldInput section_Input required">
									<input type="tel" name="phone" required="" class="block-field__input block-field__input--required"
										   placeholder="Телефон">
								</div>
								<div class="fieldInput section_Input required">
									<input type="email" name="email" required="" class="block-field__input" placeholder="Email">
								</div>
                                <div class="fieldInput section_Input required">
                                    <input type="password" name="password" required="" class="block-field__input" placeholder="Пароль">
                                </div>
                                <div class="fieldInput section_Input" <?=($promoCode != false ? 'style="display: none;"' : '')?>>
                                    <input type="text" name="promoCode" value="<?=($promoCode != false ? $promoCode : '')?>" class="block-field__input" placeholder="Промо-код">
                                </div>
								<div class="fieldInput section_Input">
									<input type="text" name="vk_profile" class="block-field__input" placeholder="Профиль VK">
								</div>
								<div class="fieldInput section_Input">
									<input type="text" name="instagram_profile" class="block-field__input" placeholder="Профиль Instagram">
								</div>
								<div class="button_link--default">
									<button class="block-field__button--uppercase button_link">
										<span>Зарегистрироваться</span>
									</button>
								</div>
							</form>
                        </div>
                        <div class="tabForm" data-cont="two">
                            <form id="login-form" class="form-horizontal enterLk" action="<?=Url::to('/site/login')?>" method="post">
								<div class="form-group field-loginform-username required">
									<input type="text" id="loginform-username" class="form-control" name="LoginForm[username]" autofocus placeholder="Логин">
									<div class="help-block"></div>
								</div>
								<div class="form-group field-loginform-password required">
									<input type="password" id="loginform-password" class="form-control" name="LoginForm[password]" placeholder="Пароль">
									<div class="help-block"></div>
								</div>
								<br>
								<div class="reg">
									<a href="<?=Url::to(['/site/reset-password'])?>"><span>Восстановить пароль</span></a>
								</div>
								<div class="button_link--default">
									<button class="block-field__button--uppercase button_link" name="login-button">
										<span>Авторизоваться</span>
									</button>
								</div>
							</form>
                        </div>
                    </div>
                </div>
                <div class="couchText">
<?=\app\models\Content::text('couch.text', '
                    <p>Желаете прокачать не только тело, но и свои финансовые возможности? Присоединяйтесь к команде Primekraft!</p>
                    <p>Мы предлагаем вам инновационный продукт, преимуществами которого являются разнообразная вкусовая линейка, удобная форма подачи, эффективность и, конечно, привлекательная ценовая политика. Собственное сертифицированное производство позволяет отследить изготовление спортивных добавок на всех его этапах, благодаря чему мы уверены в безусловном качестве выпускаемой продукции.</p>
                    <p>Просто решитесь и выйдите на новый уровень с Primekraft:</p>
                    
                    <ul>
                        <li>зарегистрируйтесь в системе;</li>
                        <li>дождитесь подтверждения регистрации на указанный email;</li>
                        <li>выберите личный промокод, который будет закреплен за вашими заказами;</li>
                        <li>ознакомьтесь с предлагаемым ассортиментом;</li>
                        <li>совершите свою первую сделку.</li>
                    </ul>
                    
                    <p>Специфика работы проста, понятна и предельно прозрачна: в личном кабинете отображается ваша активность, выполненные и отгруженные заказы, а также все заработанные суммы. Обналичить заработанные бонусы вы сможете сразу, как только величина вашего баланса достигнет отметки в 3000 рублей. Мы не ставим пределов и ограничений – работайте и зарабатывайте столько, сколько желаете. Только от вашей активности зависит сумма, которую в конечном итоге вы получите, сотрудничая с Primekraft!</p>
                ')?>
                </div>
            </article>
        </div>
    </div>
</div>
