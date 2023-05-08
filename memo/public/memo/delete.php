<?php

require_once '../../includes/login-check.php';
require_once '../../models/Memo.php';

$id = $_GET['id'];
Memo::delete($id);

header('Location: ./index.php');
