<?php

return [
    '"Kathamo\\\\App\\\\": "app/",'             => '"{{namespace_prefix}}\\\\App\\\\": "app/",',
    '"Kathamo\\\\Database\\\\": "database/"'    => '"{{namespace_prefix}}\\\\Database\\\\": "database/"',
    '@package kathamo'                          => '@package {{text_domain}}',
    'Plugin Name: Kathamo'                      => 'Plugin Name: {{plugin_name}}',
    'Text Domain: kathamo'                      => 'Text Domain: {{text_domain}}',
    'namespace Kathamo\App'                     => 'namespace {{namespace_prefix}}\App',
    'use Kathamo\App'                           => 'use {{namespace_prefix}}\App',
    'Kathamo\Database'                          => '{{namespace_prefix}}\Database',
    'KATHAMO_FILE'                              => '{{constent_prefix}}_FILE',
    'KATHAMO_DIR_PATH'                          => '{{constent_prefix}}_DIR_PATH',
    'KATHAMO_PLUGIN_URL'                        => '{{constent_prefix}}_PLUGIN_URL',
    'kathamo_get_config'                        => '{{function_prefix}}_get_config',
    'kathamo_prefix'                            => '{{function_prefix}}_prefix',
    'kathamo_url'                               => '{{function_prefix}}_url',
    'kathamo_asset_url'                         => '{{function_prefix}}_asset_url',
    'kathamo_wp_ajax'                           => '{{function_prefix}}_wp_ajax',
    'kathamo_render_template'                   => '{{function_prefix}}_render_template',
    'kathamo_render_view_template'              => '{{function_prefix}}_render_view_template',
    '=> Kathamo\App'                            => '=> {{namespace_prefix}}\App',
    "'plugin_prefix'		=> 'kathamo'"       => "'plugin_prefix'		=> '{{plugin_prefix}}'",
    "'plugin_slug'		=> 'kathamo'"           => "'plugin_slug'		=> '{{plugin_prefix}}'",
    "'namaspace_root'	=> 'Kathamo',"          => "'namaspace_root'	=> '{{namespace_prefix}}',",
    "'plugin_name'		=> 'Kathamo',"          => "'plugin_name'		=> '{{plugin_name}}',",
    '"\Kathamo\Database\Migrations\\"'          => '"\{{namespace_prefix}}\Database\Migrations\\"',
];
