<?php

/* @var $this       yii\web\View */
$appleUrl = \yii\helpers\Url::to(['/apples']);

$js = <<< JS
    
    $(document).on('click', "[data-role='fall']", function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        window.location.href = '$appleUrl/fall/?id='+id;
    });

    $(document).on('click', "[data-role='eat']", function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        bootbox.prompt({
            title: "Сколько процентов откусить?",
            inputType: 'number',
            callback: function (percent) {
                window.location.href = '$appleUrl/eat/?id='+id+'&percent='+percent;
            }
        });
    });
    // init
JS;
$this->registerJs($js);
?>
