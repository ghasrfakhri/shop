<?php

function escapeString($string) {
    return Db::get()->real_escape_string($string);
}
