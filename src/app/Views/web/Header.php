<header>
    <section class="top-bar">
        <div class="container">
            <div class="row">    
                <div class="col text-left">
                    <ul class="nav ustify-content-start top-bar-left">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('/')?>"><?= lang('Home.home') ?></a>
                        </li>
                    </ul>
                </div>
                <div class="col text-right">
                    <ul class="nav justify-content-end top-bar-right">
                        <li class="nav-item dropdown">
                            <a  href="#" 
                                class="nav-link dropdown-toggle" 
                                role="button" 
                                data-toggle="dropdown" 
                                aria-haspopup="true" 
                                aria-expanded="false"
                                id="dropDownCurrency">
                                <i class="fa fa-money" aria-hidden="true"></i> <?= lang('Home.currency') ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropDownCurrency">
                                <?php foreach ($currencies as $currency): ?>
                                    <a class="dropdown-item" href="#"><?=$currency?></a>
                                <?php endforeach; ?>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a  heef="#"
                                class="nav-link dropdown-toggle"
                                role="button"
                                data-toggle="dropdown"
                                aria-haspopup="true" 
                                aria-expanded="false"
                                id="dropDownLanguage">
                                <i class="fa fa-globe" aria-hidden="true"></i> <?= lang('Home.language') ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropDownLanguage">
                                <?php foreach ($langs as $key => $lang): ?>
                                    <button class="dropdown-item btn-lang" value="<?= $key ?>" ><?=$lang?></button>
                                <?php endforeach; ?>
                            </div>
                        </li>
                        <li calss="nav-item"><a class="nav-link" href="<?= site_url('member/login') ?>"><?= lang('Home.login') ?></a></li>
                        <li calss="nav-item"><a class="nav-link"  href="<?= site_url('member/register') ?>"><?= lang('Home.register') ?></a></li>
                        <li calss="nav-item">
                            <a class="nav-link" href="<?= site_url('shop/cart') ?>">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</header>

<script type="text/javascript">
    $('.btn-lang').click(function(e) {
        
    });
</script>