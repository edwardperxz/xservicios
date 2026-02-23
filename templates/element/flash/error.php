<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
$i18nKey = $params['i18n'] ?? null;
?>
<div class="message error" onclick="this.classList.add('hidden');">
    <span<?= $i18nKey ? ' data-i18n="' . h($i18nKey) . '"' : '' ?>><?= $message ?></span>
</div>
