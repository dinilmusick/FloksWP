<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/Element/Element.php';
require_once __DIR__ . '/../src/Element/Select.php';

function verify(bool $ok, string $message): void {
    if (!$ok) throw new RuntimeException($message);
}
$widget = new \FloksWP\Element\Select();
verify($widget->get_name() === 'flokswp-select', 'canonical widget name');
$settings = ['name' => 'country', 'label' => 'Choose country', 'options' => "0|Zero\nindia|India\r\nusa|USA", 'selected' => '0'];
$html = $widget->markup($settings, 'frnl-field');
verify(str_contains($html, 'data-frnl-component="frnl-field"'), 'FRNL component identity');
verify(str_contains($html, 'aria-label="Choose country"'), 'accessible label');
verify(str_contains($html, '<option value="0" selected="selected">Zero</option>'), 'selected zero preserved');
verify(str_contains($html, '<option value="india">India</option>'), 'option rendering');
verify(str_contains($html, '<option value="usa">USA</option>'), 'CRLF option rendering');
$dangerous = $widget->markup(['name' => '" autofocus', 'label' => '<script>', 'options' => "x|<img src=x onerror=1>", 'selected' => 'x'], 'id');
verify(!str_contains($dangerous, '<script>') && !str_contains($dangerous, '<img'), 'escape option/label HTML');
verify(str_contains($dangerous, 'name="&quot; autofocus"'), 'escape name attribute');
verify(str_contains($dangerous, '&lt;img'), 'escape option label');
$empty = $widget->markup([], 'default-id');
verify(str_contains($empty, 'Select option...'), 'empty selection placeholder preserved');
echo "FloksWP select regression tests: OK\n";
