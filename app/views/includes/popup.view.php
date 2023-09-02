<?php if (message()) : ?>
    <div class="popup-box">
        <span class="popup-close">X</span>
        <span class="popup-msg"><?= message('', true) ?></span>
    </div>
<?php endif; ?>