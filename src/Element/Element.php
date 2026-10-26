<?php
namespace FloksWP\Element;
abstract class Element extends \Elementor\Widget_Base {
    public function get_categories():array{return ['flokswp'];}
    protected function semanticAttributes(string $component,array $extra=[]):string{$attrs=array_merge(['data-frnl-component'=>$component,'data-frnl-state'=>'idle'],$extra);$out='';foreach($attrs as $k=>$v)$out.=' '.esc_attr($k).'="'.esc_attr((string)$v).'"';return $out;}
}