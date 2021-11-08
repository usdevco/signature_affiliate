<?php
// Theese lines should aways at the end of the document left side. Dont indent these lines
$html = <<<EOF
<div style="width:680px !important;">
$estimate_attacchment->content
</div>
EOF;
$pdf->writeHTML($html, true, false, true, false, '');
