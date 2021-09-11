<?php
function menu_custom_post(){
    $args = [
        'labels' => [
            'name' => 'Menu',
            'singluar_name' => 'Menu'
        ],
        'public' => true,
        'supports' => ['title','editor','thumbnail'],
        'menu_icon' => 'dashicons-food'
    ];

    register_post_type('cardapio',$args);
}

add_action('init','menu_custom_post');

function menu_customs_fields(){
    add_meta_box(
        'more_fields',
        __( 'Campos adicionais',  'more_fields'),
        'disponibilizar_campos_adicionas_de_cardapio',
        'cardapio'
    );
}

add_action( 'add_meta_boxes', 'menu_customs_fields');

function disponibilizar_campos_adicionas_de_cardapio(){
    // echo "Aqui vai aparecer o campo customizado";
?>
    <p>
        <label for="cardapio_preco">Adicionar Preço</label>
        <input type="text" id="cardapio_preco" name="cardapio_preco" value="<?php echo esc_attr( get_post_meta(get_the_ID(), 'cardapio_preco', true)); ?>">
    </p>
    <p>
        <label for="cardapio_preco">Adicionar Desconto</label>
        <input type="text" id="cardapio_desconto" name="cardapio_desconto" value="<?php echo esc_attr( get_post_meta(get_the_ID(), 'cardapio_desconto', true)); ?>">
    </p>
<?php
}

function salvar_campos_customizados($post_id){
    if( defined( 'DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;

    if($parent_id = wp_is_post_revision($post_id)){
        $post_id = $parent_id;
    }

    if( array_key_exists('cardapio_preco', $_POST)) {
        update_post_meta($post_id,'cardapio_preco', sanitize_text_field( $_POST['cardapio_preco']));
    }

    if( array_key_exists('cardapio_desconto', $_POST)) {
        update_post_meta($post_id,'cardapio_desconto', sanitize_text_field( $_POST['cardapio_desconto']));
    }
}

add_action('save_post', 'salvar_campos_customizados');