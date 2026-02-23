<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
$i18nKey = $params['i18n'] ?? null;
?>
<div class="<?= h($class) ?>" onclick="this.classList.add('hidden');">
    <span<?= $i18nKey ? ' data-i18n="' . h($i18nKey) . '"' : '' ?>><?= $message ?></span>
</div>
