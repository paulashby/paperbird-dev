<?php

$process = $this->modules->get("ProcessForgotPassword");
/** @var ProcessForgotPassword $process */
$out = $process->execute();
//TODO: Style the output of this page
echo "<main data-pw-id='main'>{$out}</main>";