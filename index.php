<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meetup</title>
</head>
<body>
    <h1>Beria Wordpress Meetup</h1>
    <?php
        $cardapio = get_posts([
            'numberposts' => -1,
            'post_type' => 'cardapio'
        ]);

        foreach ($cardapio as $key => $menu):
            echo get_the_post_thumbnail($menu->ID);
        ?>
        <h3><?php echo get_the_title($menu->ID); ?></h3>
        <p><?php echo apply_filters( 'the_content', $menu->post_content); ?></p>
        <p>Preço: <?php echo $preco = esc_attr( get_post_meta($menu->ID, 'cardapio_preco', true)); ?></p>
        <p>Desconto: <?php echo $desconto = esc_attr( get_post_meta($menu->ID, 'cardapio_desconto', true)); ?></p>
        <h2>Valor do Prato: <?php echo ($preco - $desconto); ?></h2>
        <?php
        endforeach
    ?>
</body>
</html>