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

    /**
     * NotificationPrint constructor.
     *
     * @param string $text
     * @param string $alertType
     */
    public function __construct($text = '', $alertType = self::SUCCESS)
    {
        $this->text = base64_encode(nl2br($text));
        $this->alertType = $alertType;
    }

    function __toString()
    {
        $id = uniqid('alert-');

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
                document.querySelector('body').appendChild(outer);
                outer.onclick = function() {
                    outer.style.display = 'none';
                };
                setTimeout(function(){
                    outer.remove();
                }, 6000);
            </script>
HTML;
    }
}