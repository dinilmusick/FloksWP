<?php
namespace FloksWP;
use FloksWP\Element\{Button,Container,Heading,Graph};
final class Plugin {
    public const VERSION='0.3.1';
    public function register():void{
        if(!class_exists('Elementor\Plugin'))return;
        add_action('elementor/elements/categories_registered',function($elementsManager):void{
            $elementsManager->add_category('flokswp',['title'=>'FloksWP']);
        });
        add_action('elementor/widgets/register',function($manager):void{
            foreach([new Button(),new Container(),new Heading(),new Graph()] as $widget)$manager->register($widget);
        });
    }
}