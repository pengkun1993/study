<?php
function filter_username($value) {
    return stripos($value, 'boss') === false;
}
