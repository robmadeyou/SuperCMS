<?php

namespace SuperCMS\Controls\Notification;

class NotificationPrint
{
    const WARNING = 'alert-warning';
    const INFO = 'alert-info';
    const SUCCESS = 'alert-success';
    const DANGER = 'alert-danger';

    private $text;
    private $alertType;
    private $targetElementId;

    private $timeout = 6000;

    /**
     * NotificationPrint constructor.
     *
     * @param string $text
     * @param string $alertType
     * @param string $targetElementId
     */
    public function __construct($text = '', $alertType = self::SUCCESS, $targetElementId = '')
    {
        $this->text = base64_encode(nl2br($text));
        $this->alertType = $alertType;
        $this->targetElementId = $targetElementId;
    }

    public function setTimeout($timeout = 6000)
    {
        $this->timeout = $timeout;
    }

    function __toString()
    {
        $id = uniqid('alert-');

        $timeoutText = '';
        if ($this->timeout > 0) {
            $timeoutText = <<<JS
            setTimeout(function(){
                    outer.remove();
                }, {$this->timeout});
JS;
        }
        return <<<HTML
            <script type="application/javascript">
                var outer = document.createElement('div');
                outer.classList.add('alert-outer');
                outer.id = '{$id}';
                var element = document.createElement('div');
                element.classList.add('alert');
                element.classList.add('{$this->alertType}');
                element.setAttribute('role', 'alert');
                element.innerHTML = atob('{$this->text}');
                outer.appendChild(element);
                
                var target = null;
                
                try {
                    target = document.querySelector('#{$this->targetElementId}');
                    target.classList.add('alert-target');
                } catch (ex) {
                    target = document.querySelector('body');
                }
                target.appendChild(outer);
                outer.onclick = function() {
                    outer.style.display = 'none';
                };
                
                {$timeoutText}
            </script>
HTML;
    }
}