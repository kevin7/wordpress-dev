<?php
add_action("wp_ajax_search", "search");
add_action("wp_ajax_nopriv_search", "search");

function search() {
  die();
}
