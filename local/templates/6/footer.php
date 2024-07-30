<?$APPLICATION -> IncludeComponent(
    "bitrix:menu",
    "menu",
    Array(
        "ALLOW_MULTI_SELECT" => "N",
        "CHILD_MENU_TYPE" => "left",
        "DELAY" => "N",
        "MAX_LEVEL" => "1",
        "MENU_CACHE_GET_VARS" => array(0=>"",),
        "MENU_CACHE_TIME" => "3600",
        "MENU_CACHE_TYPE" => "N",
        "MENU_CACHE_USE_GROUPS" => "Y",
        "ROOT_MENU_TYPE" => "left",
        "USE_EXT" => "N"
    ));?>

<!-- Footer -->
<footer class="bg-light py-5">
    <div class="container">
        <div class="small text-center text-muted">Copyright © 2019 - Start Bootstrap<br/>Copyright © Blackrock Digital LLC. Code released under the MIT license.</div>
    </div>
    </div>
</footer>
<!-- Bootstrap core JavaScript -->
<script src="<?=SITE_TEMPLATE_PATH?>/vendor/jquery/jquery.min.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Plugin JavaScript -->
<script src="<?=SITE_TEMPLATE_PATH?>/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
<!-- Custom scripts for this template -->
<script src="<?=SITE_TEMPLATE_PATH?>/js/creative.min.js"></script>
</body>
</html>