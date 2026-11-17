<?php
declare(strict_types=1);

namespace FloksWP\Element;

use Elementor\Controls_Manager;

final class Select extends Element {
    public function get_name(): string { return 'flokswp-select'; }
    public function get_title(): string { return 'Floks Select'; }
    public function get_icon(): string { return 'eicon-select'; }

    protected function register_controls(): void {
        $this->start_controls_section('content', ['label' => 'Content']);
        $this->add_control('name', ['label' => 'Field Name', 'type' => Controls_Manager::TEXT, 'default' => 'floks_select']);
        $this->add_control('label', ['label' => 'Accessible Label', 'type' => Controls_Manager::TEXT, 'default' => 'Select option']);
        $this->add_control('options', ['label' => 'Options (value|label per line)', 'type' => Controls_Manager::TEXTAREA, 'default' => '']);
        $this->add_control('selected', ['label' => 'Selected Value', 'type' => Controls_Manager::TEXT, 'default' => '']);
        $this->end_controls_section();
    }

    public function markup(array $settings, string $componentId): string {
        $name = (string) ($settings['name'] ?? 'floks_select');
        $label = trim((string) ($settings['label'] ?? 'Select option'));
        if ($label === '') $label = 'Select option';
        $selected = (string) ($settings['selected'] ?? '');
        $html = '<select class="flokswp-select" name="' . self::escape($name) . '"'
            . $this->semanticAttributes($componentId, ['role' => 'combobox', 'aria-label' => $label]) . '>';
        $html .= '<option value=""' . ($selected === '' ? ' selected="selected"' : '') . '>Select option...</option>';
        foreach (preg_split('/\R/u', (string) ($settings['options'] ?? '')) ?: [] as $line) {
            if (trim($line) === '') continue;
            [$value, $text] = array_pad(explode('|', $line, 2), 2, null);
            $value = trim($value);
            if ($value === '') continue;
            $text = trim($text ?? $value);
            $html .= '<option value="' . self::escape($value) . '"'
                . ($selected === $value ? ' selected="selected"' : '')
                . '>' . self::escape($text) . '</option>';
        }
        return $html . '</select>';
    }

    protected function render(): void { echo $this->markup($this->get_settings_for_display(), $this->get_id()); }

    private static function escape(string $value): string {
        return function_exists('esc_html')
            ? esc_html($value) : htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}
