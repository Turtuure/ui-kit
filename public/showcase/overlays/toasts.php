<?php

declare(strict_types=1);

use Archon\UIKit\DataDisplay\Card;
use Archon\UIKit\Elements\Button\Button;
use Archon\UIKit\Layout\Structure\Column;
use Archon\UIKit\Layout\Structure\Container;
use Archon\UIKit\Layout\Structure\Row;
use Archon\UIKit\Overlays\Toast;

echo '<h2>Toasts</h2>';
echo '<p class="lead text-muted mb-4">Push notifications to your visitors with a toast, a lightweight and easily customizable alert message.</p>';

$snippet = function(string $code): string {
    return '<pre class="code-snippet m-0" style="max-height: 150px;"><code>' . htmlspecialchars($code) . '</code></pre>';
};

echo (new Container(
    new Row(
        (new Column(
            (new Card(
                (new Button('Show Live Toast'))
                    ->variant('success')
                    ->id('liveToastBtn') .

                // Container for toasts
                '<div class="toast-container position-fixed bottom-0 end-0 p-3">' .
                (new Toast('Live Toast Title', 'Hello, world! This is a toast message.'))
                    ->id('liveToast')
                    ->time('11 mins ago') .
                '</div>'
            ))->header('Live Example')
              ->footer($snippet("new Toast('Title', 'Body')"))
        ))->md(12)->addClass('mb-4')
    )
))->fluid();

?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toastTrigger = document.getElementById('liveToastBtn')
        const toastLiveExample = document.getElementById('liveToast')
        if (toastTrigger) {
            toastTrigger.addEventListener('click', () => {
                const toast = new bootstrap.Toast(toastLiveExample)
                toast.show()
            })
        }
    });
</script>