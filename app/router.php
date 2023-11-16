<?php
    return [
        '~^$~'=>[\core\controllers\HomeController::class, 'responseHome'],
        '~^TestController$~'=>[\core\controllers\TestController::class, 'REsponseTEst'],
        '~^addproduct$~'=>[\core\controllers\HomeController::class,'addProduct'],
        '~^about/(\d+)$~'=>[\core\controllers\AboutController::class, 'responseAbout'],
        '~^about/(.*)/redact$~'=>[\core\controllers\AboutController::class,'responseRedact'],
        '~^about/(.*)/redact/delete$~'=>[\core\controllers\AboutController::class, 'deleteProduct']
    ];