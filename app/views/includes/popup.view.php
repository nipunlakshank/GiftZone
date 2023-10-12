<?php if (message()) : ?>
    <div class="popup-box">
        <span class="popup-close">X</span>
        <pre class="popup-msg"><?= message('', true) ?></pre>
    </div>
<?php endif; ?>