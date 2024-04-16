<?php

function form_shortcode() {

  $output = '
    <form method="post" action="'. esc_url( $_SERVER['REQUEST_URI'] ).'">
        <label for="name">Name:</label><br>
        <input type="text" name="name"><br>
        
        <label for="email">Email:</label><br>
        <input type="email" name="email"><br>
        
        <label for="message">Phone:</label><br>
        <input type="phone" name="phone"><br>
        
        <input type="submit" name="submit" value="Submit">
    </form>';

    return $output;
}

add_shortcode('custom_form', 'form_shortcode');

function form_submission(){
    if ( isset( $_POST['submit'] ) ) {
        
        global $wpdb;
        $table_name = 'information';
        
        $name= $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $wpdb->insert($table_name, array(
            'name' => $name,
            'email' => $email,
            'phone' => $phone
        ), array('%s', '%s', '%d')
    );
    
    wp_redirect( $_SERVER['REQUEST_URI'] );
        exit;
    }

    if (isset($_POST['update'])) {

        global $wpdb;
        $table_name = 'information';

        $update_id =$_POST['id'];
        
        $data = array(
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone']
        );
        $wpdb->update($table_name, $data, array('id' => $update_id));

        wp_redirect( $_SERVER['REQUEST_URI'] );
        exit;
    }
}

add_action( 'init', 'form_submission' );

?>