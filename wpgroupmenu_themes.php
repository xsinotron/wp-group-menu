<?php
/**
 *
 */
class WPGroupMenu_Theme
{
    /**
     * @var string
     */
    public $list;
    public $default;
    /**
     *
     */
    public function set($id, $name)
    {
        if ( !array_key_exists($id, $this->list) )
        $this->list[$id] = $name;
    }
    /**
     *
     */
    public function __construct($default="black") {
        $this->default = $default;
        $this->list = array (
            "ymaa"     => __('YMAA',     'wgm'),
            "sapphire" => __('Sapphire', 'wgm'),
            "emerald"  => __('Emerald',  'wgm'),
            "black"    => __('Black',    'wgm'),
            "blue"     => __('Blue',     'wgm'),
            "cyan"     => __('Cyan',     'wgm'),
            "green"    => __('Green',    'wgm'),
            "orange"   => __('Orange',   'wgm'),
            "red"      => __('Red',      'wgm'),
            "white"    => __('White',    'wgm'),
            "yellow"   => __('Yellow',   'wgm')
        );
    }
}
?>
